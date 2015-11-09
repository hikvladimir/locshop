<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.10.2015
 * Time: 22:15
 */

class ProductController {
    public function actionView($parameters)
    {
       //print_r($parameters);
       require_once(ROOT.'/sourse/views/product/view.php');
       return true;

    }
}