<?php


namespace models;


use widgets\Pagination;
use widgets\Navbar;
use core\Model;
use core\CRUD;


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

            $containerIfno= new CRUD('materials');
            $TotalPages=ceil($containerIfno->TotalRows/$maxcontent); // Делим количество строк на количество материалов на странице

                if(!isset($params)) {

                    $containerIfno->GetInfo(null,null,null,null,$maxcontent,null); //Запрашиваем все данные из таблицы
                    $this->pagination= new Pagination(1,$TotalPages,'ShowRoom','page');
                    foreach ($containerIfno->Resulting as $el){
                        $this->content_result.=$el['content'];
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
                            $containerIfno->GetInfo(null,null,null,null, $maxcontent,null); //Запрашиваем все данные из таблицы
                            $this->pagination= new Pagination(1,$TotalPages,'ShowRoom','page'); // Создаем пагинацию
                            foreach ($containerIfno->Resulting as $el){
                                $this->content_result.=$el['content'];
                            }

                            return $this;
                        }
                        else // Устанавливаем фильтр поиска
                        {
                            $_SESSION['search'] = $params[0]['val'];
                            $this->SearchPlaysholder = $_SESSION['search'];

                            $containerIfno->GetInfo(array('title','description','autor'),'OR','LIKE',$_SESSION['search'] ,$maxcontent,0);

                            $TotalPages = intdiv($containerIfno->CurentRows, $maxcontent); // Делим количество строк на количество материалов на странице
                            if($containerIfno->CurentRows > 0){
                                foreach ($containerIfno->Resulting as $el){
                                    $this->content_result.=$el['content'];
                                }
                            }
                            else{
                                $this->content_result.='<div class="mt-5 text-center"><h2>Ничего не найдено</h2></div>';
                            }
                            $this->pagination= new Pagination(1,$TotalPages,'ShowRoom','page');
                        }
                        return $this;
                    }
                    else // Действия с Пагинацией
                    {

                        if(isset($_SESSION['search']))
                        {
                            $this->SearchPlaysholder = $_SESSION['search'];
                            $offset=($params[0]['val']-1)*$maxcontent;
                            $containerIfno->GetInfo(array('title','description','autor'),'OR','LIKE',$this->SearchPlaysholder,$maxcontent,$offset);
                            $RowsCountAjax = $containerIfno->CurentRows;
                            $TotalPages = intdiv($RowsCountAjax, $maxcontent); // Делим количество строк на количество материалов на странице
                            if($containerIfno->CurentRows > 0){
                                foreach ($containerIfno->Resulting as $el){
                                    $this->content_result.=$el['content'];
                                }
                            }
                            else{
                                $this->content_result.='<div class="mt-5 text-center"><h2>Ничего не найдено</h2></div>';
                            }
                            $this->pagination= new Pagination($params[0]['val'],$TotalPages,'ShowRoom','page');

                        }
                        else{
                            $offset=($params[0]['val']-1)*$maxcontent;
                            $containerIfno->GetInfo(null,null,null, null,$maxcontent,$offset); //Запрашиваем все данные из таблицы
                            if($containerIfno->CurentRows > 0){
                                foreach ($containerIfno->Resulting as $el){
                                    $this->content_result.=$el['content'];
                                }
                            }
                            else{
                                $this->content_result.='Ничего не найдено';
                            }
                            $this->pagination= new Pagination($params[0]['val'],$TotalPages,'ShowRoom','page'); // Создаем пагинацию

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