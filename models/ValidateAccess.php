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
          return true;
      }
      else{
          return false;
      }
    }
}