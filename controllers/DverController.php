<?php
/**
 *  Контроллер регистрации / авторизации / и восстановления доступа
 */

namespace controllers;


use models\ValidateAccess;
use models\UsersAtions;

final class DverController
{
    /**
     * @param null $params
     */

    public function login($params=null)
    {
        if(ValidateAccess::ValidAccess($params)) // Если форма пришла с нашего сайта то начинаем искать пользователя
        {

            if(UsersAtions::findUser($params,'CheckLogin'))
            {
                if(!isset($_SESSION['alert'])) // Если нет ошибки активации аккаунта
                {
                $_SESSION['success']="Добро пожаловать ".$_SESSION['User']." !";
                }
            }
            else
            {
                $_SESSION['alert']="Неверное имя пользователя или пароль";
            }
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
        else{
            Header('Location: http://'.$_SERVER['SERVER_NAME'].'/404.php?er_title='.urlencode("УПС! Отказ обработки формы").'&description='.urlencode("Форма не прошла проверку правомерности использования").'&action='.urlencode("<a href=\"http://".$_SERVER['SERVER_NAME']."\">Вернуться на сайт</a>"));
        }

    }

    public function register($params=null)
    {
        if(ValidateAccess::ValidAccess($params)) // Если форма пришла с нашего сайта то проверяем уникальность пользователяпользователя
        {
            if(UsersAtions::findUser($params,'CheckUniq')) // Если пользователь уникален  то просто его регистрируем
                {
                    UsersAtions::RegisterUser($params);
                    $_SESSION['success']='Для активации аккаунта, пожалуйста пройдите по ссылке из письма отправленного Вам';

                }
            else
                {
                    $_SESSION['alert']='Ваш E-mail уже зарегистрирован в системе, попробуйте войти с его помощью';

                }
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
    }

    public function remind($params=null)
    {
        if(ValidateAccess::ValidAccess($params)) // Если форма пришла с нашего сайта то Работаем
        {
            UsersAtions::Remind($params);
            header("Location: http://".$_SERVER['SERVER_NAME']);
        }
    }

    public function activate($params=null) // подтверждение учетной записи (E-mail)
    {
        $re=UsersAtions::TryActivate($params);
        if($re===1)
        {
            $_SESSION['success']="Ваш E-mail был успешно подтвержден. Теперь Вы можете авторизироваться на сайте";
            header("Location: http://".$_SERVER['SERVER_NAME']);
        }
    }

}