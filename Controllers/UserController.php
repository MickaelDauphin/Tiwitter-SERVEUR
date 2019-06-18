<?php

namespace Controllers;

use App\Src\App;
use App\Src\Request\Request;
use Model\Finder\UserFinder;
use Model\Gateway\UserGateway;

class UserController extends ControllerBase
{
 /**
 @var static String User connected now
*/

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function LoginHandler(Request $request)
    {
        if (!$this->IsConnected())
            return $this->app->getService('render')('Login');
        else
        {
            $this->app->destroySession();
            $this->app->getService('redirect')('/'); // Redirige vers la page de connexion
        }
    }

    public function LoginDBHandler(Request $request)
    {
        $userInfos = [
            'username' => $request->getParameters('username'),
            'password' => md5($request->getParameters('password')),
        ];

        $check = $this->app->getService('userFinder')->VerrifyLogIn($userInfos['username'], $userInfos['password']);

        if ($check == true)
        {
            $this->app->setSessionParameters('user', $this->app->getService('userFinder')->findOneByName($userInfos['username'])->toArray());
            return $this->app->getService('redirect')('/home');
        }
        else
            return $this->AccessDenied();

    }

    private function AccessDenied()
    {
        return $this->app->getService('render')('Login', ['accessDenied' => true]);
    }

    public function HomeHandler(Request $request, $id = null)
    {
        if ($this->IsConnected())
        {
            if ($id != null)
            {
                $this->app->getService('redirect')('/home');

            }
            $user = $this->app->getService('userFinder')->findAll();
            return $this->app->getService('render')('home', [ 'app' => $this->app,'user'=>$user]);
        }
        else
            return $this->app->getService('redirect')('/');
    }

    public function RegisterHandler(Request $request)
    {
        return $this->app->getService('render')('Register');
    }

    public function RegisterDBHandler(Request $request)
    {
        $userInfos = [
            'firstName' => $request->getParameters('firstName'),
            'familyName' => $request->getParameters('familyName'),
            'username' => $request->getParameters('username'),
            'password' => md5($request->getParameters('password')),
            'passwordConfirm' => md5($request->getParameters('passwordConfirm')),
            'email' => $request->getParameters('email')
        ];

        if ($this->app->getService('userFinder')->findOneByName($userInfos['username']) === null)
        {
            if ($userInfos['password'] == $userInfos['passwordConfirm'])
                $result = $this->app->getService('userFinder')->CreateUser($userInfos);
            else
                return $this->app->getService('render')('Register', ['passwordError' => true]);


            if (!$result)
                return $this->app->getService('render')('Register', ['registered' => false]);
            else
                return $this->app->getService('render')('Login', ['registered' => true]);
        }
        else
            return $this->app->getService('render')('Register', ['userExist' => true]);




    }

    public function UserHandler(Request $request)
    {
        if ($this->IsConnected())
        {
            return $this->app->getService('render')('UserInfos', ['app' => $this->app]);
        }
        else
            return $this->app->getService('redirect')('/');
    }

    public function UserDBUpdate(Request $request)
    {
        $md5NullString = "d41d8cd98f00b204e9800998ecf8427e";

        $userInfos = [
            'firstName' => $request->getParameters('firstName'),
            'familyName' => $request->getParameters('familyName'),
            'username' => $request->getParameters('username'),
            'password' => md5($request->getParameters('password')),
            'passwordConfirm' => md5($request->getParameters('passwordConfirm')),
            'email' => $request->getParameters('email')
        ];

        $user = new UserGateway($this->app);
        $user->hydrate($this->app->getSessionParameters('user'));

        if ($userInfos['firstName'] !== "")  // Prénom
            $user->setFirstName($userInfos['firstName']);

        if ($userInfos['familyName'] !== "") // Nom de famille
            $user->setFamilyName($userInfos['familyName']);

        if ($userInfos['email'] !== "") // Email
            $user->setEmail($userInfos['email']);

        if ($userInfos['username'] !== "") // Nom d'utilisateur
            $user->setUsername($userInfos['username']);


        if ($userInfos['password'] === $md5NullString) // Mot de passe
        {
            $user->update();
            $this->UpdateCurrentUser($user->getId());
        }
        else
        {
            if ($userInfos['password'] === $userInfos['passwordConfirm'])
            {
                $user->setPassword($userInfos['password']);
                $user->update(true);
                $this->UpdateCurrentUser($user->getId());
            }
            else
                return $this->app->getService('render')('UserInfos', ['app' => $this->app, 'passwordError' => true]);
        }

        return $this->app->getService('render')('UserInfos', ['app' => $this->app, 'success' => true]);
    }


    private function IsConnected() : bool
    {
        if ($this->app->getSessionParameters('user') !== null)
            return true;
        else
            return false;
    }

    private function UpdateCurrentUser($id)
    {
        $this->app->setSessionParameters('user', $this->app->getService('userFinder')->findOneById($id)->toArray());
    }

    public function followUserDBHandler(Request $request)
    {
        try
        {
            $userId = $request->getParameters('userId');
            $this->app->getService('userFinder')->follow($userId);

            return $this->app->getService('redirect')('/home');

        }
        catch (\Error $e)
        {
            return $this->app->getService('render')('404', ['reason' => "Erreur", 'details' => "Vous ne pouvez pas vous suivre vous même"]);
        }
    }

}