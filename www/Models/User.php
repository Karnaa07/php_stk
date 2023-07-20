<?php

namespace App\Models;

use App\Core\SQL;


class User extends SQL
{
    private Int $id = 0;
    protected String $firstname;
    protected String $lastname;
    protected String $email;
    protected String $pwd;
    protected String $country;
    protected Int $status = 0;
    protected ?String $date_inserted;
    protected ?String $date_updated;
    protected ?String $token;
    protected String $verif_code;
    protected String $role_id;

    //Connexion with singleton
    public function __construct()
    {
        $this->pdo = SQL::getInstance()->getConnection();
        $classExploded = explode("\\", get_called_class());
        $this->table = $GLOBALS["config"]["dbprefix"]. "_" . end($classExploded);
    }

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param String $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return String
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param String $country
     */
    public function setCountry(string $country): void
    {
        $this->country = strtoupper(trim($country));
    }

    /**
     * @return Int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param Int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getDateInserted(): ?string
    {
        return $this->date_inserted;
    }

    public function setDateInserted(?string $date_inserted): void
    {
        $this->date_inserted = $date_inserted;
    }

    public function getDateUpdated(): ?string
    {
        return $this->date_updated;
    }

    public function setDateUpdated(?string $date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    public function generateToken(): void
    {
        $this->setToken(bin2hex(random_bytes(16)));
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(?String $token): void
    {
        $this->token = $token;
    }

    public function getRoleId(): int|null
    {
        return $this->role_id;
    }

    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }

    public function getVerifCode(): string|null
    {
        return $this->verif_code;
    }

    public function setVerifCode(string $verif_code): void
    {
        $this->verif_code = $verif_code;
    }


    public function delete()
    {
        $this->deleteWhere(['id' => $this->id]);
    }
    
    public function find($id) {
        $data = parent::find($id);
        if ($data) {
            $user = new User();
            $user->setId($data['id']);
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setEmail($data['email']);
            $user->setRoleId($data['role_id']);
            $user->setPwd($data['pwd']);
            $user->setCountry($data['country'] ?? ""); // Use the null coalescing operator to avoid errors if $data['country'] is not set
            // ... Continue to set all other properties of User ...
    
            return $user;
        }
        return null;
    }
    

    public function recupInfo(): array {
        return [
            'id' => $this->getId(),
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'email' => $this->getEmail(),
            'role_id' => $this->getRoleId(),
            'pwd' => $this->getPwd(),
            'country' => $this->getCountry(),
        ];
    }
}
