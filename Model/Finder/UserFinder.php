<?php


namespace Model\Finder;

use App\Src\App;
use Model\Gateway\UserGateway;

class UserFinder implements FinderInterface
{
    /**
     * @var \PDO
     */
    private $conn;

    /**
     * @var App
     */
    private $app;


    public function __construct(App $app) {
        $this->app = $app;
        $this->conn = $this->app->getService('database')->getConnection();
    }

    public function findAll()
    {
        $query = $this->conn->prepare('SELECT DISTINCT id, username, password, firstName, familyName, email FROM tiwitter.user ORDER BY id');
        $query->execute();
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if(count($elements)=== 0)return null;

        $users = [];
        $user = null;
        foreach ($elements as $elements){
            $user = new UserGateway($this->app);
            $user->hydrate($elements);
            $users[] = $user;
        }

        return $users;
    }

    public function findOneById($id)
    {
        $query = $this->conn->prepare('SELECT id, username, password, firstName, familyName, email FROM tiwitter.user WHERE id = :id');
        $query->execute([':id' => $id]);
        $element = $query->fetch(\PDO::FETCH_ASSOC);

        if (!is_countable($element) or count($element) === 0)
            return null;

        $user = new UserGateway($this->app);
        $user->hydrate($element);

        return $user;
    }

    public function VerrifyLogIn(String $username, String $password) : Bool
    {
        $query = $this->conn->prepare('SELECT user.username, user.password 
                                                FROM `user` 
                                                WHERE user.username = :username AND user.password = :password');
        $query->execute([':username' => $username, ':password' => $password]);
        $result = $query->fetch(\PDO::FETCH_ASSOC);


        if ($username == $result['username'] && $password == $result['password'])
            return true;
        else
            return false;
    }

    public function CreateUser(Array $userInfos) : Bool
    {
        try
        {
            $user = new UserGateway($this->app);
            $user->setUsername($userInfos['username']);
            $user->setPassword($userInfos['password']);
            $user->setFirstName($userInfos['firstName']);
            $user->setFamilyName($userInfos['familyName']);
            $user->setEmail($userInfos['email']);

            $user->insert();

            return true;
        }
        catch (\Error $e)
        {
            return false;
        }
    }
    public function findOneByName($strIdentity)
    {
        $query = $this->conn->prepare('SELECT id, username, password, firstName, familyName, email FROM tiwitter.user WHERE (username = :name OR email = :email)');
        $query->execute([':name' => $strIdentity, ':email' => $strIdentity]);
        $element = $query->fetch(\PDO::FETCH_ASSOC);

        if (!is_countable($element) or count($element) === 0)
            return null;

        $user = new UserGateway($this->app);
        $user->hydrate($element);

        return $user;
    }
    public function follow($userToFollowId)
    {
        $currentUserId = $this->app->getSessionParameters('user')['id'];

        if ($currentUserId === $userToFollowId) // L'utiliateur ne peut pas se suivre lui même
            throw new \Error("User can't follow himself", 1);

        $user = $this->app->getService('userFinder')->findOneById($currentUserId);

        $followedUser = $user->getFollowedUser();
        if (!is_null($followedUser))
            $isAlreadyFollowed = array_search($userToFollowId, $followedUser);
        else
            $isAlreadyFollowed = false;


        if ($isAlreadyFollowed === false)
            $user->follow($userToFollowId);
        else
            $user->unfollow($userToFollowId);


        $this->app->setSessionParameters('user', $user->toArray());
    }
}