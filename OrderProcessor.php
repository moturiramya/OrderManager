<?php
/* Process the order. Ignores the orders that have invalid quantities.
*/
class OrderProcessor {
	const MAX_ORDER_LIMIT = 5;
 	const MIN_ORDER_LIMIT = 1; 

 	function processOrder($order,&$quantityAvailable, &$output) {
		$orderInfo = json_decode($order);
 		if(count($orderInfo->Products) == 0) {
			return;
		} 
		$ordersList = $orderInfo->Products; 
		$outputStr = '';
		foreach($ordersList as $orderDetails ) {
			if($orderDetails->Quantity < OrderProcessor::MIN_ORDER_LIMIT ||
		   		$orderDetails->Quantity> OrderProcessor::MAX_ORDER_LIMIT	
			) {
				continue;
			}
			$productName = $orderDetails->Product;
			$currentAvailableQuantity = $quantityAvailable[$productName];
			$orderQuantity = $orderDetails->Quantity;
			if(($currentAvailableQuantity - $orderQuantity) > -1 ) {
				$quantityAvailable[$productName] = $currentAvailableQuantity - $orderQuantity;
				if($outputStr != "") {
					$outputStr .= ',';
				}
				$outputStr .= $productName.'-'.$orderQuantity;
			}
		}
		if($outputStr!='') {
			if(isset($output[$orderInfo->Header])) {
				$output[$orderInfo->Header] = $output[$orderInfo->Header] ."::".$outputStr;
			} else {
				$output[$orderInfo->Header] = $outputStr;
			}
		}	
 	} 

}

?>

