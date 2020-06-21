<?php
/**
 * пример контроллера  имееющего всего один метод но поддерживающий вызов любого запрошенного метода
 *
 */

namespace controllers;
use controllers\Magic;

class MultiController extends Magic
{

    public function index($req_method=null,$req_params=null)
    {
      echo 'Был запрошен метод:'.$req_method;

    }
}