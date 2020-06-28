<?php


namespace models;

use config\Db;
use models\Pagination;

class ShowRoomModel extends Model
{
    public $content;
    public $title;
    public $script;
    public $alert;
    public $navbar;
    public $content_result;
    public $pagination;
    public $SearchPlaysholder;

    public function index($req_method,$params)
    {
            $maxcontent=include 'config/mat_on_page.php';
            $this->content_result.='
                <div class="container mt-5 wow zoomIn">
                    <div class="row mt-5">'; // Начало контентной части

            $db= Db::init();
            $db->query("SELECT * FROM `materials`");
            $RowsCount= $db->affected_rows;

            $TotalPages=ceil($RowsCount/$maxcontent); // Делим количество строк на количество материалов на странице

                if(!isset($params)) {
                            $req = $db->query("SELECT * FROM `materials` LIMIT {$maxcontent}"); //Запрашиваем все данные из таблицы
                            while ($row = $req->fetch_assoc()) {
                                $data[] = $row; // Собираем массив данных
                            }

                             $this->pagination= new Pagination(1,$TotalPages,'ShowRoomController','page');

                            for($i=0, $iMax=count($data); $i<$iMax; $i++)
                            {
                                $this->content_result.=$data[$i]['content'];
                            }
                }
                else // Если совершено действие в пагинации или пришел Ajax Запрос
                {
                    if (($req_method === 'AjaxSearch')) // Если кто-то хочет поискать в Аяксе
                    {
                        if ($params[0]['val'] === 'clear') // Если пришла команда сбросить все фильтры повторяем всё что было на начальной странице
                        {
                            if (isset($_SESSION['search'])) // Проверяем был ли установлен фильтр поика
                            {
                                unset($_SESSION['search']); // Уничтожаем фильтр
                            }
                            $req = $db->query("SELECT * FROM `materials` LIMIT {$maxcontent}"); //Запрашиваем все данные из таблицы
                            while ($row = $req->fetch_assoc()) {
                                $data[] = $row; // Собираем массив данных
                            }

                            $this->pagination= new Pagination(1,$TotalPages,'ShowRoomController','page');

                            for($i=0, $iMax=count($data); $i<$iMax; $i++)
                            {
                                $this->content_result.=$data[$i]['content'];
                            }

                            return $this;
                        } else // Устанавливаем фильтр поиска
                        {
                            $_SESSION['search'] = $params[0]['val'];
                            $this->SearchPlaysholder = $_SESSION['search'];

                            $db->query("SELECT * FROM `materials` WHERE `title` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `description` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `autor` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' LIMIT {$maxcontent}");
                            $RowsCountAjax = $db->affected_rows;
                            $LastPage = $RowsCountAjax % $maxcontent;
                            $TotalPages = intdiv($RowsCountAjax, $maxcontent); // Делим количество строк на количество материалов на странице

                            $req = $db->query("SELECT * FROM `materials` WHERE `title` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `description` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `autor` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' LIMIT {$maxcontent}"); //Запрашиваем все данные из таблицы
                            while ($row = $req->fetch_assoc()) {
                                $data[] = $row; // Собираем массив данных
                            }
                            for ($cont = 0, $contMax = count($data); $cont < $contMax; $cont++) {
                                $this->content_result .= $data[$cont]['content'];
                            }
                            $this->pagination= new Pagination(1,$TotalPages,'ShowRoomController','page');
                        }
                        return $this;
                    } else // Действия с Пагинацией
                    {
                        /*TODO
                               Проверяем был ли установлен параметр ФИЛЬТР поиска по БД
                               Выполняем сбор данных так-же как и при первом заходе на этот раздел
                               Записываем в строку поиска Данные фильтра (Если таковой был)
                               Работаем без JSON
                          */
                        if(isset($_SESSION['search']))
                        {
                            $this->SearchPlaysholder = $_SESSION['search'];
                            $offset=($params[0]['val']-1)*$maxcontent;
                            $db->query("SELECT * FROM `materials` WHERE `title` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `description` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `autor` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' LIMIT {$maxcontent} OFFSET {$offset}");
                            $RowsCountAjax = $db->affected_rows;
                            $TotalPages = intdiv($RowsCountAjax, $maxcontent); // Делим количество строк на количество материалов на странице

                            $req = $db->query("SELECT * FROM `materials` WHERE `title` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `description` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `autor` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' LIMIT {$maxcontent} OFFSET {$offset}"); //Запрашиваем все данные из таблицы
                            while ($row = $req->fetch_assoc()) {
                                $data[] = $row; // Собираем массив данных
                            }
                            for ($cont = 0, $contMax = count($data); $cont < $contMax; $cont++) {
                                $this->content_result .= $data[$cont]['content'];
                            }
                            $this->pagination= new Pagination($params[0]['val'],$TotalPages,'ShowRoomController','page');

                        }
                        else{
                            $offset=($params[0]['val']-1)*$maxcontent;
                            $req = $db->query("SELECT * FROM `materials` LIMIT {$maxcontent} OFFSET {$offset}"); //Запрашиваем все данные из таблицы

                            while ($row = $req->fetch_assoc()) {
                                $data[] = $row; // Собираем массив данных
                            }


                            $this->pagination= new Pagination($params[0]['val'],$TotalPages,'ShowRoomController','page');

                            for($i=0, $iMax=count($data); $i<$iMax; $i++)
                            {
                                $this->content_result.=$data[$i]['content'];
                            }
                        }

                    }
                }

            $this->content_result.=' 
                    </div>
                </div>'; // Конец контентной части

        $this->content_result.=$this->pagination->pagi;
        $this->navbar = Navbar::GetNavSh('Работы',$this->pages,false,$this->alert,'',$this->SearchPlaysholder); // передаем на построение верхнее меню 1-Активная страница ИМЯ 2-Массив страниц 3. Залогинены / нет 4. Алерт если он есть

        $this->title='Работы';
        $this->content=$this->alert.$this->loginModal;
        $this->script='';

    }

}