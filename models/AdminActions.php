<?php


namespace models;

use core\ValidateAccess;
use core\Db;

class AdminActions
{
        public static function checkPassword($params)
        {
            require 'config/config.php';
            if($params[0]['val']===ADMIN_PASS){
                return true;
            }


        }

        public static function config($params)
        {
            $app_name='';
            $adm_pass='';
            $pass='';
            $vk_pref='//';
            $whatsapp_pref='//';
            $youtube_pref='//';
            $facebook_pref='//';
            $ok_pref='//';
            $instagram_pref='//';
            $viber_pref='//';
            $twitter_pref='//';
            $skype_pref='//';
            $github_pref='//';
            $telegram_pref='//';
            $tel_pref='//';

            $vk_href='';
            $whatsapp_href='';
            $youtube_href='';
            $facebook_href='';
            $ok_href='';
            $instagram_href='';
            $viber_href='';
            $twitter_href='';
            $skype_href='';
            $github_href='';
            $telegram_href='';
            $tel_href='';
            foreach($params as $el)
            {
                if($el['param']==='DB_PASSWORD'){$pass=$el['val']; }
                if($el['param']=='APP_NAME'){$app_name=$el['val']; }
                if($el['param']=='ADMIN_PASS'){$adm_pass=$el['val']; }
                if($el['param']=='vk'){$vk_pref='';}
                if($el['param']=='whatsapp'){$whatsapp_pref=''; }
                if($el['param']=='youtube'){$youtube_pref='';}
                if($el['param']=='facebook'){$facebook_pref='';}
                if($el['param']=='ok'){$ok_pref='';}
                if($el['param']=='instagram'){$instagram_pref='';}
                if($el['param']=='viber'){$viber_pref='';}
                if($el['param']=='twitter'){$twitter_pref='';}
                if($el['param']=='skype'){$skype_pref='';}
                if($el['param']=='github'){$github_pref='';}
                if($el['param']=='telegram'){$telegram_pref='';}
                if($el['param']=='tel'){$tel_pref='';}

                if($el['param']=='vk_href'){$vk_href=$el['val'];}
                if($el['param']=='whatsapp_href'){$whatsapp_href=$el['val']; }
                if($el['param']=='youtube_href'){$youtube_href=$el['val'];}
                if($el['param']=='facebook_href'){$facebook_href=$el['val'];}
                if($el['param']=='ok_href'){$ok_href=$el['val'];}
                if($el['param']=='instagram_href'){$instagram_href=$el['val'];}
                if($el['param']=='viber_href'){$viber_href=$el['val'];}
                if($el['param']=='twitter_href'){$twitter_href=$el['val'];}
                if($el['param']=='skype_href'){$skype_href=$el['val'];}
                if($el['param']=='github_href'){$github_href=$el['val'];}
                if($el['param']=='telegram_href'){$telegram_href=$el['val'];}
                if($el['param']=='tel_href'){$tel_href='tel: '.$el['val'];}
            }
            $string="<?php 
/**
 * Файл настроек подключения к БД
 * Включает в себя ИМЯ ПРИЛОЖЕНИЯ
 * Включает в себя пароль администратора
 */


define(\"CHAR_DB\",\"utf8\");          // Кодировка БД
define(\"DB_HOST\",\"".$params[1]['val']."\");    //  Где живет БД
define(\"DB_NAME\",\"".$params[2]['val']."\");          //  Имя базы
define(\"DB_USER\",\"".$params[3]['val']."\");         //  Пользователь
define(\"DB_PASSWORD\",\"".$pass."\");     //  Пароль


define(\"APP_NAME\",\"".$app_name."\");         // Имя приложения
define(\"ADMIN_PASS\",\"".$adm_pass."\");    // Пароль администратора";
            $file=fopen('config/config.php','w');
            fwrite($file,$string);
            fclose($file);
$SocialString='<?php
return array(
 '.$vk_pref.'\'vk\'=>array(\'fab fa-vk\'=>\''.$vk_href.'\'),
 '.$whatsapp_pref.'\'whatsapp\'=>array(\'fab fa-whatsapp\'=>\''.$whatsapp_href.'\'),
 '.$youtube_pref.'\'youtube\'=>array(\'fab fa-youtube\'=>\''.$youtube_href.'\'),
 '.$facebook_pref.'\'facebook\'=>array(\'fab fa-facebook\'=>\''.$facebook_href.'\'),
 '.$ok_pref.'\'ok\'=>array(\'fab fa-odnoklassniki\'=>\''.$ok_href.'\'),
 '.$instagram_pref.'\'instagram\'=>array(\'fab fa-instagram\'=>\''.$instagram_href.'\'),
 '.$viber_pref.'\'viber\'=>array(\'fab fa-viber\'=>\''.$viber_href.'\'),
 '.$twitter_pref.'\'twitter\'=>array(\'fab fa-twitter\'=>\''.$twitter_href.'\'),
 '.$skype_pref.'\'skype\'=>array(\'fab fa-skype\'=>\''.$skype_href.'\'),
 '.$github_pref.'\'github\'=>array(\'fab fa-github\'=>\''.$github_href.'\'),
 '.$tel_pref.'\'telegram\'=>array(\'fab fa-telegram\'=>\''.$telegram_href.'\'),
 '.$tel_pref.'\'tel\'=>array(\'fas fa-phone	\'=>\''.$tel_href.'\')

);';
$SocialStringAdmin='<?php
return array(
\'vk\'=>array(\'fab fa-vk\'=>\''.$vk_href.'\'),
\'whatsapp\'=>array(\'fab fa-whatsapp\'=>\''.$whatsapp_href.'\'),
\'youtube\'=>array(\'fab fa-youtube\'=>\''.$youtube_href.'\'),
\'facebook\'=>array(\'fab fa-facebook\'=>\''.$facebook_href.'\'),
\'ok\'=>array(\'fab fa-odnoklassniki\'=>\''.$ok_href.'\'),
\'instagram\'=>array(\'fab fa-instagram\'=>\''.$instagram_href.'\'),
\'viber\'=>array(\'fab fa-viber\'=>\''.$viber_href.'\'),
\'twitter\'=>array(\'fab fa-twitter\'=>\''.$twitter_href.'\'),
\'skype\'=>array(\'fab fa-skype\'=>\''.$skype_href.'\'),
\'github\'=>array(\'fab fa-github\'=>\''.$github_href.'\'),
\'telegram\'=>array(\'fab fa-telegram\'=>\''.$telegram_href.'\'),
\'tel\'=>array(\'fas fa-phone	\'=>\''.$tel_href.'\')

);';
    $file=fopen('config/socialadmin.php','w');
    fwrite($file,$SocialStringAdmin);
    fclose($file);
    $file=fopen('config/social.php','w');
    fwrite($file,$SocialString);
    fclose($file);

            $db=Db::init();
            $statement=$db->prepare('CREATE DATABASE IF NOT EXISTS '.$params[2]['val']);
            $statement->execute();
            $statement=$db->prepare('CREATE TABLE IF NOT EXISTS `users` (
                                                  `id` int(7) NOT NULL AUTO_INCREMENT,
                                                  `email` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                  `confirm` tinyint(1) NOT NULL DEFAULT 0 COMMENT \'Проверка подтверждения E-mail\',
                                                  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                  PRIMARY KEY (`id`)
                                                ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
            $statement->execute();
            $statement=$db->prepare("CREATE TABLE IF NOT EXISTS `materials` (
                                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                                  `title` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Тайтл работоты',
                                                  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Краткое описание',
                                                  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Сама работа',
                                                  `trumb` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Пред картинка',
                                                  `img` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Картинка',
                                                  `link` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ссылка на работу',
                                                  `autor` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'автор',
                                                  `ismoderate` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0- надо модерировать 1 ОК 2-Rejected',
                                                  PRIMARY KEY (`id`)
                                            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
            $statement->execute();



           $_SESSION['success']='Изменения успешно внесены<br/>config.php - сформирован<br/>База данных инициализирована<br/> Социальные кнопки актуализированы';
            return true;
        }
}