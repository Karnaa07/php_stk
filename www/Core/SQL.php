<?php
namespace App\Core;

abstract class SQL{

    private $pdo;
    private $table;

    public function __construct()
    {
        //Connexion à la bdd
        //SINGLETON à réaliser
        try {
            $this->pdo = new \PDO("pgsql:host=database;dbname=esgi;port=5432", "esgi", "Test1234");
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }

        //$this->table = static::class;
        $classExploded = explode("\\", get_called_class());
        $this->table = "esgi_".end($classExploded);
    }

    public static function populate(Int $id): object
    {
        $class = get_called_class();
        $objet = new $class();
        return $objet->getOneWhere(["id"=>$id]);
    }

    public function getOneWhere(array $where): object
    {
        $sqlWhere = [];
        foreach ($where as $column=>$value) {
            $sqlWhere[] = $column."=:".$column;
        }
        $queryPrepared = $this->pdo->prepare("SELECT * FROM ".$this->table." WHERE ".implode(" AND ", $sqlWhere));
        $queryPrepared->setFetchMode( \PDO::FETCH_CLASS, get_called_class());
        $queryPrepared->execute($where);
        return $queryPrepared->fetch();
    }


    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToExclude);

        if(is_numeric($this->getId()) && $this->getId()>0) {
            $sqlUpdate = [];
            foreach ($columns as $column=>$value) {
                $sqlUpdate[] = $column."=:".$column;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE ".$this->table.
                " SET ".implode(",", $sqlUpdate). " WHERE id=".$this->getId());
        }else{
            $queryPrepared = $this->pdo->prepare("INSERT INTO ".$this->table.
                " (".implode("," , array_keys($columns) ).") 
            VALUES
             (:".implode(",:" , array_keys($columns) ).") ");
        }

        $queryPrepared->execute($columns);

    }

}