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
    //     $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    //     // Convertir les dates au format DateTime
    //     foreach ($users as &$user) {
    //         $user['date_inserted'] = ($user['date_inserted'] !== null) ? new \DateTime($user['date_inserted']) : null;
    //         $user['date_updated'] = ($user['date_updated'] !== null) ? new \DateTime($user['date_updated']) : null;
    //     }

    //     return $users;
    // }
    public function all(): array
    {
        $query = "SELECT * FROM " . $this->table;
        $statement = $this->pdo->query($query);
        return $statement->fetchAll(PDO::FETCH_CLASS, User::class);
    }

}
