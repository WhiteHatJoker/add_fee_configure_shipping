## Add fee for specific products while adjusting the shipping costs in the cart 
If you have a specific product that you would like to have a fixed fee for and adjust the shipping cost not to take that product into account accordingly, then you need the code from this repository. There are two seperate functions involved: 
1. `function wc_ninja_manipulate_shipping` which takes care of adjusting the shipping cost not to take into account a particular vendor products or product
2. `function woocommerce_custom_surcharge` that adds $30 surcharge fee below the shipping methods on its own line.
Keep in mind: I am using the Table Rate Shipping plugin as well as my shipping costs are based upon order total for this example.

# Installation for one product
1. Update [line 27](functions.php#L27)line 27 with your product ID 
4. 
5. 
6. Remove lines 15,16, 33-37 and update the product ID on line 
4. Within foreach loop on lines 25-38, write your own if check statement by copying one of the examples depending on whether you want to check for one product or range of products from a specific vendor. You just need to update the IDs either for product or for a vendor. For example:

# Installation for products from one vendor
1. Update line 
