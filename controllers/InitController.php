<?php


namespace controllers;


class InitController
{
    public function __construct()
    {

    }

    public function index($params=null)
    {
       echo ('<pre>'); print_r($params); echo('</pre>');
    }
}