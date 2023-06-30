<?php
namespace App\Core;

class SQL{

    private static $instance;
    protected $pdo;
    private $table = "esgi_user";

    private function __construct()
    {
        // Connexion à la base de données
        try {
            $this->pdo = new \PDO("pgsql:host=database;dbname=esgi;port=5432", "esgi", "Test1234");
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer l'instance unique de la classe (crée une nouvelle instance si elle n'existe pas déjà)
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Méthode pour obtenir l'objet PDO de la connexion à la base de données
    public function getConnection()
    {
        return $this->pdo;
    }


    public static function populate(Int $id): object
    {
        $class = get_called_class();
        $objet = new $class();
        return $objet->getOneWhere(["id"=>$id]);
    }

    public function getOneWhere(array $where): object|bool
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

    public function deleteWhere(array $where): void
    {
        $sqlWhere = [];
        foreach ($where as $column => $value) {
            $sqlWhere[] = $column . "=:" . $column;
        }
        $queryPrepared = $this->pdo->prepare("DELETE FROM " . $this->table . " WHERE " . implode(" AND ", $sqlWhere));
        $queryPrepared->execute($where);
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToExclude);

        if (is_numeric($this->getId()) && $this->getId() > 0) {
            $sqlUpdate = [];
            foreach ($columns as $column => $value) {
                $sqlUpdate[] = $column . "=:" . $column;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE " . $this->table .
                " SET " . implode(",", $sqlUpdate) . " WHERE id=" . $this->getId());
        } else {
            $queryPrepared = $this->pdo->prepare("INSERT INTO " . $this->table .
                " (" . implode(",", array_keys($columns)) . ") 
                VALUES
                (:" . implode(",:", array_keys($columns)) . ")");
        }

        $queryPrepared->execute($columns);
    }
}