<?php

namespace App\Core;

use PDO;

class SQL
{

    private static $instance;
    protected $pdo;
    protected $table;

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

    // Méthode pour obtenir le nom de la table
    public static function populate(Int $id): object
    {
        $class = get_called_class();
        $objet = new $class();
        return $objet->getOneWhere(["id" => $id]);
    }

    // Méthode pour obtenir un élément d'une table en fonction de son id
    public function getOneWhere(array $where): object|bool
    {
        $sqlWhere = [];
        foreach ($where as $column => $value) {
            $sqlWhere[] = $column . "=:" . $column;
        }
        $queryPrepared = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE " . implode(" AND ", $sqlWhere));
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
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

    // Méthode pour obtenir tous les éléments d'une table
    public function getAll(): array|bool
    {
        $queryPrepared = $this->pdo->prepare("SELECT * FROM " . $this->table);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $queryPrepared->execute();
        return $queryPrepared->fetchAll();
    }

    // Méthode pour compter tous les éléments d'une table
    public function countAll(): int
    {
        $query = "SELECT COUNT(*) FROM " . $this->table;
        $statement = $this->pdo->query($query);
        return $statement->fetchColumn();
    }

    public function all($limit = 100, $offset = 0): array
    {
        $query = "SELECT esgi_user.*, esgi_role.name AS role_name 
                FROM " . $this->table . " 
                INNER JOIN esgi_role ON esgi_user.role_id = esgi_role.id
                LIMIT :limit OFFSET :offset";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        }

        return null; // Aucun enregistrement trouvé avec l'ID spécifié
    }

    public function protectScriptInjection(array $columns): array
    {
        $newColumns = [];
        foreach ($columns as $key => $value) {
            if(is_string($value)){
                $valueTemp = str_replace(">", "&gt;", $value);
                $valueTemp = str_replace("<", "&lt;", $valueTemp);
                $newColumns[$key] = $valueTemp;
            }
            else{
                $newColumns[$key] = $value;
            }
        }

        return $newColumns;
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToExclude);
        $columns = $this->protectScriptInjection($columns);

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
