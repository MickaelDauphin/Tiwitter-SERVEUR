<?php

namespace App;

use App\Src\App;
use App\Src\ServiceContainer\ServiceContainer;
use Controllers\Usercontroller;
use Database\Database;
use Model\Finder\ObjectFinder;
use Model\Finder\UserFinder;
use Model\Finder\TiwitFinder;
use App\Src\Response\Response;
use App\Src\Request\Request;

$app = new App(new ServiceContainer());

$app->setService('database', new Database(
    getenv('MYSQL_ADDON_HOST');
    getenv('MYSQL_ADDON_DB');
    getenv('MYSQL_ADDON_USER');
    getenv('MYSQL_ADDON_PASSWORD');
    getenv('MYSQL_ADDON_PORT');
));

$app->setService('userFinder', new UserFinder($app));

$app->setService('objectFinder', new ObjectFinder($app));
$app->setService('tiwitFinder', new TiwitFinder($app));
$app->setService('render', function(String $template, Array $params = []) {

    ob_start();
    include __DIR__ . '/../Views/' . $template . '.php';
    $content = ob_get_contents();
    ob_end_clean(); // Does not sent the content of the buffer to the user

    if($template === '404')
    {
        $response = new Response($content, 404, ["HTTP/1.0 404 Not Found"]);
        return $response;
    }

    return $content;
}
);

$app->setService('redirect', function($location) {
    header("Location: $location");
    die();
});

$routing = new Routing($app);

$routing->setup();

return $app;
