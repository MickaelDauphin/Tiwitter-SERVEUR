<?php

//namespace Model\Gateway;
//
//use App\Src\App;
//
//class ObjectGateway
//{
//    /**
//     * @var \PDO
//     */
//    private $conn;
//
//    /**
//     * @var App
//     */
//    private $app;
//
//
//    private $id;
//
//    private $name;
//    private $currentState;
//
//
//    public function __construct(App $app)
//    {
//        $this->conn = $app->getService('database')->getConnection();
//    }
//
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param mixed $name
//     */
//    public function setName($name): void
//    {
//        $this->name = $name;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getCurrentState()
//    {
//        return $this->currentState;
//    }
//
//    /**
//     * @param mixed $currentState
//     */
//    public function setCurrentState($currentState): void
//    {
//        $this->currentState = $currentState;
//    }
//
//
//    /**
//     * Insert an user
//     */
//    public function insert() : void
//    {
//        $query = $this->conn->prepare('INSERT INTO tiwitter.objects (name, currentState)
//                                                VALUES (:name, :currentState)');
//        $executed = $query->execute([':name' => $this->name, ':currentState' => $this->currentState]);
//
//        if (!$executed)
//            throw new \Error('Insert Failed');
//        else
//            $this->id = $this->conn->lastInsertId();
//    }
//
//    public function update() : void
//    {
//        if (!$this->id)
//            throw new \Error('Instance does not exist in base');
//
//        $query = $this->conn->prepare('UPDATE tiwitter.objects
//                                                SET name = :name,
//                                                currentState = :currentState
//                                                WHERE id = :id');
//        $executed = $query->execute([
//            ':id' => $this->id,
//            ':name' => $this->name,
//            ':currentState' => $this->currentState]);
//
//        if (!$executed)
//            throw new \Error('Update failed');
//    }
//
//    public function delete() : void
//    {
//        $query = $this->conn->prepare('DELETE FROM tiwitter.object
//                                                WHERE id = :id AND name = :name');
//        $executed = $query->execute([
//            ':id' => $this->id,
//            ':name' => $this->name
//        ]);
//
//        if (!$executed)
//            throw new \Error('Delete failed');
//    }
//
//    public function hydrate(array $elements)
//    {
//        $this->id = $elements['id'];
//        $this->name = $elements['name'];
//        $this->currentState = $elements['currentState'];
//    }
//
//}