<?php


namespace models;

use config\Db;


class CRUD
{
    private $db;
    private $table;
    public  $TotalRows;
    public  $CurentRows;
    Public  $Results;

    public function __construct($table)
    {
        $this->db = Db::init();
        $this->table=$table;

        $this->db->query("SELECT * FROM {$this->table}");
        $this->TotalRows=$this->db->affected_rows;
    }

    /**
     * @param array|null $ColName
     * @param null $OR_AND
     * @param null $LIKE_RAVNO
     * @param int $limit
     * @param null $needle
     * @param int $offset
     */
    public function GetInfo(array $ColName=null, $OR_AND=null, $LIKE_RAVNO=null, $limit='all', $needle=null, $offset=0)
    {
        unset($this->Results,$this->CurentRows);
        if($limit==='all'){$limit=$this->TotalRows;}

        if((is_null($ColName))||(is_null($needle))) // нет параметров поиска
        {
            $req=$this->db->query("SELECT * FROM {$this->table} WHERE 1 LIMIT {$limit} OFFSET {$offset}") or die($this->db->error);
            while($row=$req->fetch_assoc())
            {
                $this->Results[]=$row;
            }
        }
        else
            {
                $needle=$this->db->real_escape_string($needle);

                if($LIKE_RAVNO==='LIKE'){$needle="%".$needle."%";}
                if(is_null($OR_AND)){$where_usl=' OR ';}

                $cols="`".$ColName[0]."` ".$LIKE_RAVNO." '".$needle."' ";

                for ($i=1,$iMax=count($ColName); $i < $iMax; $i++)
                {
                    $cols.=$OR_AND." `".$ColName[$i]."` ".$LIKE_RAVNO." '".$needle."'"; // Подготовили область поиска
                }

                $req=$this->db->query("SELECT * FROM {$this->table} WHERE {$cols} LIMIT {$limit} OFFSET {$offset}") or die($this->db->error);
                $this->CurentRows=$this->db->affected_rows;

                while($row=$req->fetch_assoc())
                {
                    $this->Results[]=$row;
                }

            }
    }


}