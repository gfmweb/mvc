<?php
/**
 *
 * Глобальная модель валидации права на доступ к форме
 *
 *
 */

namespace models;


class ValidateAccess
{
    public static function IsValid($val='novalid'){

      if($val==$_SESSION['ValidateFormAccess']) {
          return true;
      }
      else{
          return false;
      }
    }
}