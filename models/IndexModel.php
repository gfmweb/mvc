<?php
/**
 * модель создания индексной страницы
 *
 *
 */

namespace models;


class IndexModel
{
    /**
     * content - содержание контентной части индексной страницы
     */

    public $content;
    public $title;


    public function __construct()
    {
        $this->title="Title";
        $this->content='
        <div class=form-group>
        <form action=indexController/index method=post>
            <input class=form-control type=text name=text>
			<input class=form-control type=text name=param>
			<input class=form-control type=text name=param2>
			<button type=submit slass=btn btn-success>Отправить</button>
        </form>
        </div>';
        return $this;
    }
}