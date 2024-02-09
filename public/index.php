<?php 


require __DIR__.'/../vendor/autoload.php';




$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
} else { // sinon
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}


$router->map(
    'GET',  
    '/',  
    
    [    
        'controller' => 'MainController',
        'method' => 'homeAction'
    ],
    'home'
);

$router->map(
    'GET',
    '/results',
    [
        'controller' => 'MainController',
        'method' => 'searchAction'
    ],
    'search'
);

$router->map(
    'GET',  // Méthode HTTP de la requete (get ou post)
    '/movie/[i:id]',  // url de la route (/ = home)
    // Tableau contenant le controller et la méthode liée à la page
    [    
        'controller' => 'MainController',
        'method' => 'movieAction'
    ],
    'movie'
);

$router->map(
    'GET',
    '/director/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'directorAction'
    ],
    'director'
);

$router->map(
    'GET',
    '/composer/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'composerAction'
    ],
    'composer'
);

$router->map(
    'GET',
    '/actor/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'ActorAction'
    ],
    'actor'
);

$router->map(
    'GET',
    '/error404',
    [
        'controller =>ErrorController',
        'method'=> 'err404',
    ],
    'error404'
);

$match = $router->match();





// ---- DISPATCHER ----- 
$dispatcher = new Dispatcher($match, 'ErrorController::err404');

$dispatcher->setControllersNamespace('App\Controllers');
$dispatcher->setControllersArguments($router);
// new MainController($router);
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();
