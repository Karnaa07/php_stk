<?php

namespace App\Models;

use App\Core\SQL;
use PDO;

class User extends SQL
{
    private int $id = 0;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $pwd;
    protected string $country;
    protected int $status = 0;
    private ?string $date_inserted;
    private ?string $date_updated;
    protected ?string $token;

    protected $table = "esgi_user";

    // Connexion with singleton
    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();
    }
    public static function find($id)
    {
        // Établir la connexion à la base de données (remplacez les informations appropriées)
        $connection = new PDO('mysql:host=localhost;dbname=nom_de_la_base_de_donnees', 'nom_utilisateur', 'mot_de_passe');

        // Préparer la requête SQL
        $statement = $connection->prepare('SELECT * FROM users WHERE id = :id');

        // Exécuter la requête avec les valeurs des paramètres
        $statement->execute(['id' => $id]);

        // Récupérer le résultat de la requête (premier enregistrement)
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Vérifier si un enregistrement a été trouvé
        if ($result) {
            // Créer une instance de la classe User et attribuer les valeurs des colonnes
            $user = new User();
            $user->setId($result['id']);
            $user->setFirstname($result['firstname']);
            $user->setLastname($result['lastname']);
            // Assigner les autres propriétés de l'utilisateur

            return $user;
        }

        return null; // Aucun enregistrement trouvé avec l'ID spécifié
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = strtoupper(trim($country));
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getDateInserted(): ?string
    {
        return $this->date_inserted;
    }

    /**
     * @param string|null $date_inserted
     */
    public function setDateInserted(?string $date_inserted): void
    {
        $this->date_inserted = $date_inserted;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->date_updated;
    }

    /**
     * @param string|null $date_updated
     */
    public function setDateUpdated(?string $date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    /**
     * Generate a token.
     */
    public function generateToken(): void
    {
        $this->setToken(bin2hex(random_bytes(16)));
    }

    /**
     * Get the token.
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set the token.
     *
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * Get all users.
     *
     * @return array
     */

    // public function all(): array
    // {
    //     $query = "SELECT * FROM " . $this->table;
    //     $statement = $this->pdo->query($query);
    //     return $statement->fetchAll(PDO::FETCH_CLASS, User::class);
    // }

    public function all($limit = 100, $offset = 0): array
        {
            $query = "SELECT * FROM " . $this->table . " LIMIT :limit OFFSET :offset";
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

}
