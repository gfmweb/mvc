<?php


namespace models;

use config\Db;

class ShowRoomModel extends Model
{
    public $content;
    public $title;
    public $script;
    public $alert;
    public $navbar;
    public $content_result;
    public $pagination;

    public function index($req_method,$params)
    {
            $maxcontent=include 'config/mat_on_page.php';
            $this->content_result.='
                <div class="container mt-5 wow zoomIn">
                    <div class="row mt-5">'; // Начало контентной части

            $db= Db::init();
            $db->query("SELECT * FROM `materials`");
            $RowsCount= $db->affected_rows;
            $LastPage=$RowsCount % $maxcontent;
            $TotalPages=intdiv($RowsCount,$maxcontent); // Делим количество строк на количество материалов на странице
                if(!isset($params)) {
                    if ($TotalPages > 1) // Если нужна пагинация
                    {

                        if ($TotalPages >= 5) // Пагинация длинная
                        {
                            $req = $db->query("SELECT * FROM `materials` LIMIT {$maxcontent}"); //Запрашиваем все данные из таблицы
                            while ($row = $req->fetch_assoc()) {
                                $data[] = $row; // Собираем массив данных
                            }

                            for ($cont = 0; $cont < 9; $cont++) {
                                $this->content_result .= $data[$cont]['content'];
                            }

                            if ($LastPage !== 0) {
                                $iMax = ceil($RowsCount / $maxcontent);
                            } else {
                                $iMax = $RowsCount / $maxcontent - 1;
                            }

                            $this->pagination = ' <div class="row justify-content-center mt-5">  
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pg-blue">
                                                            <li class="page-item active">
                                                                <a class="page-link">1 <span class="sr-only">(current)</span></a>
                                                            </li>';// Начало пагинации

                            for ($i = 0; $i < 2; $i++) {
                                $t = $i + 2;
                                $this->pagination .= '<li class="page-item"><a href="/ShowRoomController?page=' . $t . '" class="page-link">' . $t . '</a></li>';
                            }

                            $tempLast = $iMax + 3;
                            $this->pagination .= '<li class="page-item ">
                                                    ...
                                                </li>
                                                <li class="page-item ">
                                                    <a href="/ShowRoomController/?page=' . $tempLast . '" class="page-link">' . $tempLast . '</a>
                                                </li>
                                                <li class="page-item ">
                                                    <a href="/ShowRoomController?page=2" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                    </div>';
                        } else // Если пагинация укладывается в 5 страниц то будем выводить её полностью
                        {

                            $req = $db->query("SELECT * FROM `materials`"); //Запрашиваем все данные из таблицы
                            while ($row = $req->fetch_assoc()) {
                                $data[] = $row; // Собираем массив данных
                            }

                            for ($cont = 0, $contMax = count($data); $cont < $contMax; $cont++) {
                                $this->content_result .= $data[$cont]['content'];
                            }

                            $this->pagination = ' <div class="row justify-content-center mt-5">  
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pg-blue">
                                                            <li class="page-item active">
                                                                <a class="page-link">1 <span class="sr-only">(current)</span></a>
                                                            </li>';// Начало пагинации

                            if ($LastPage !== 0) {
                                $iMax = ceil(count($data) / $maxcontent) - 1;
                            } else {
                                $iMax = count($data) / $maxcontent - 1;
                            }

                            for ($i = 0; $i < $iMax; $i++) // Начинаем строить пагинацию
                            {
                                $t = $i + 2;
                                $this->pagination .= '<li class="page-item"><a href="/ShowRoomController?page=' . $t . '" class="page-link">' . $t . '</a></li>';
                            }

                            $this->pagination .= '<li class="page-item ">
                                                    <a href="ShowRoomController?page=2" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                    </div>';
                        }
                    } else // Пагинация совсем не нужна
                    {
                        $this->pagination = '';
                    }
                }
                else // Если совершено действие в пагинации или пришел Ajax Запрос
                {
                    if(($req_method==='AjaxSearch')) // Если кто-то хочет поискать в Аяксе
                    {
                       if($params[0]['val']==='clear') // Если пришла команда сбросить все фильтры повторяем всё что было на начальной странице
                       {
                          if(isset($_SESSION['search'])) // Проверяем был ли установлен фильтр поика
                          {
                              unset($_SESSION['search']); // Уничтожаем фильтр
                          }

                           if ($TotalPages > 1) // Если нужна пагинация
                           {

                               if ($TotalPages >= 5) // Пагинация длинная
                               {
                                   $req = $db->query("SELECT * FROM `materials` LIMIT {$maxcontent}"); //Запрашиваем все данные из таблицы
                                   while ($row = $req->fetch_assoc()) {
                                       $data[] = $row; // Собираем массив данных
                                   }

                                   for ($cont = 0; $cont < 9; $cont++) {
                                       $this->content_result .= $data[$cont]['content'];
                                   }

                                   if ($LastPage !== 0) {
                                       $iMax = ceil($RowsCount / $maxcontent);
                                   } else {
                                       $iMax = $RowsCount / $maxcontent - 1;
                                   }

                                   $this->pagination = ' <div class="row justify-content-center mt-5">  
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pg-blue">
                                                            <li class="page-item active">
                                                                <a class="page-link">1 <span class="sr-only">(current)</span></a>
                                                            </li>';// Начало пагинации

                                   for ($i = 0; $i < 2; $i++) {
                                       $t = $i + 2;
                                       $this->pagination .= '<li class="page-item"><a href="/ShowRoomController?page=' . $t . '" class="page-link">' . $t . '</a></li>';
                                   }

                                   $tempLast = $iMax + 3;
                                   $this->pagination .= '<li class="page-item ">
                                                    ...
                                                </li>
                                                <li class="page-item ">
                                                    <a href="/ShowRoomController/?page=' . $tempLast . '" class="page-link">' . $tempLast . '</a>
                                                </li>
                                                <li class="page-item ">
                                                    <a href="/ShowRoomController?page=2" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                    </div>';
                               } else // Если пагинация укладывается в 5 страниц то будем выводить её полностью
                               {

                                   $req = $db->query("SELECT * FROM `materials`"); //Запрашиваем все данные из таблицы
                                   while ($row = $req->fetch_assoc()) {
                                       $data[] = $row; // Собираем массив данных
                                   }

                                   for ($cont = 0, $contMax = count($data); $cont < $contMax; $cont++) {
                                       $this->content_result .= $data[$cont]['content'];
                                   }

                                   $this->pagination = ' <div class="row justify-content-center mt-5">  
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pg-blue">
                                                            <li class="page-item active">
                                                                <a class="page-link">1 <span class="sr-only">(current)</span></a>
                                                            </li>';// Начало пагинации

                                   if ($LastPage !== 0) {
                                       $iMax = ceil(count($data) / $maxcontent) - 1;
                                   } else {
                                       $iMax = count($data) / $maxcontent - 1;
                                   }

                                   for ($i = 0; $i < $iMax; $i++) // Начинаем строить пагинацию
                                   {
                                       $t = $i + 2;
                                       $this->pagination .= '<li class="page-item"><a href="/ShowRoomController?page=' . $t . '" class="page-link">' . $t . '</a></li>';
                                   }

                                   $this->pagination .= '<li class="page-item ">
                                                    <a href="ShowRoomController?page=2" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                    </div>';
                               }
                           } else // Пагинация совсем не нужна
                           {
                               $this->pagination = '';
                           }
                           return $this;
                       }
                       else // Устанавливаем фильтр поиска
                        {
                            $_SESSION['search']=$params[0]['val'];
                            /*TODO
                               Выполняем сбор данных с учетом того что ищет пользователь
                               Формируем Json ответ из 2х частей КОНТЕНТ и ПАГИНАЦИЯ !RETURN!
                          */
                            $db->query("SELECT * FROM `materials` WHERE `title` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `description` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `autor` LIKE '%{$db->real_escape_string($_SESSION['search'])}%'");
                            $RowsCountAjax= $db->affected_rows;
                            $LastPage=$RowsCountAjax % $maxcontent;
                            $TotalPages=intdiv($RowsCountAjax,$maxcontent); // Делим количество строк на количество материалов на странице
                            if ($TotalPages > 1) // Если нужна пагинация
                            {

                                if ($TotalPages >= 5) // Пагинация длинная
                                {
                                    $req = $db->query("SELECT * FROM `materials` WHERE `title` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `description` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `autor` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' LIMIT {$maxcontent}"); //Запрашиваем все данные из таблицы
                                    while ($row = $req->fetch_assoc()) {
                                        $data[] = $row; // Собираем массив данных
                                    }

                                    for ($cont = 0; $cont < 9; $cont++) {
                                        $this->content_result .= $data[$cont]['content'];
                                    }

                                    if ($LastPage !== 0) {
                                        $iMax = ceil($RowsCountAjax / $maxcontent);
                                    } else {
                                        $iMax = $RowsCountAjax / $maxcontent -6;
                                    }

                                    $this->pagination = ' <div class="row justify-content-center mt-5">  
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pg-blue">
                                                            <li class="page-item active">
                                                                <a class="page-link">1 <span class="sr-only">(current)</span></a>
                                                            </li>';// Начало пагинации

                                    for ($i = 0; $i < 2; $i++) {
                                        $t = $i + 2;
                                        $this->pagination .= '<li class="page-item"><a href="/ShowRoomController?page=' . $t . '" class="page-link">' . $t . '</a></li>';
                                    }

                                    $tempLast = $iMax + 3;
                                    $this->pagination .= '<li class="page-item ">
                                                    ...
                                                </li>
                                                <li class="page-item ">
                                                    <a href="/ShowRoomController/?page=' . $tempLast . '" class="page-link">' . $tempLast . '</a>
                                                </li>
                                                <li class="page-item ">
                                                    <a href="/ShowRoomController?page=2" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                    </div>';
                                } else // Если пагинация укладывается в 5 страниц то будем выводить её полностью
                                {

                                    $req = $db->query("SELECT * FROM `materials`WHERE `title` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `description` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' OR `autor` LIKE '%{$db->real_escape_string($_SESSION['search'])}%' LIMIT {$maxcontent}"); //Запрашиваем все данные из таблицы
                                    while ($row = $req->fetch_assoc()) {
                                        $data[] = $row; // Собираем массив данных
                                    }

                                    for ($cont = 0, $contMax = count($data); $cont < $contMax; $cont++) {
                                        $this->content_result .= $data[$cont]['content'];
                                    }

                                    $this->pagination = ' <div class="row justify-content-center mt-5">  
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pg-blue">
                                                            <li class="page-item active">
                                                                <a class="page-link">1 <span class="sr-only">(current)</span></a>
                                                            </li>';// Начало пагинации

                                    if ($LastPage !== 0) {
                                        $iMax = count($data) / $maxcontent-+2;
                                    } else {
                                        $iMax = count($data) / $maxcontent;
                                    }

                                    for ($i = 0; $i < $iMax; $i++) // Начинаем строить пагинацию
                                    {
                                        $t = $i + 2;
                                        $this->pagination .= '<li class="page-item"><a href="/ShowRoomController?page=' . $t . '" class="page-link">' . $t . '</a></li>';
                                    }

                                    $this->pagination .= '<li class="page-item ">
                                                    <a href="ShowRoomController?page=2" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                    </div>';
                                }
                            } else // Пагинация совсем не нужна
                            {
                                $this->pagination = '';
                            }
                            return $this;
                        }
                    }
                    else // Действия с Пагинацией
                    {
                        /*TODO
                               Проверяем был ли установлен параметр ФИЛЬТР поиска по БД
                               Выполняем сбор данных так-же как и при первом заходе на этот раздел
                               Записываем в строку поиска Данные фильтра (Если таковой был)
                               Работаем без JSON
                          */

                    }
                }
            $this->content_result.=' 
                    </div>
                </div>'; // Конец контентной части

        $this->content_result.=$this->pagination;
        $this->navbar = Navbar::GetNavSh('Работы',$this->pages,false,$this->alert); // передаем на построение верхнее меню 1-Активная страница ИМЯ 2-Массив страниц 3. Залогинены / нет 4. Алерт если он есть

        $this->title='Работы';
        $this->content=$this->alert.$this->loginModal;
        $this->script='';

    }

}