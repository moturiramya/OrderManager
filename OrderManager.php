<?php
 include('OrderGenerator.php');
 include('OrderQueue.php');
 include('OrderProcessor.php');

 $quantityAvailable = array("A"=>150,"B"=>150,"C"=>100,"D"=>100,"E"=>200);

 //Generates random number of orders and adds it to the Queue
 $orderGenerator = new OrderGenerator();
 $orderGenerator->generateOrders();

 $output = array();
 $orderProcessorObj = new OrderProcessor();
 $orderQueueObj = new OrderQueue();
 print_r("/* Input is generated randomly using OrderGenerator class*/\nInput Queue:\n");
 $orderQueueObj->printQueue();

 //Go through the Queue and process the order
 while($orderQueueObj->getSize() >0)
 {
	//If inventory is empty then halt
        if(!checkIfProductsExists($quantityAvailable)) {
                break;
        }
        $orderFromQueue = $orderQueueObj->getOrderFromQueue();
        $orderProcessorObj->processOrder($orderFromQueue, $quantityAvailable,$output);

 }

 
 print_r("\n/* Output stream only shows valid orders and ignores all invalid orders\nOutput:\n");
 print_r($output);


//Checks inventory for the product availability
function checkIfProductsExists($quantityAvailable) {
        foreach($quantityAvailable as $product=>$quantity) {
                if($quantity > 0) {
                        return true;
                }
        }
        return false;
}

?>
