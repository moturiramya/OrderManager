<?php
/* Queues the orders. I used array for simplicity. 
 * Since the implemention of queue is abstracted in this class we can change the implementation from array to  any sophisticated data structure or even replace it with database calls 
 *
*/
class OrderQueue {
        static $lastIndex = 0;
        static $firstIndex = 0;
        static $queue = array();
    
        function addOrderToQueue($order) {
                OrderQueue::$queue[OrderQueue::$lastIndex] = $order;
                OrderQueue::$lastIndex++;
        }

        function getOrderFromQueue() {
                return OrderQueue::$queue[OrderQueue::$firstIndex++];
        }

        function getSize() {
                $size = OrderQueue::$lastIndex - OrderQueue::$firstIndex;
                return $size;
        }

        function printQueue() {
                for($i=OrderQueue::$firstIndex;$i<OrderQueue::$lastIndex;$i++) {
                        print_r(OrderQueue::$queue[$i]);
                        print_r("\n");
                }
        }

}

?>
