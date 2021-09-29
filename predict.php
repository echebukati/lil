<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'vendor/autoload.php';

use Aws\FraudDetector\FraudDetectorClient;
use Aws\FraudDetector\Exception;

$client = new Aws\FraudDetector\FraudDetectorClient([
    'region'  => 'us-east-1',
    'version' => '2019-11-15'
]);

echo "predict<br>";

$result = $client->getEventPrediction([
    'detectorId' => 'detector-getting-started', // REQUIRED
    'detectorVersionId' => '1',
    'entities' => [ // REQUIRED
        [
            'entityId' => 'hello1', // REQUIRED
            'entityType' => 'customer', // REQUIRED
        ],
    ],
    'eventId' => 'hello1', // REQUIRED
    'eventTimestamp' => '2019-08-10T20:44:00Z', // REQUIRED
    'eventTypeName' => 'loanpay', // REQUIRED
    'eventVariables' => [ // REQUIRED
        'ip_address' => '36.19.221.248',
        //'email_address' => ""
    ]
]);

//echo $result;
echo $result["modelScores"][0]["scores"]["fake_loan_detection_model_insightscore"];
echo "<br>";
echo $result["ruleResults"][0]["outcomes"][0];