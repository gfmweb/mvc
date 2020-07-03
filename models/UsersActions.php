<?php


namespace models;


use core\Mail;
use core\SimpleImage;
use core\CRUD;

class UsersActions
{

    public static function findUser($params=null,$action=null) // поиск пользователя в БД и проверка его входа/ либо проверка уникальности почты
    {
        if(is_array($params)) // Если нам скормили нормальный массив данных
        {
            for($i = 0, $iMax = count($params); $i < $iMax; $i++) // Перебираем массив и ищем интересующий нас ключ
            {
                if($params[$i]['param'] === 'UserEmail') {
                    $mail=$params[$i]['val'];
                    $db = new CRUD('users');
                    $result = $db->GetInfo(['email'],null,'=',$params[$i]['val'],1,0);
                    $user = $result->Resulting;
                    break; // пользователь помещен в массив Прекращаем цикл
                }
            }

            if(isset($user[0]['email'])) // если такой пользователь найден, то проверяем его дальше
            {
                if($action==="CheckLogin") // проверяем персональный экшен для этого поиска
                {
                    for($i=0,$iMax=count($params); $i < $iMax; $i++) // перебираем массив переменных дл поиска пароля
                    {
                        if(($params[$i]['param']==='UserPassword')&&(password_verify($params[$i]['val'],$user[0]['password']))) //Если всё совпало
                        {
                            $pass=$user[0]['password'];
                           if($user[0]['confirm']!=='0') // Если пользователь прошел подтверждение его почты
                               {
                                   $_SESSION['User'] = $user[0]['name']; // Записали в сессию как зовут пользователя
                                   $_SESSION['User_info'] = $user[0];
                                   return true;
                                   break; // возвращаем ТРУ
                               }
                           else // Если пользователь не подтвердил свой ящик
                               {
                                   $_SESSION['alert']='Вы не подтвердили свой E-mail. На всякий случай мы повторно отправили Вам письмо с подтверждением Пожалйуста проверьте почту';
                                   $name=$user[0]['name'];
                                   $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                                   $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                                   $mail_send->send($mail, "Подтверждение почтового ящика. Повторное письмо", "<h3>Здравствуйте ".$name."!</h3><p>Вы получили это письмо для подтверждения регистрации на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/Dver/activate?login=".$pass."&mail=".$mail."'>https://".$_SERVER['SERVER_NAME']."/Dver/activate?login=".$pass."&mail=".$mail."</a></p>");
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
            $password=password_hash($pass,PASSWORD_DEFAULT);
            $db = new CRUD('users'); // Инициализируем работу с таблицей users
            if($db->Add(array('email'=>$mail,'password'=>$password,'name'=>$user))){ // Если запись добавлена то отправляем письмо

                $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                $mail_send->send($mail, "Подтверждение почтового ящика", "<h3>Здравствуйте ".$user."!</h3><p>Вы получили это письмо для подтверждения регистрации на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/Dver/activate?login=".$password."&mail=".$mail."'>https://".$_SERVER['SERVER_NAME']."/Dver/activate?login=".$pass."&mail=".$mail."</a></p>");
            }
            else
            {

            }
        }

    }

    public static function TryActivate($params = null) // Попытка подтвердить E-mail пользователя
    {
            $db = new CRUD('users'); // Инициализируем БД
            $rows = $db->Update (array('confirm' => '1'), 'AND','=',array('password'=>$params[0]['val'],'email'=>$params[1]['val']));  // Возвращаем результат попытки обновления
            return $rows;
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
            elseif ($el['param']==='UserPhoto')
            {
                $Photo=$el['val'];
            }
        }
          if(!isset($Photo)){$Photo='no_photo';}
          if(!isset($Password)){$Password='stay_old_password_1';}
          if(isset($User,$Email,$Password,$Target,$Photo)) // Если собраны все необходимые элементы для того чтобы Что-то могла быть изменено
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
                if($Photo!=='no_photo')
                {
                    $photo_flag=true;
                }
                $result=''; // Создаем пустой результат
                if(isset($name_flag))
                {
                    $db->query("UPDATE `users` SET `name` = '".$db->escape_string($User)."' WHERE `id` = '".$Target."'");
                    $_SESSION['User_info']['name']=$User;
                    $result .= '_name_changed_';
                }
                if(isset($mail_flag))
                {
                    $db->query("UPDATE `users` SET `email` = '".$db->escape_string($Email)."', `confirm`=FALSE WHERE `id` = '".$Target."'");
                    $mail_send = new Mail($_SERVER['SERVER_NAME']); // Создаём экземпляр класса
                    $mail_send->setFromName("Администрация сайта"); // Устанавливаем имя в обратном адресе
                    $mail_send->send($Email, "Подтверждение нового почтового ящика", "<h3>Здравствуйте ".$User."!</h3><p>Вы получили это письмо для подтверждения изменения почтового ящика  на сайте <strong>".$_SERVER['SERVER_NAME']."</strong> </p><p>Для активации Вашего аккаунта пройдите по ссылке: <a href='https://".$_SERVER['SERVER_NAME']."/Dver/activate?login=".$curent_user['password']."&mail=".$Email."'>https://".$_SERVER['SERVER_NAME']."/Dver/activate?login=".$curent_user['password']."&mail=".$Email."</a></p>");
                    $result .= '_email_changed_';

                }
                if(isset($password_flag))
                {
                    $new_pass=password_hash($Password,PASSWORD_DEFAULT);
                    $db->query("UPDATE `users` SET `password` = '".$new_pass."' WHERE `id` = '".$Target."'");
                    $result .= '_password_changed_';
                }
                if(isset($photo_flag))
                {
                    if(isset($curent_user['photo']))
                    {
                        unset($curent_user['photo']);
                    }
                    if(($Photo['error'] === 0) && $Photo['type'] == "image/png") {
                        $name=uniqid('', true).".png";
                        move_uploaded_file($Photo['tmp_name'], "content/avatars/".$name); // Переносим полученный файл
                        $new_photo="content/avatars/".$name;
                        $image = new SimpleImage();
                        $image->load($new_photo);
                        $image->resize(200, 200);
                        $image->save('content/avatars/ava_'.$name);
                        $new_photo="/content/avatars/ava_".$name;
                        unlink('content/avatars/'.$name);
                    }
                    if(($Photo['error'] === 0) && $Photo['type'] == "image/jpeg") {
                        $name=uniqid('', true).".jpeg";
                        move_uploaded_file($Photo['tmp_name'], "content/avatars/".$name); // Переносим полученный файл
                        $new_photo="content/avatars/".$name;
                        $image = new SimpleImage();
                        $image->load($new_photo);
                        $image->resize(200, 200);
                        $image->save('content/avatars/ava_'.$name);
                        $new_photo="/content/avatars/ava_".$name;
                        unlink('content/avatars/'.$name);
                    }
                    if(($Photo['error'] === 0) && $Photo['type'] == "image/gif") {
                        $name=uniqid('', true).".gif";
                        move_uploaded_file($Photo['tmp_name'], "content/avatars/".$name); // Переносим полученный файл
                        $new_photo="content/avatars/".$name;
                        $image = new SimpleImage();
                        $image->load($new_photo);
                        $image->resize(200, 200);
                        $image->save('content/avatars/ava_'.$name);
                        $new_photo="/content/avatars/ava_".$name;
                        unlink('content/avatars/'.$name);
                    }

                    if(isset($new_photo)){
                    $_SESSION['User_info']['photo']=$new_photo;
                    $db->query("UPDATE `users` SET `photo` = '".$new_photo."' WHERE `id` = '".$Target."'");
                    $result .= '_photo_changed_';
                    }
                }

            }
        }
        return $result;
    }

    public static function ChangeFormModal($params=null)
    {
        if($params[0]['val']==='Регистрация')
        {
            $result=array('act'=>'/Dver/register',
                          'name'=>'Регистрация',
                          'form'=>'            <div class="md-form mb-5">
                                                    <i class="fas fa-user  prefix grey-text"></i>
                                                    <input type="text" name="UserName" id="defaultForm-name" class="form-control validate" autofocus required>
                                                    <label data-error="" data-success="" for="defaultForm-name">Ваше Имя</label>
                                                  </div>
                                                <div class="md-form mb-5">
                                                    <i class="fas fa-envelope prefix grey-text"></i>
                                                    <input type="email" name="UserEmail" id="defaultForm-email" class="form-control validate" required>
                                                    <label data-error="" data-success="" for="defaultForm-email">Ваша почта</label>
                                                  </div>
                                                  <div class="md-form mb-4">
                                                    <i class="fas fa-lock prefix grey-text"></i>
                                                    <input type="password"  name="UserPassword"  id="defaultForm-pass" class="form-control validate" required>
                                                    <label data-error="" data-success="" for="defaultForm-pass">Ваш пароль</label>
                                                  </div>
                                                 <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" > ',
                          'footer'=>'<button class="btn btn-default" type="submit">Зарегистрироваться</button>',
                           'last'=>'<div class="row justify-content-between">
                                        <span  class="loginLink"  onclick="changed(\'Вход\')">&nbsp;Вход</span>
                                        <span  class="loginLink" onclick="changed(\'Восстановление пароля\')">Забыли пароль&nbsp;</span>
                                    </div>' );
        }
        elseif($params[0]['val']==='Восстановление пароля')
        {
            $result=array('act'=>'/Dver/remind',
                'name'=>'Восстановление пароля',
                'form'=>'<div class="md-form mb-5">
                                            <div class="md-form mb-2">
                                                <i class="fas fa-envelope prefix grey-text"></i>
                                                <input type="email" name="UserEmail" id="defaultForm-email" class="form-control validate" required>
                                                <label data-error="" data-success="" for="defaultForm-email">Ваша почта указанная при регистрации</label>
                                            </div> 
                                             <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                                            
                                            ',
                'footer'=>'<button class="btn btn-default" type="submit">Восстановить</button>',
                'last'=>'<div class="row justify-content-between">
                                        <span  class="loginLink"   onclick="changed(\'Вход\')">&nbsp;Вход</span>
                                        <span  class="loginLink"  onclick="changed(\'Регистрация\')">Регистрация&nbsp;</span>
                                    </div>' );
        }
        elseif($params[0]['val']==='Вход')
        {
            $result=array(
                          'act'=>'/Dver/login',
                          'name'=>'Вход',
                          'form'=>'<div class="md-form mb-5">
                                                    <i class="fas fa-envelope prefix grey-text"></i>
                                                    <input type="email" name="UserEmail" id="defaultForm-email" class="form-control validate" required>
                                                    <label data-error="" data-success="" for="defaultForm-email">Ваша почта</label>
                                                  </div>
                                                  <div class="md-form mb-4">
                                                    <i class="fas fa-lock prefix grey-text"></i>
                                                    <input type="password"  name="UserPassword"  id="defaultForm-pass" class="form-control validate" required>
                                                    <label data-error="" data-success="" for="defaultForm-pass">Ваш пароль</label>
                                                  </div>
                                                 <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >',
                          'footer'=>'  <button class="btn btn-default" type="submit">Войти</button>',
                           'last'=>'<div class="row justify-content-between">
                                        <span  class="loginLink"   onclick="changed(\'Регистрация\')">&nbsp;Регистрация</span>
                                        <span  class="loginLink"  onclick="changed(\'Восстановление пароля\')">Забыли пароль&nbsp;</span>
                                    </div>   ' );
        }
        return $result;
    }
}