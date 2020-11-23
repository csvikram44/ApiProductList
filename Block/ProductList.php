<?php

namespace CsVikram\ApiProductList\Block;

use Magento\Framework\View\Element\Template;

class ProductList extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getProductList()
    {
        //Display all products list
        //$productUrl='http://localhost/magento/rest/V1/products?searchCriteria';

        // Display single products by SKU
        $productUrl='http://localhost/magento/rest/V1/products/10001';
        $token = '8oj7tbw856bz0lcij9sadj1dp7p41fqr';

        $conn = curl_init();
        curl_setopt($conn, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($conn, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: Bearer $token"
            )
        );

        curl_setopt($conn, CURLOPT_URL, $productUrl);
        $productList = curl_exec($conn);
        $err      = curl_error($conn);
        $products = json_decode($productList);
        curl_close($conn);
        return $productList;
    }
}
