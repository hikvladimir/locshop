<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2015
 * Time: 18:32
 */

include ROOT.'/sourse/models/Category.php';

class SiteController {

    public function actionIndex(){

        $categores=array();
        $categores=Category::getCategoryList();

        require_once(ROOT.'/sourse/views/index.php');
        return true;
    }

}