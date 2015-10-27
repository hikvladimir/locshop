<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2015
 * Time: 18:40
 */

class Db {

    public static function getConnection(){
        $paramsPath=ROOT.'/sourse/components/db_params.php';
        $params=include($paramsPath);


        $dsn="mysql:host={$params['host']};dbname={$params['dbname']}";
        $db=new PDO($dsn,$params['user'],$params['password']);

        return $db;


}

}