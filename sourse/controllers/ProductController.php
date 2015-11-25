<?php

class ProductController {
    public function actionView($productId)
    {
        $categores=array();
        $categores=Category::getCategoryList();

        // Получаем инфомрацию о товаре
        $product = Product::getProductById($productId);

        require_once(ROOT.'/sourse/views/product/view.php');
       return true;

    }
}