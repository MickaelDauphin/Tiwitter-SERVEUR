<?php
/**
 * Created by PhpStorm.
 * User: remcr
 * Date: 17/06/2019
 * Time: 23:07
 */

namespace Model\Gateway;

use App\Src\App;

class ReTiwitGateway
{
    private $conn;

    private  $id;


    private $utilisateur;

    private $contenu;
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
        $query = $this->conn->prepare('INSERT INTO retiwit ( utilisateur, contenu) VALUES ( :utilisateur,:contenu)');
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

        $query = $this->conn->prepare('UPDATE retiwit SET utilisateur = :utilisateur, contenu = :contenu WHERE id = :id');
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