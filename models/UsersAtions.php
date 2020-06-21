<?php


namespace models;

use config\Db;
use models\Mail;

class UsersAtions
{

    public static function findUser($params=null,$action=null) // поиск пользователя в БД и проверка его входа/ либо проверка уникальности почты
    {
        if(is_array($params)) // Если нам скормили нормальный массив данных
        {

            for($i = 0, $iMax = count($params); $i < $iMax; $i++) // Перебираем массив и ищем интересующий нас ключ
            {
                if($params[$i]['param'] === 'UserEmail') {
                    $mail=$params[$i]['val'];
                    $db = Db::init();
                    $result = $db->query("SELECT * FROM `users` WHERE `email` = '{$db->escape_string($params[$i]['val'])}' ");
                    $user = $result->fetch_assoc(); break; // пользователь помещен в массив Прекращаем цикл
                }
            }

            if(isset($user['email'][0])) // если такой пользователь найден, то проверяем его дальше
            {

                if($action==="CheckLogin") // проверяем персональный экшен для этого поиска
                {
                    for($i=0,$iMax=count($params); $i < $iMax; $i++) // перебираем массив переменных дл поиска пароля
                    {
                        if(($params[$i]['param']==='UserPassword')&&(password_verify($params[$i]['val'],$user['password']))) //Если всё совпало
                        {
                            $pass=$user['password'];
                           if($user['confirm']!=='0') // Если пользователь прошел подтверждение его почты
                               {

                                   $_SESSION['User'] = $user['name']; // Записали в сессию как зовут пользователя
                                   $_SESSION['User_info'] = $user;
                                   return true;
                                   break; // возвращаем ТРУ
                               }
                           else // Если пользователь не подтвердил свой ящик
                               {

                                   $_SESSION['alert']='Вы не подтвердили свой E-mail. На всякий случай мы повторно отправили Вам письмо с подтверждением Пожалйуста проверьте почту';
                                   $name=$user['name'];
                                   $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                                   $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                                   $mail_send->send($mail, "Подтверждение почтового ящика. Повторное письмо", "<h3>Здравствуйте ".$name."!</h3><p>Вы получили это письмо для подтверждения регистрации на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$pass."&mail=".$mail."'>https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$pass."&mail=".$mail."</a></p>");
                                   return true;
                                   break; // возвращаем ТРУ
                               }
                           }
                        }
                    }
                }
            }
            if($action==="CheckUniq")// Если пользователь небыл найден то возможно мы просто проверяем его уникальность
            {

              return true ;
            }

        }

    public static function RegisterUser($params = null) // Регистрация пользователя
    {
        for($i=0,$iMax=count($params); $i < $iMax; $i++) // Собираем необходимые данные для регистрации Имя пользователя
        {
            if($params[$i]['param']==='UserName')
            {
                $user=$params[$i]['val']; break;
            }
        }
        for($i=0,$iMax=count($params); $i < $iMax; $i++) //  Собираем необходимые данные для регистрации Почта пользователя
        {
            if(($params[$i]['param']=== 'UserEmail') && (filter_var($params[$i]['val'], FILTER_VALIDATE_EMAIL) !== false)) // Если пота прошла валидацию
            {

                $mail=$params[$i]['val']; break;
            }
        }
        for($i=0,$iMax=count($params); $i < $iMax; $i++) //  Собираем необходимые данные для регистрации Пароль пользователя
        {
            if($params[$i]['param']==="UserPassword")
            {
                $pass=$params[$i]['val'];break;
            }
        }

        if(isset($user, $mail, $pass)) // проверяем готовность к регистрации И если всё есть то начинаем писать пользователя  Базу
        {

            $db = Db::init(); // Инициализируем БД
            $pass=password_hash($pass,PASSWORD_DEFAULT); // Защищаем пароль
            $mail=$db->escape_string($mail); // Экранируем Емайл
            $user=$db->escape_string($user); // Экранируем Имя
            $db->query("INSERT INTO `users` SET `email` = '".$mail."', `password` = '".$pass."', `name` = '".$user."' ");// Добавляем в БД
            $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
            $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
            $mail_send->send($mail, "Подтверждение почтового ящика", "<h3>Здравствуйте ".$user."!</h3><p>Вы получили это письмо для подтверждения регистрации на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$pass."&mail=".$mail."'>https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$pass."&mail=".$mail."</a></p>");
        }

    }

    public static function TryActivate($params = null) // Попытка подтвердить E-mail пользователя
    {
            $db = Db::init(); // Инициализируем БД
            $db->query("UPDATE `users` SET `confirm` = '1' WHERE `password` = '".$params[0]['val']."' AND `email`='".$params[1]['val']."' ");  // Возвращаем результат попытки обновления
            return $db->affected_rows;

    }

    public static function Remind($params=null) // Восстановление пароля
    {
        $db = Db::init(); // Инициализируем БД
        $res=$db->query("SELECT * FROM `users` WHERE `email` ='".$params[0]['val']."'"); // Спрашиваем у БД есть ли такой
        $user=$res->fetch_assoc(); // Пытаемся перевести в массив
        if(isset($user['id'])) // Если таковой нашелся
        {
            $new_user_pass=uniqid("",true);
            $new_pass=password_hash($new_user_pass,PASSWORD_DEFAULT);
            $db->query("UPDATE `users` SET `password` = '".$new_pass."' WHERE `id` = '".$user['id']."' ");
            $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
            $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
            $mail_send->send($user['email'], "Восстановление доступа", "<h3>Здравствуйте ".$user['name']."!</h3><p>В этом письме Ваш временный пароль к сайту <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Вы сможете сменить его в личном кабинете </p><p>Для входа сейчас используйте этот пароль: <strong>".$new_user_pass."</strong></p>");
            $_SESSION['success']='Временный пароль был отправлен на Email: '.$params[0]['val'];
        }
        else{
            $_SESSION['alert']='К сожалению нам не удалось найти такой учетной записи. Возможно Вы допустили ошибку при указании почты / или указали не ту ';
        }
    }

    public static function Update($params=null) // Изменение Учетных данных пользователя
    {
        foreach ($params as $el)
        {
            if($el['param']==='UserName')
            {
                $User=$el['val'];
            }
            elseif ($el['param']==='UserEmail')
            {
                $Email=$el['val'];
            }
            elseif ($el['param']==='UserPassword')
            {
                $Password=$el['val'];
            }
            elseif ($el['param']==='UserId')
            {
                $Target=$el['val'];
            }
        }
        if(!isset($Password)){$Password='stay_old_password_1';}
        if(isset($User,$Email,$Password,$Target)) // Если собраны все необходимые элементы для того чтобы Что-то могла быть изменено
        {
            $db=Db::init();
            $req=$db->query("SELECT * FROM `users` WHERE `id` = '".$Target."'");
            $curent_user=$req->fetch_assoc();
            if($curent_user['id']) // Если есть такой пользователь то можно проверять что-там у него поменялось
            {
                if($User!==$curent_user['name'])
                {
                    $name_flag=true;
                }
                if($Email!==$curent_user['email'])
                {
                    $mail_flag=true;
                }
                if($Password!=='stay_old_password_1')
                {
                    $password_flag=true;
                }

                // Варианты развития событий
                //1. Поменялось только ИМЯ
                if((isset($name_flag))&&(!isset($mail_flag))&&(!isset($password_flag)))
                {
                    $db->query("UPDATE `users` SET `name` = '".$db->escape_string($User)."' WHERE `id` = '".$Target."'");
                    $_SESSION['User_info']['name']=$User;
                    return 'name_changed';
                }
                //2. Поменялась только ПОЧТА
                if((!isset($name_flag))&&(isset($mail_flag))&&(!isset($password_flag)))
                {
                    $db->query("UPDATE `users` SET `email` = '".$db->escape_string($Email)."', `confirm`=FALSE WHERE `id` = '".$Target."'");
                    $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                    $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                    $mail_send->send($Email, "Подтверждение нового почтового ящика", "<h3>Здравствуйте ".$User."!</h3><p>Вы получили это письмо для подтверждения изменения почтового ящика  на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."'>https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."</a></p>");
                    return 'email_changed';
                }
                //3. Поменялся только ПАРОЛЬ
                if((!isset($name_flag))&&(!isset($mail_flag))&&(isset($password_flag)))
                {

                    $new_pass=password_hash($Password,PASSWORD_DEFAULT);
                    $db->query("UPDATE `users` SET `password` = '".$new_pass."' WHERE `id` = '".$Target."'");
                    return 'password_changed';
                }
                //4. Поменялось ИМЯ и ПОЧТА
                if((isset($name_flag,$mail_flag))&&(!isset($password_flag)))
                    {
                        $db->query("UPDATE `users` SET `name`= '".$User."', `email` = '".$db->escape_string($Email)."', `confirm`=FALSE WHERE `id` = '".$Target."'");
                        $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                        $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                        $mail_send->send($Email, "Подтверждение нового почтового ящика", "<h3>Здравствуйте ".$User."!</h3><p>Вы получили это письмо для подтверждения изменения почтового ящика  на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."'>https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."</a></p>");
                        return 'name_email_changed';
                    }
                //5. Поменялось ИМЯ и ПАРОЛЬ
                if((isset($name_flag,$password_flag))&&(!isset($mail_flag)))
                {
                    $new_pass=password_hash($Password,PASSWORD_DEFAULT);
                    $db->query("UPDATE `users` SET `name`=".$User." `password` = '".$new_pass."' WHERE `id` = '".$Target."'");
                    $_SESSION['User_info']['name']=$User;
                    return 'name_password_changed';
                }
                //6. Поменялось ПОЧТА и ПАРОЛЬ
                if((!isset($name_flag))&&(isset($mail_flag,$password_flag)))
                {
                    $new_pass=password_hash($Password,PASSWORD_DEFAULT);
                    $db->query("UPDATE `users` SET `email` = '".$db->escape_string($Email)."', `confirm`=FALSE,`password`= '".$new_pass."' WHERE `id` = '".$Target."'");
                    $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                    $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                    $mail_send->send($Email, "Подтверждение нового почтового ящика", "<h3>Здравствуйте ".$User."!</h3><p>Вы получили это письмо для подтверждения изменения почтового ящика  на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."'>https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."</a></p>");
                    return 'email_password_changed';
                }
                //7. Поменялось ИМЯ ПОЧТА ПАРОЛЬ
                if(isset($name_flag,$mail_flag,$password_flag))
                {
                    $new_pass=password_hash($Password,PASSWORD_DEFAULT);
                    $db->query("UPDATE `users` SET `name` = '".$User."',`email` = '".$db->escape_string($Email)."', `confirm`=FALSE,`password`= '".$new_pass."' WHERE `id` = '".$Target."'");
                    $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                    $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                    $mail_send->send($Email, "Подтверждение нового почтового ящика", "<h3>Здравствуйте ".$User."!</h3><p>Вы получили это письмо для подтверждения изменения почтового ящика  на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."'>https://".$_SERVER['SERVER_NAME']."/DverController/activate?login=".$curent_user['password']."&mail=".$Email."</a></p>");
                    return 'name_email_password_changed';
                }
            }
        }

    }


}