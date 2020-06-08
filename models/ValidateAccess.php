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
}