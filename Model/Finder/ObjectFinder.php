<?php

namespace Model\Finder;

use App\Src\App;
use Model\Gateway\ObjectGateway;

class ObjectFinder implements FinderInterface
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
        $query = $this->conn->prepare('SELECT DISTINCT id, name, currentState FROM objects ORDER BY id');
        $query->execute();
        $objects = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($objects) === 0)
            return null;

        return $objects;
    }

    public function findAllToJson()
    {
        $objects = $this->findAll();
        return json_encode($objects);
    }

    public function findOneById($id)
    {
        $query = $this->conn->prepare('SELECT id, name, currentState FROM objects WHERE id = :id');
        $query->execute([':id' => $id]);
        $element = $query->fetch(\PDO::FETCH_ASSOC);

        if (!is_countable($element) or count($element) === 0)
            return null;

        $object = new ObjectGateway($this->app);
        $object->hydrate($element);

        return $object;
    }

    public function findOneByName(string $name)
    {
        $query = $this->conn->prepare('SELECT id, name, currentState FROM objects WHERE name = :name');
        $query->execute([':name' => $name]);
        $element = $query->fetch(\PDO::FETCH_ASSOC);

        if (!is_countable($element) or count($element) === 0)
            return null;

        $object = new ObjectGateway($this->app);
        $object->hydrate($element);

        return $object;
    }

    public function SaveObject(Array $objectInfos) : Bool
    {
        try
        {
            $user = new ObjectGateway($this->app);
            $user->setName($objectInfos['name']);
            $user->setCurrentState($objectInfos['currentState']);

            $user->insert();

            return true;
        }
        catch (\Error $e)
        {
            return false;
        }
    }

    public function ChangeState(ObjectGateway $object) : bool
    {
        try
        {
            $state = $object->getCurrentState();
            $object->setCurrentState(!$state);
            $object->update();

            return true;
        }
        catch (\Error $e)
        {
            return false;
        }
    }
}