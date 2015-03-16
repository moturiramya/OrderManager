<?php
/* Generates the orders and adds it to the orderQueue
 *   - Number of orders are random
 *   - Header name is random
 *   - Product count in an order is random
 *   - Product name is random
 *   - Product quantity is random
 *
 *   There is upper limit and limitations on the counts and names for simplicity
 *  
*/
class OrderGenerator {
        const MAX_HEADERS = 5;
        const MAX_ORDERS = 10;

        private function getProducts() {
                return array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E');
        }

        public function generateOrders() {
                $orderCount =(rand()%OrderGenerator::MAX_ORDERS) +1;
                $orderQueueObj = new OrderQueue();
                for($i=0;$i<$orderCount;$i++) {
                        $order = array();
                        $order['Header'] = rand()%OrderGenerator::MAX_HEADERS;
                        $products = array();
                        $productCount = rand()%3;
                        //to avoid zero number of products in the order
                        $productCount++;
			$productsUsedInOrder = array();
                        for($j=0; $j< $productCount; $j++) {
                                $productDetails = array();
                                $productKey = rand()%5;
                                $productArr = $this->getProducts();
				$product = $productArr[$productKey];
				if(in_array($product,$productsUsedInOrder)) {
					continue;
				}
                                $productDetails['Product'] = $product;
                                $productDetails['Quantity'] = rand()%8;
                                array_push($products,$productDetails);
				
     				//to avoid repetetion of the same product in the same order
				array_push($productsUsedInOrder,$product);
                        }
                        $order['Products'] = $products;

                        $orderQueueObj->addOrderToQueue(json_encode($order));
                }
        }

}
?>
