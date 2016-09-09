<?php

//Exclude Tsar Nicoulai products from subtotal to adjust shipping cost
//Exclude Tonewood Adoption products from subtotal to adjust shipping cost
function wc_ninja_manipulate_shipping( $rates, $package ) {
	// All available rates and their costs
	//print_r($rates);

	// All products in the cart and their costs
	//print_r($package);
        $tonewood_products_cost = 0;
        $tonewood_check = false;
        $tsar_products_total = 0;
        $tsar_check = false;
        //Add new product or vendor total and check boolean here
  	$adj_cart_subtotal = 0;
        $new_std_rate = 0;
        $new_day_rate = 0;
        $new_over_rate = 0;
        $cart_products = $package['contents'];

  	// Loop through each product in the cart
  	foreach ( $cart_products as $product ) {
  		//create new conditionals for new vendors or producst in cart
  		if ( $product['product_id'] =='29543' ) {
  			// If product ID 29543 is in cart or if Tonewood in cart remember its line total and turn tonewood_check true
			$tonewood_products_cost = $product['line_total'];
  			$tsar_check = true;
  		}

  		if ($product['data']->post->post_author == 40) {
			//If products with vendor id of 40 are in the cart, store the total of their costs and turn tsar_check true
                	$tsar_products_total = $tsar_products_total + $product['line_total'];
                	$tsar_check = true;
  		}
  	}
  	//update the line 38 with boolean for new product or vendor
  	if ($tsar_check || $tonewood_check) {
  		//update the line below with totals variable for new product or vendor
  		$adj_cart_subtotal = WC()->cart->subtotal - $tonewood_products_cost - $tsar_products_total;
  		if ($adj_cart_subtotal>=1 && $adj_cart_subtotal<=24) {
                	$new_std_rate=7.5;
                	$new_day_rate=17.5;
                	$new_over_rate=27.5;
  			
  		} elseif ($adj_cart_subtotal>=25 && $adj_cart_subtotal<=39) {
                	$new_std_rate=10;
                	$new_day_rate=20;
                	$new_over_rate=30;
  			
  		} elseif ($adj_cart_subtotal>=40 && $adj_cart_subtotal<=79) {
                	$new_std_rate=12.5;
                	$new_day_rate=22.5;
                	$new_over_rate=32.5;
  			
  		} elseif ($adj_cart_subtotal>=80 && $adj_cart_subtotal<=149) {
                	$new_std_rate=15;
                	$new_day_rate=25;
                	$new_over_rate=35;
            	} else {
                	$new_std_rate=0.11*$adj_cart_subtotal;
                	$new_day_rate=0.2*$adj_cart_subtotal;
                	$new_over_rate=0.3*$adj_cart_subtotal;
            		
            	}
            	
            	if (isset($rates['table_rate-9 : 23'])) {
                	$rates['table_rate-9 : 23']->cost = $new_over_rate;
            	} elseif (isset($rates['table_rate-9 : 22'])) {
            		$rates['table_rate-9 : 22']->cost = $new_over_rate;
            	} elseif (isset($rates['table_rate-9 : 21'])) {
            		$rates['table_rate-9 : 21']->cost = $new_over_rate;
            	} elseif (isset($rates['table_rate-9 : 20'])) {
            		$rates['table_rate-9 : 20']->cost = $new_over_rate;
            	} elseif (isset($rates['table_rate-9 : 19'])) {
            		$rates['table_rate-9 : 19']->cost = $new_over_rate;
            	}
            	if (isset($rates['table_rate-8 : 18'])) {
                	$rates['table_rate-8 : 18']->cost = $new_day_rate;
            	} elseif (isset($rates['table_rate-8 : 17'])) {
                	$rates['table_rate-8 : 17']->cost = $new_day_rate;
            	} elseif (isset($rates['table_rate-8 : 16'])) {
                	$rates['table_rate-8 : 16']->cost = $new_day_rate;
            	} elseif (isset($rates['table_rate-8 : 15'])) {
                	$rates['table_rate-8 : 15']->cost = $new_day_rate;
            	} elseif (isset($rates['table_rate-8 : 14'])) {
                	$rates['table_rate-8 : 14']->cost = $new_day_rate;
            	}
            	if (isset($rates['table_rate-7 : 13'])) {
                	$rates['table_rate-7 : 13']->cost = $new_std_rate;
            	} elseif (isset($rates['table_rate-7 : 12'])) {
                	$rates['table_rate-7 : 12']->cost = $new_std_rate;
            	} elseif (isset($rates['table_rate-7 : 11'])) {
                	$rates['table_rate-7 : 11']->cost = $new_std_rate;
            	} elseif (isset($rates['table_rate-7 : 10'])) {
                	$rates['table_rate-7 : 10']->cost = $new_std_rate;
            	} elseif (isset($rates['table_rate-7 : 9'])) {
                	$rates['table_rate-7 : 9']->cost = $new_std_rate;
            	}

        }
	return $rates;
}
add_filter( 'woocommerce_package_rates', 'wc_ninja_manipulate_shipping', 10, 2 );



/* Tsar Nicoulai Handling Fee*/
/*Tonewood Adoption Fee*/
add_action( 'woocommerce_cart_calculate_fees','woocommerce_custom_surcharge' );
function woocommerce_custom_surcharge() {
  global $woocommerce;
  $tonewoodfee = false;
  $tsarfee = false;
  $fixed = 30;

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
    	//add the check for a new product or vendors here
        if ($values['data']->id == 29543) {
            $tonewoodfee= true;
        }

        if ($values['data']->post->post_author == 40) {
            $tsarfee= true;
        }

    }

    if ($tsarfee) {
        $woocommerce->cart->add_fee( 'Tsar Nicoulai Shipping Fee', $fixed, true, '' );
    }
    if ($tonewoodfee) {
        $woocommerce->cart->add_fee( 'Tonewood Shipping Fee', $fixed, true, '' );
    }
    //add new conditional for new products in the cart as above
}
?>
