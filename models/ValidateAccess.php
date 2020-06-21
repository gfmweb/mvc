<?php
/**
 *
 * Глобальная модель валидации права на одноразовый доступ к форме
 *
 */

namespace models;


class ValidateAccess
{
    /**
     * @param string $val
     * @return bool
     */
    public static function IsValid($val='novalid'){

      if($val==$_SESSION['ValidateFormAccess']) {
          unset($_SESSION['ValidateFormAccess']); // Сбрасываем использованный ключ
          return true;
      }
      else{
          return false;
      }
    }

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
            for($i=0,$iMax=count($params); $i<$iMax; $i++)
            {
                if($params[$i]['param']=='ValidateFormAccess') // Если мы нашли ключ доступа к форме
                    {
                        if($params[$i]['val']===$_SESSION['ValidateFormAccess'])
                        {
                            unset($_SESSION['ValidateFormAccess']); // Сбрасываем использованный ключ
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
            }
        }
    }
}