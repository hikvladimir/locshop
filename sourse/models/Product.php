<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.11.2015
 * Time: 19:20
 */
require_once(ROOT.'/sourse/components/db.php');
class Product {

    const SHOW_BY_DEFAULT = 6;

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

    public static function getProductListByCategory($categoryId, $page=1)
    {

        $limit = Product::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status = 1 AND category_id = :category_id '
                . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

            $i=0;
            $products=array();
            while ($row = $result->fetch()){
                $products[$i]=array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'image'=> '', // $row['image'],
                    'price'=> $row['price'],
                    'is_new' => $row['is_new']
                );
                $i++;
            }
            return $products;


    }

    public static function getProductById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM product WHERE id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполнение коменды
        $result->execute();
        // Получение и возврат результатов
        return $result->fetch();
    }
    public static function getProdustsByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);
        // Текст запроса к БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";
        $result = $db->query($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }
    /**
     * Возвращает список рекомендуемых товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getRecommendedProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1" AND is_recommended = "1" '
            . 'ORDER BY id DESC');
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }
    public static function getTotalProductsInCategory($categoryId)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
}