<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2015
 * Time: 17:57
 */
require_once(ROOT.'/sourse/components/db.php');
class Category {

    public static function getCategoryList()
    {
        $db=Db::getConnection();
        $categoryList=array();

        $result = $db->query('SELECT id, name FROM category WHERE status = "1" ORDER BY sort_order, name ASC');

        $i=0;
       // var_dump($result);
        while ($row=$result->fetch()) {

            $categoryList[$i] = array(
                'id' => $row['id'],
                'name' => $row['name']
            );

            $i++;
        }

        return $categoryList;
    }

}