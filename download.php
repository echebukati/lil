<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
	header ("Location: index.php");
}
$username = ($_SESSION['username']);

$conn = new mysqli("fintechclouddb.cnydfygbrhuz.us-east-1.rds.amazonaws.com", "fintech", "wC!viIkBek@6", "fintechdb");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$downloadid = $_GET['id'];

$query = $conn->query("SELECT * FROM `transactions` WHERE user_id = '$username' AND id = '$downloadid'");
if (mysqli_num_rows($query)) {
    $bucket = 'testfintechbucket';
    $keyname = $downloadid.".pdf";

    $s3 = new S3Client([
        'version' => 'latest',
        'region'  => 'us-east-1'
    ]);

    try {
        // Get the object.
        $result = $s3->getObject([
            'Bucket' => $bucket,
            'Key'    => $keyname
        ]);

        // Display the object in the browser.
        header("Content-Type: {$result['ContentType']}");
        header('Content-Disposition: attachment; filename='.$keyname);
        echo $result['Body'];
    } catch (S3Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
} else {
    echo "Download not authenticated";
}