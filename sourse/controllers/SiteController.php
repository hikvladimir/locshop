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
    public function actionContact(){
        // Переменные для формы
        $userEmail = false;
        $userText = false;
        $result = false;
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            // Флаг ошибок
            $errors = false;
            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if ($errors == false) {
                // Если ошибок нет
                // Отправляем письмо администратору
                $adminEmail = 'psihouse@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        // Подключаем вид
        require_once(ROOT . '/sourse/views/site/contact.php');
        return true;
    }

}