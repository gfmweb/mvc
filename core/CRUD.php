<?php
/**
 * Класс для работы с БД
 * ВСЕ Методы CRUD
 * При создании возвращает общее число строк в таблице
 * Работает через подготовленные запросы
 */

namespace core;

use config\Db;


class CRUD
{

    private $db;
    private $table;
    public  $TotalRows;
    public  $CurentRows;
    public  $Resulting;

    public function __construct($table) // Принимает имя таблицы с которой будет работать модель
    {
        $this->db = Db::init(); // Инициализиркет подключение к БД
        $this->table=$table; // Записываем в свойство имя таблицы

        $statement=$this->db->prepare("SELECT * FROM {$this->table}"); // Готовим запрос И узнаем сколько всего строк в таблице
        $statement->execute(); // Выполняем запрос
        $statement->get_result(); // получаем результат
        $this->TotalRows=$statement->affected_rows; // Считаем строки
        $statement->close(); // Закрываем запрос
    }

    /**
     * @param array|null $ColName
     * @param null $OR_AND
     * @param null $LIKE_RAVNO
     * @param int $limit
     * @param null $needle
     * @param int $offset
     *
     */
    public function GetInfo(array $ColName=null, $OR_AND=null, $LIKE_RAVNO=null,  $needle=null, $limit='all', $offset=0) // Метод получения данных из таблицы
        /**
         * Массив ячеек таблицы в которых будет проводиться поиск если НЕТ то будет искать везде
         * Как будем искать И / ИЛИ (по умолчанию ИЛИ)
         * Четкость ТОЧНО / ПРИБЛИЗИТЕЛЬНО (По умолчанию ПРИБЛИЗИТЕЛЬНО)
         * ТО ЧТО БУДЕМ ИСКАТЬ
         * ЛИМИТ выборки (по умолчанию ВСЕ)
         * СДВИГ (по умолчанию 0)
         */
    {
        unset($this->Results,$this->CurentRows); // Очищаем свойства Текущий результат и Текущее количество строк
        if($limit==='all'){$limit=$this->TotalRows;} // Если нет ограничения поиска то приминаем в его качестве общее количество строк в БД

        if((is_null($ColName))||(is_null($needle))) //  ЕСЛИ нет параметров поиска
        {
             $statement=$this->db->prepare("SELECT * FROM {$this->table} WHERE 1 LIMIT ? OFFSET ?"); // Готовим запрос
             $statement->bind_param('ss',$limit, $offset); // Передаем параметры
             $statement->execute(); // Выполняем запрос
             $OperationResults = $statement->get_result(); // Забираем результаты
             $this->CurentRows=$statement->affected_rows; // Посчитали строки
            while($row=$OperationResults->fetch_assoc()) // Парсим результат
            {
                $this->Resulting[]=$row; // Записываем результат в массив
            }
            $statement->close(); // Закрываем запрос

        }
        else // Если есть то что что мы ищем и где мы ищем
            {
                if($LIKE_RAVNO==='LIKE'){$needle="%".$needle."%";} // Преобразуем строку поиска для выражения LIKE
                if(is_null($OR_AND)){$OR_AND=' OR ';} // Если не пришел параметр то будем искать ИЛИ

                $needle=$this->db->real_escape_string($needle); // Экранируем строку
                $req="SELECT * FROM `".$this->table."` WHERE `".$ColName[0]."` ".$LIKE_RAVNO." '{$needle}'"; // Начальная часть запроса
                $iMax=count($ColName); // посчитали количество столбцов в которых будем искать


                    for($i=1; $i < $iMax; $i++) // создаем строку поиска
                        {
                        $req.=$OR_AND." `".$ColName[$i]."` ".$LIKE_RAVNO."  '".$needle."'";
                        }

                $req.=" LIMIT ".$limit." OFFSET ".$offset; // Добавляем к строке полученный результат ТРОКА ГОТОВА

                $statement=$this->db->query($req) or die($this->db->error); // Выполняем запрос к БД

                $this->CurentRows=$this->db->affected_rows; // Посчитали строки

                while($row=$statement->fetch_assoc())// распарсили ответ
                {
                    $this->Resulting[]=$row; // Записываем массив ответа
                }


            }
        return $this; // Возвращаем результат
    }


}