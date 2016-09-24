## Add fee for specific products while adjusting the shipping costs in the cart 
If you have a specific product that you would like to have a fixed fee for and adjust the shipping cost not to take that product into account accordingly, then you need the code from this repository. There are two seperate functions involved: 
1. `function wc_ninja_manipulate_shipping` which takes care of adjusting the shipping cost not to take into account a particular vendor products or product
2. `function woocommerce_custom_surcharge` that adds $30 surcharge fee below the shipping methods on its own line.
Keep in mind: I am using the Table Rate Shipping plugin as well as my shipping costs are based upon order total for this example.

# Installation for one product
1. Update [line 27](functions.php#L27) with your own product ID.
2. Update [line 40](functions.php#L40) by removing `$tsar_check || ` as you only need to check for a product.
3. Update [line 42](functions.php#L42) by removing ` - $tsar_products_total`.
4. Set your own rates on [lines 43-67](functions.php#L43-L67) based on what is the adjusted_subtotal.
5. Change code on [lines 68-101](functions.php#L68-L101) based on the IDs you have for shipping methods (mine is set as such by Table Rate Shipping plugin).
6. Again update [line 125](functions.php#L125) with your own product ID.
7. Finally, on [line 136](functions.php#L136) update `'Tonewood Shipping Fee', $fixed` with `'Your preffered naming', fee amount`.
6. Now you can remove unnecessary lines of code [lines 15-16](functions.php#L15-L16), [33-37](functions.php#L33-L37), [116](functions.php#L116), [129-131](functions.php#L129-L131), [135-137](functions.php#L135-L137).


# Installation for products from one vendor
1. Update [line 33](functions.php#L33) with your own vendor ID.
2. Update [line 40](functions.php#L40) by removing ` || $tonewood_check` as you only need to check for vendor products.
3. Update [line 42](functions.php#L42) by removing ` - $tonewood_products_cost`.
4. Set your own rates on [lines 43-67](functions.php#L43-L67) based on what is the adjusted_subtotal.
5. Change code on [lines 68-101](functions.php#L68-L101) based on the IDs you have for shipping methods (mine is set as such by Table Rate Shipping plugin).
6. Again update [line 129](functions.php#L129) with your own vendor ID.
7. Finally, on [line 139](functions.php#L139) update `'Tsar Nicoulai Shipping Fee', $fixed` with `'Your preffered naming', fee amount`.
8. Now you can remove unnecessary lines of code [lines 13, 14] (functions.php#L13-L14), [27-31] (functions.php#L27-L31), [115](functions.php#L115), [125-127](functions.php#L125-L127), [138-140](functions.php#L138-L140).
