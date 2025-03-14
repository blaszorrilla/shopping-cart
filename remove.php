<?php
session_start();
$json = array();
$total_quantity = 0;
$total_price = 0;
$count = 0;
if(!empty($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0) {
	if(!empty($_SESSION["cart_item"])) {
		foreach($_SESSION["cart_item"] as $k => $v) {
				if($_POST["sku"] == $k)
					unset($_SESSION["cart_item"][$k]);				
				if(empty($_SESSION["cart_item"]))
					unset($_SESSION["cart_item"]);
		}
	}
	$bindHTML = '';
	foreach ($_SESSION["cart_item"] as $item){
		$total_quantity += $item["quantity"];
		$total_price += ($item["price"]*$item["quantity"]);
	}
	$count = count($_SESSION["cart_item"]);
	$json['total_quantity'] = $total_quantity;
	$json['total_price'] = number_format($total_price, 2);
	$json['count'] = $count;
}
header('Content-Type: application/json');
echo json_encode($json);