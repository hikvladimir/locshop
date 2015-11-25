<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2015
 * Time: 18:32
 */



class SiteController {

    public function actionIndex(){

        $categores=array();
        $categores=Category::getCategoryList();
        $lastProduct=array();
        $lastProduct=Product::getLatestProducts();

        require_once(ROOT.'/sourse/views/index.php');
        return true;
    }

}