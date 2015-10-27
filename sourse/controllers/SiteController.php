<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2015
 * Time: 18:32
 */

class SiteController {

    public function actionIndex(){

        require_once(ROOT.'/sourse/views/index.php');
        return true;
    }

}