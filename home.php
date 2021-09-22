<?php
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
	header ("Location: index.php");
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
    <input name="months" type="text" placeholder="Payback Period (Months)" /><br>
    <input type="file" name="image" /><br>
    <input type="submit" value="Apply"/>
</form>
</body>
</html>
