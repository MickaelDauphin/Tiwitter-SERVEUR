<?php
/**
 * Created by PhpStorm.
 * User: remcr
 * Date: 14/06/2019
 * Time: 17:16
 */

namespace Controllers;


use app\src\App;
use app\src\request\Request;
use Model\Finder\TiwitFinder;
use Model\Gateway\TiwitGateway;
use Controllers\UserController;

class TiwitController extends ControllerBase
{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }
    public function TiwitDBHandler(Request $request){
        $tiwits = [
            'contenu' => $request->getParameters('tiwit'),
            'utilisateur' => $_SESSION['user']['username'],

        ];

        $result = $this->app->getService('tiwitFinder')->createTiwit($tiwits);

        if (!$result)
        {
            $this->app->getService('redirect')('/home');
        }
       else
           $this->app->getService('redirect')('/home');

    }
    /*private function TiwitPosted(){
        return $this->app->getService('render')('Home', ['tiwitPosted' => true]);
    }*/
    public function TiwitHandler(){

        if ($this->IsConnected())
        {
            $tiwits = $this->app->getService('tiwitFinder')->findAll();
            return $this->app->getService('render')('Affiche', ['app' => $this->app ,'tiwits' => $tiwits]);
        }
        else
            return $this->app->getService('redirect')('/');


    }

    private function IsConnected() : bool
    {
        if ($this->app->getSessionParameters('user') !== null)
            return true;
        else
            return false;
    }
}