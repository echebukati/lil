<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
	header ("Location: index.php");
}

$conn = new mysqli("fintechclouddb.cnydfygbrhuz.us-east-1.rds.amazonaws.com", "fintech", "wC!viIkBek@6", "fintechdb");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$username = ($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
<title>$100 Instant Loans</title>
</head>
<body>
<h2>$100 Instant Loans</h2>
<h3>Enter Period Between 1 and 12 Months</h3>
<form method="post" action="insert.php" enctype="multipart/form-data">
    <input name="months" type="text" placeholder="Payback Period (Months)" required/><br>
    <input type="file" name="image" required/><br>
    <input type="submit" value="Apply"/>
</form>

<?php
$query = $conn->query("SELECT * FROM `transactions` WHERE user_id = '$username'");
if (mysqli_num_rows($query)) {
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
        echo "<a target='_blank' href='download.php?id=".$row['id']."'>Download</a><br>";
    }
}
?>

</body>
</html>
