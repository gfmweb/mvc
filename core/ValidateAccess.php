<?php
/**
 *
 * Глобальная модель валидации права на одноразовый доступ к форме
 *
 */

namespace core;


class ValidateAccess
{
    /**
     * @param string $val
     * @return bool
     */


    public static function ValidAccess($params=null)
    {
        /**
         *
         * Проверка на правомерность использования формы (
         *
         *
         */
        if(is_array($params)) // Если нам поступили параметры
        {
            foreach ($params as $iValue) { // Перебираем массив данных
                if($iValue['param']==='ValidateFormAccess') // Если мы нашли ключ доступа к форме
                    {
                        if($iValue['val']===$_SESSION['ValidateFormAccess']) // Если всё ок
                        {
                            unset($_SESSION['ValidateFormAccess']); // Сбрасываем использованный ключ
                            return true;
                        }

                            return false;
                    }
            }
        }
    }
}