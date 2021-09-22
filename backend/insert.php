<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
require 'vendor/autoload.php';
//require __DIR__ . '/vendor/autoload.php';
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
    header ("Location: index.php");
}
$username = ($_SESSION['username']);

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("fintechclouddb.cnydfygbrhuz.us-east-1.rds.amazonaws.com", "fintech", "wC!viIkBek@6", "fintechdb");
 
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
//$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
//$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
//$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$period = $_POST['months'];

if (isset($period)) {
    $installments = 100 / (int)$period;
    $installments = (int)$installments;
}
 
// attempt insert query execution
$sql = "INSERT INTO transactions (user_id, amount, period, installments) VALUES ('$username', '100', '$period', '$installments')";
if(mysqli_query($link, $sql)) {
    $insertid = mysqli_insert_id($link);
    echo "Records added successfully.<br>";
    echo "You have received your <b>$100</b> loan!<br>";
    echo "You will pay back <b>$". $installments . "</b> for <b>".$period."</b> months.";

    //STARTFILEUPLOAD
    if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];   
		$temp_file_location = $_FILES['image']['tmp_name']; 

		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-east-1',
			'version' => 'latest'
		]);		

		$result = $s3->putObject([
			'Bucket' => 'testfintechbucket',
			'Key'    => $insertid.".pdf",
			'SourceFile' => $temp_file_location			
		]);

		var_dump($result);
	}
    //ENDFILEUPLOAD

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>
