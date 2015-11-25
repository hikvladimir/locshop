<?php


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
    public function actionCategory($categoryId, $page=1)
    {
        echo 'cat'.$categoryId;
        echo '<br>act'.$page;

        $categores=array();
        $categores=Category::getCategoryList();

        $categoryProducts=array();
        $categoryProducts=Product::getProductListByCategory($categoryId, $page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($categoryId);
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT.'/sourse/views/catalog/category.php');
        return true;


    }

}