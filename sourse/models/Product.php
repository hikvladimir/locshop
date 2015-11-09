<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.11.2015
 * Time: 19:20
 */
require_once(ROOT.'/sourse/components/db.php');
class Product {

    const SHOW_BY_DEFAULT = 9;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1" ORDER BY id DESC '
            . 'LIMIT :count';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        // Получение и возврат результатов
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]=array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price'=> $row['price'],
                'is_new' => $row['is_new']
             );
            $i++;
        }
      return $productsList;
    }
}