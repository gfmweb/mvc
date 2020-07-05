<?php
/**
 *  Контроллер регистрации / авторизации / и восстановления доступа
 */

namespace controllers;


use core\ValidateAccess;
use models\UsersActions;
use models\AdminActions;

final class DverController
{
    /**
     * @param null $params
     * Принимает возможные данные в переменную params
     */

    public function login($params=null) // Метод авторизации
    {
        if(ValidateAccess::ValidAccess($params)) // Если форма пришла с нашего сайта то начинаем искать пользователя
        {

            if(UsersActions::findUser($params,'CheckLogin')) // Передаем в метод FindUser входящие параметры и ключ ПРОВЕРЬ ВХОД ПОЛЬЗОВАТЕЛЯ
            {
                if(!isset($_SESSION['alert']))
                {
                    $_SESSION['success']="Добро пожаловать ".$_SESSION['User']." !"; // Если нет ошибки активации аккаунта

                }
            }
            else
            {
                $_SESSION['alert']="Неверное имя пользователя или пароль"; // Если есть ошибка
            }

            header('Location: /'); // Возвращаем на индексную страницу
        }
        else{
            Header('Location: /404.php?er_title='.urlencode("УПС! Отказ обработки формы").'&description='.urlencode("Форма не прошла проверку правомерности использования").'&action='.urlencode("<a href=\"http://".$_SERVER['SERVER_NAME']."\">Вернуться на сайт</a>"));// Если форма была подделана
        }

    }

    public function register($params=null) // Метод регистрации
    {
        if(ValidateAccess::ValidAccess($params)) // Если форма пришла с нашего сайта то проверяем уникальность пользователяпользователя
        {
            if(UsersActions::findUser($params,'CheckUniq')) // Передаем в метод FindUser входящие параметры и ключ ПРОВЕРЬ УНИКАЛЬНОСТЬ ПОЛЬЗОВАТЕЛЯ
                {
                    UsersActions::RegisterUser($params); // Передаем все параметры методу регистрации пользователя
                    $_SESSION['success']='Для активации аккаунта, пожалуйста пройдите по ссылке из письма отправленного Вам'; // Записываем сообшение для пользователя

                }
            else
                {
                    $_SESSION['alert']='Ваш E-mail уже зарегистрирован в системе, попробуйте войти с его помощью'; // Говорим о том что такая почта у нас уже есть

                }

            header('Location: /'); // Возвращаем пользователя на индексную страницу
        }
        else{
            Header('Location: /404.php?er_title='.urlencode("УПС! Отказ обработки формы").'&description='.urlencode("Форма не прошла проверку правомерности использования").'&action='.urlencode("<a href=\"http://".$_SERVER['SERVER_NAME']."\">Вернуться на сайт</a>"));// Если форма была подделана
        }
    }

    public function remind($params=null) // Метод восстановления пароля
    {
        if(ValidateAccess::ValidAccess($params)) // Если форма пришла с нашего сайта то Работаем
        {
            UsersActions::Remind($params); // Передаем все в метод восстановления пароля
            header("Location: /"); // Редиректим на индексную страницу
        }
        else{
            Header('Location: /404.php?er_title='.urlencode("УПС! Отказ обработки формы").'&description='.urlencode("Форма не прошла проверку правомерности использования").'&action='.urlencode("<a href=\"http://".$_SERVER['SERVER_NAME']."\">Вернуться на сайт</a>"));// Если форма была подделана
        }
    }

    public function activate($params=null) // подтверждение учетной записи (E-mail) Не поддерживает проверку формы т.к. не использует её
    {
        $re=UsersActions::TryActivate($params); // Передаем всё в метод ПРОБУЕМ АКТИВИРОВАТЬ
        if($re===1) // Если вернулся положительный результат
        {
            $_SESSION['success']="Ваш E-mail был успешно подтвержден. Теперь Вы можете авторизироваться на сайте"; // Записываем сообщение для пользователя
            header("Location: /"); // Редиректим на индексную страницу
        }
    }
    public function update($params=null) //Метод изменения учетных данных пользователя
    {
        if(ValidateAccess::ValidAccess($params)) // Если форма пришла с нашего сайта то Работаем
        {
           $result=UsersActions::Update($params); // Передаем все данные методу АПДЕЙТ
           $action = stripos($result, "email"); // Проверяем был ли изменен почтовый ящик пользователя

          if ($action === false) { // Если почта не была изменена
                $_SESSION['success']='Изменения успешно внесены'; // Записываем сообщение для пользователя
            }
            else // Если почта была изменена
            {
                unset($_SESSION['User']); // Разлогиниваем пользователя
                $_SESSION['success']='Вы изменили свой почтовый ящик и Мы вновь отправили Вам письмо чтобы его подтвердить. Пожалуйста проверьте почту, Подтвердите Свой ящик, и снова сможете пользоваться сайтом'; // Записываем сообщение
            }
         header('Location: /'); // Перемещаем пользователя на индексную страницу
        }
    }
    public function changeform($params=null) // Метод смены форм окон регистрации / входа / восстановления пароля РАБОТАЕТ через Ajax
    {
        $data=UsersActions::ChangeFormModal($params);  // Передаем параметры методу
        echo(json_encode($data)); // Отвечаем в json формате
    }

    public function Adminlogin($params=null)
    {
        if((ValidateAccess::ValidAccess($params))&& (AdminActions::checkPassword($params))){ // Если форма валидна
            echo('Админ залогинен');
        }
    }
}