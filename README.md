# wc-ccs
Custom Cross Sells - WooCommerce

This plugin makes it possible to show cross-sells on a single product page in woocommerce. After I tried various other solutions, this is what worked for me. This plugin is specifically designed for the shopkeeper theme which can be found under https://themeforest.net/item/shopkeeper-ecommerce-wp-theme-for-woocommerce/9553045 . 

## How to customize it?
If you want to make it compatible with your theme I recommend you take a look at your woocoommerce plugin folder and examine the content of the related.php file which can be found in: /wp-content/plugins/woocommerce/templates/single-product/related.php

The code should look somewhat like this:
![alt text](https://user-images.githubusercontent.com/12101091/31451328-1f414d90-aeac-11e7-88f5-c46bab75d8fc.png)


Find something similar to <section class="related products"> or <div class="someotherclasses"> and change the corresponding lines in the ccs.php file of this repository. Additionally if you want to change the heading of this section just change the <h2> value to something you like.

## How to use it?
Either download ccs.php then change it to your needs, put it in a folder and upload to your plugins section with ftp, or do everything except the ftp part, compress it to a zip file and upload it on your wordpress site.
