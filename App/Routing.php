<?php

namespace App;

use App\Src\App;

use Controllers\TiwitController;
use Controllers\UserController;


class Routing
{
    private $app;

    /**
     * Routing constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function setup()
    {
        $user = new UserController($this->app);
        $tiwit = new TiwitController($this->app);

        $this->app->get('/', [$user, 'LoginHandler']);

        $this->app->post('/login', [$user, 'LoginDBHandler']);

        $this->app->get('/register', [$user, 'RegisterHandler']);

        $this->app->post('/tryRegister', [$user, 'RegisterDBHandler']);

        $this->app->get('/home', [$user, 'HomeHandler']);

        $this->app->get('/home/(\d+)', [$user, 'HomeHandler']);

        $this->app->get('/user', [$user, 'UserHandler']);

        $this->app->post('/user/update', [$user, 'UserDBUpdate']);

        $this->app->post('/home/tiwit',[$tiwit, 'TiwitDBHandler']);

        $this->app->get('/home/affiche',[$tiwit, 'TiwitHandler']);

        $this->app->get('/home/userfollowed/(\d+)', [$user, 'FollowUserDBHandler']);
        }
    }