<?php 



function presetPrice($price){
	
	
	$newprice = intval($price)/100;

	return '$'.number_format($newprice,2);
}


function presetPrices($price){

    	return '$ '.number_format($price / 100,2);
    }
