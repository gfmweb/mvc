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

    public function __construct($table)
    {
        $this->db = Db::init();
        $this->table=$table;

        $statement=$this->db->prepare("SELECT * FROM {$this->table}"); // Готовим запрос
        $statement->execute(); // Выполняем запрос
        $statement->get_result();
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
    public function GetInfo(array $ColName=null, $OR_AND=null, $LIKE_RAVNO=null,  $needle=null, $limit='all', $offset=0)
    {
        unset($this->Results,$this->CurentRows);
        if($limit==='all'){$limit=$this->TotalRows;}

        if((is_null($ColName))||(is_null($needle))) // нет параметров поиска
        {
             $statement=$this->db->prepare("SELECT * FROM {$this->table} WHERE 1 LIMIT ? OFFSET ?"); // Готовим запрос
             $statement->bind_param('ss',$limit, $offset); // Передаем параметры
             $statement->execute(); // Выполняем запрос
             $OperationResults = $statement->get_result(); // Забираем результаты
             $this->CurentRows=$statement->affected_rows; // Посчитали строки
            while($row=$OperationResults->fetch_assoc())
            {
                $this->Resulting[]=$row;
            }
            $statement->close();

        }
        else
            {
                if($LIKE_RAVNO==='LIKE'){$needle="%".$needle."%";}
                if(is_null($OR_AND)){$OR_AND=' OR ';}
                $reserved=array('select','insert','update','show','create','delete','join','source','drop');
                foreach ($reserved as $word)
                {
                   $needle= str_ireplace($word,'',$needle);
                }

                $req="SELECT * FROM `".$this->table."` WHERE `".$ColName[0]."` ".$LIKE_RAVNO." '{$needle}'"; // Начальная часть запроса
                $iMax=count($ColName);


                    for($i=1; $i < $iMax; $i++)
                        {
                        $req.=$OR_AND." `".$ColName[$i]."` ".$LIKE_RAVNO."  '".$needle."'";
                        }

                $req.=" LIMIT ".$limit." OFFSET ".$offset;

                $statement=$this->db->query($req) or die($this->db->error);

                $this->CurentRows=$this->db->affected_rows; // Посчитали строки




                while($row=$statement->fetch_assoc())// распарсили ответ
                {
                    $this->Resulting[]=$row;
                }


            }
        return $this;
    }


}