<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set('US/Eastern');

require 'vendor/autoload.php';

use Aws\FraudDetector\FraudDetectorClient;
use Aws\FraudDetector\Exception;

$client = new Aws\FraudDetector\FraudDetectorClient([
    'region'  => 'us-east-1',
    'version' => '2019-11-15'
]);

echo "predict<br>";
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
        'email_address' => 'emmanuel'
    ]
]);

//echo $result;
echo $result["modelScores"][0]["scores"]["fraudulent_lender_detection_model_insightscore"];
echo "<br>";
echo $result["ruleResults"][0]["outcomes"][0];