<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../Resources/ExternalConfiguration.php';

function CreateInstrumentIdentifierCardEnrollForNetworkToken()
{
	$profileid = '93B32398-AD51-4CC2-A682-EA3E93614EB1';

	$cardArr = [
		"number" => "4622943127013705",
		"expirationMonth" => "12",
		"expirationYear" => "2022",
		"securityCode" => "838"
	];
	$card = new CyberSource\Model\Tmsv1instrumentidentifiersCard($cardArr);

	$billToArr = [
		"address1" => "8310 Capital of Texas Highway North",
		"address2" => "Bluffstone Drive",
		"locality" => "Austin",
		"administrativeArea" => "TX",
		"postalCode" => "78731",
		"country" => "US"
	];
	$billTo = new CyberSource\Model\Tmsv1instrumentidentifiersBillTo($billToArr);

	$requestObjArr = [
		"type" => "enrollable card",
		"card" => $card,
		"billTo" => $billTo
	];
	$requestObj = new CyberSource\Model\CreateInstrumentIdentifierRequest($requestObjArr);


	$commonElement = new CyberSource\ExternalConfiguration();
	$config = $commonElement->ConnectionHost();
	$merchantConfig = $commonElement->merchantConfigObject();

	$api_client = new CyberSource\ApiClient($config, $merchantConfig);
	$api_instance = new CyberSource\Api\InstrumentIdentifierApi($api_client);

	try {
		$apiResponse = $api_instance->createInstrumentIdentifier($profileid, $requestObj);
		print_r(PHP_EOL);
		print_r($apiResponse);

		return $apiResponse;
	} catch (Cybersource\ApiException $e) {
		print_r($e->getResponseBody());
		print_r($e->getMessage());
	}
}

if(!defined('DO_NOT_RUN_SAMPLES')){
	echo "\nCreateInstrumentIdentifierCardEnrollForNetworkToken Sample Code is Running..." . PHP_EOL;
	CreateInstrumentIdentifierCardEnrollForNetworkToken();
}
?>
