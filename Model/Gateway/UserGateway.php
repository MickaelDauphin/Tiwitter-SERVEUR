<?php


namespace Model\Gateway;

use App\Src\App;

class UserGateway
{
    /**
     * @var \PDO
     */
    private $conn;


    private $id;

    private $username;
    private $password;
    private $firstName;
    private $familyName;
    private $email;
    private $followedUser;


    public function __construct(App $app)
    {
        $this->conn = $app->getService('database')->getConnection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * @param mixed $familyName
     */
    public function setFamilyName($familyName): void
    {
        $this->familyName = $familyName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getFollowedUser()
    {
        if (is_array($this->followedUser))
            return $this->followedUser;
        else
            return null;
    }

    /**
     * @param mixed $followedUser
     */
    public function setFollowedUser($followedUser): void
    {
        $this->followedUser = $followedUser;
    }

    /**
     * Insert an user
     */
    public function insert() : void
    {
        $query = $this->conn->prepare('INSERT INTO user (firstName, familyName, username, password, email) 
                                                VALUES (:firstName, :familyName, :username, :password, :email)');
        $executed = $query->execute([':firstName' => $this->firstName,
            ':familyName' => $this->familyName,
            ':username' => $this->username,
            ':password' => $this->password,
            ':email' => $this->email]);

        if (!$executed)
            throw new \Error('Insert Failed');
        else
            $this->id = $this->conn->lastInsertId();
    }

    public function update(bool $withPassword = false) : void
    {
        if (!$this->id)
            throw new \Error('Instance does not exist in base');

        if ($withPassword)
        {
            $query = $this->conn->prepare('UPDATE user 
                                                SET firstName = :firstName,
                                                familyName = :familyName,
                                                username = :username,
                                                password = :password,
                                                email = :email
                                                WHERE id = :id');
            $executed = $query->execute([
                ':id' => $this->id,
                ':firstName' => $this->firstName,
                ':familyName' => $this->familyName,
                ':username' => $this->username,
                ':password' => $this->password,
                ':email' => $this->email
            ]);
        }
        else
        {
            $query = $this->conn->prepare('UPDATE user 
                                                SET firstName = :firstName,
                                                familyName = :familyName,
                                                username = :username,
                                                email = :email
                                                WHERE id = :id');
            $executed = $query->execute([
                ':id' => $this->id,
                ':firstName' => $this->firstName,
                ':familyName' => $this->familyName,
                ':username' => $this->username,
                ':email' => $this->email
            ]);
        }


        if (!$executed)
            throw new \Error('Update failed');
    }

    public function delete() : void
    {
        $query = $this->conn->prepare('DELETE FROM user
                                                WHERE id = :id AND username = :username AND password = :password');
        $executed = $query->execute([
            ':id' => $this->id,
            ':username' => $this->username,
            ':password' => $this->password
        ]);

        if (!$executed)
            throw new \Error('Delete failed');
    }

    public function hydrate(array $elements)
    {
        $this->id = $elements['id'];
        $this->username = $elements['username'];

        if (isset($elements['password']))
            $this->password = $elements['password'];

        $this->firstName = $elements['familyName'];
        $this->familyName = $elements['familyName'];
        $this->email = $elements['email'];
    }
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'familyName' => $this->familyName,
            'email' => $this->email,
        ];
    }

}