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
<title>Sample P2P Lending App</title>
<style>table, th, td {border: 1px solid black;border-collapse: collapse;}</style>
</head>
<body>
<center>
<h2>Sample P2P Lending App</h2>
<br>
<h3>Offer Loan</h3>
<form method="post" action="insert.php" enctype="multipart/form-data">
    <label><b>Amount</b></label>
    <input name="amount" type="text" placeholder="Amount" required/><br>
    <label><b>Period</b></label>
    <input name="months" type="text" placeholder="Payback Period (Months)" required/><br>
    <label><b>File Attachment</b></label>
    <input type="file" name="image" required/><br><br>
    <input type="submit" value="Apply"/>
</form>
<br><br>
<h3>Previous Loan Offers</h3>
<?php
$query = $conn->query("SELECT * FROM `transactions` WHERE user_id = '$username'");
if (mysqli_num_rows($query)) {
    ?>
    <table>
        <tr>
            <td><b>Offered Amount</b></td>
            <td><b>Period (Months)</b></td>
            <td><b>Installments of</b></td>
            <td><b>File Attachment</b></td>
        </tr>
    <?php
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            echo '<tr>';
            echo '<td>$'.$row['amount'].'</td>';
            echo '<td>'.$row['period'].'</td>';
            echo '<td>$'.$row['installments'].'</td>';
            echo "<td><a target='_blank' href='download.php?id=".$row['id']."'>Download</a><br></td>";
            echo '</tr>';
        }
    echo '</table>';
}
?>
</center>
</body>
</html>