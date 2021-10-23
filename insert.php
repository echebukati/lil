<center>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

date_default_timezone_set('US/Eastern');

require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\FraudDetector\FraudDetectorClient;
use Aws\FraudDetector\Exception;

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

$amount = $_POST['amount'];
$period = $_POST['months'];

// Escape user inputs for security
//$period = mysqli_real_escape_string($link, $period);


if (isset($period)) {
	$divamount = ($amount*0.1) + $amount;
	$installments = $divamount / (int)$period;
	$installments = (int)$installments;
}

// attempt insert query execution
$sql = "INSERT INTO transactions (user_id, amount, period, installments) VALUES ('$username', '$amount', '$period', '$installments')";

if(mysqli_query($link, $sql)) {
	$insertid = mysqli_insert_id($link);
	echo "Records added successfully.<br>";

	//STARTFILEUPLOAD
	if(isset($_FILES['image'])) {

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

		//var_dump($result);

		echo "Successful upload.<br>";

		/*
		//CHECK FOR FRAUD
		$client = new Aws\FraudDetector\FraudDetectorClient([
			'region'  => 'us-east-1',
			'version' => '2019-11-15'
		]);

		$entityid = strval(rand(1,10000));

		$result = $client->getEventPrediction([
			'detectorId' => 'lender_fraud_detector', // REQUIRED
			'detectorVersionId' => '1',
			'entities' => [ // REQUIRED
				[
					'entityId' => $entityid, // REQUIRED
					'entityType' => 'lender', // REQUIRED
				],
			],
			'eventId' => $entityid, // REQUIRED
			'eventTimestamp' => date('Y-m-d\TH:i:00\Z', time()), // REQUIRED
			'eventTypeName' => 'offerloan', // REQUIRED
			'eventVariables' => [ // REQUIRED
				'ip_address' => '27.220.141.61',
				'email_address' => $username
			]
		]);

		//echo $result;
		echo "<br>";
		echo "Fraud Score: ". $result["modelScores"][0]["scores"]["fraudulent_lender_detection_model_insightscore"];
		echo "<br>";
		$outcome = $result["ruleResults"][0]["outcomes"][0];
		echo "Outcome: ". $outcome;
		echo "<br>";
		if ($outcome == "reject") {
			echo "Failed. Your account is banned due to fraud. Contact support.";
			return;
		}

		//END CHECK FOR FRAUD
		*/
	}
	//ENDFILEUPLOAD

	echo "You have offered a <b>$".$amount."</b> loan.<br>";
	echo "Recipient will pay you back <b>$". $installments . "</b> every month for <b>".$period."</b> months.<br><br>";
	echo "Proceeding to payment...";
}
else {
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);

?>
</center?