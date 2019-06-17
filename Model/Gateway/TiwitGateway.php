<?php
/**
 * Created by PhpStorm.
 * User: remcr
 * Date: 14/06/2019
 * Time: 17:21
 */

namespace Model\Gateway;

use App\Src\App;

class TiwitGateway
{
    private $conn;

    private  $id;


    private $utilisateur;

    private $contenu;

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
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenue
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function __construct(App $app)
    {
        $this->conn = $app->getService('database')->getConnection();
    }
    public function insert():void{
        $query = $this->conn->prepare('INSERT INTO tiwit ( utilisateur, contenu) VALUES ( :utilisateur,:contenu)');
        $executed = $query->execute([
            ':utilisateur' => $this->utilisateur,
            ':contenu' => $this->contenu,

        ]);
        if(!$executed) throw new \Error('Insert failed');

        $this->id = $this->conn->lastInsertId();
    }
    public function update():void
    {
        if (!$this->id) throw  new \Error('Instance does not exist in base');

        $query = $this->conn->prepare('UPDATE tiwit SET utilisateur = :utilisateur, contenu = :contenu WHERE id = :id');
        $exected = $query->execute([
            ':utilisateur' => $this->utilisateur,
            ':contenu' => $this->contenu,
        ]);
        if (!$exected) throw  new \Error('Update failed');
    }

    public function hydrate(array $elements){
        $this->id = $elements['id'];
        $this->utilisateur = $elements['utilisateur'];
        $this->contenu = $elements['contenu'];
    }

}