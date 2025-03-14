<?php
session_start();
$json = array();
include('class/Cart.php');
$cart = new Cart();
$cart->setSKU($_POST["sku"]);
$productByCode = $cart->getProduct();

if(!empty($_POST["quantity"])) {
	$itemArray = array($productByCode["sku"]=>array('name'=>$productByCode["name"], 'sku'=>$productByCode["sku"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));
	
	if(!empty($_SESSION["cart_item"])) {
		if(in_array($productByCode["sku"],array_keys($_SESSION["cart_item"]))) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($productByCode["sku"] == $k) {
						if(empty($_SESSION["cart_item"][$k]["quantity"])) {
							$_SESSION["cart_item"][$k]["quantity"] = 0;
						}
						$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
					}
			}
		} else {
			$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
		}
	} else {
		$_SESSION["cart_item"] = $itemArray;
	}
	$json['count'] = count($_SESSION["cart_item"]);
}
header('Content-Type: application/json');
echo json_encode($json);		
?>

