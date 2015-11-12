<?php

include_once ROOT.'/sourse/models/Category.php';
include_once ROOT.'/sourse/models/Product.php';

class CatalogController {

    public function actionIndex()
    {
        $categores=array();
        $categores=Category::getCategoryList();

        $lastProduct=array();
        $lastProduct=Product::getLatestProducts();

        require_once(ROOT.'/sourse/views/catalog/index.php');
        return true;
    }

}