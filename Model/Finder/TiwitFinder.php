<?php
/**
 * Created by PhpStorm.
 * User: remcr
 * Date: 14/06/2019
 * Time: 17:18
 */

namespace Model\Finder;


use Model\Gateway\TiwitGateway;
use app\src\App;

class TiwitFinder implements FinderInterface
{
    public function __construct(App $app) {
        $this->app = $app;
        $this->conn = $this->app->getService('database')->getConnection();
    }
    public function findAll(){
        $query = $this->conn->prepare('SELECT t.id, t.utilisateur, t.contenu FROM tiwit t ORDER BY t.id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);
        if(count($elements)=== 0)return null;

        $tiwits = [];
        $tiwit = null;
        foreach ($elements as $elements){
            $tiwit = new TiwitGateway($this->app);
            $tiwit->hydrate($elements);
            $tiwits[] = $tiwit;
        }

        return $tiwits;
    }
    public function findOneById($id){}

    public function getPost($id){
        $query = $this->conn->prepare('SELECT id, contenu, utilisateur FROM post WHERE contenu like :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        $element = $query->fetchAll(\PDO::FETCH_ASSOC);

        if($element == null) return null;

        $post = new PostGateway($this->app);
        $post->hydrate($element);

        return $post;
    }


    public function CreateTiwit(Array $tiwits) : Bool
    {
        try
        {
            $tiwit = new TiwitGateway($this->app);
            $tiwit->setContenu($tiwits['contenu']);
            $tiwit->setUtilisateur($tiwits['utilisateur']);


            $tiwit->insert();

            return true;
        }
        catch (\Error $e)
        {
            return false;
        }
    }
}