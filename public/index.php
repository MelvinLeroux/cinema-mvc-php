<?php 

require __DIR__.'/../vendor/autoload.php';

$router = new AltoRouter();

//! ATTENTION, si la partie fixe (BASE_URI) contient des caractères spéciaux ou des espaces, AltoRouter ne fonctionne pas ! 
// $router->setBasePath($_SERVER['BASE_URI']);
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

$match = $router->match();

// ---- DISPATCHER ----- 
$dispatcher = new Dispatcher($match, 'ErrorController::err404');
$dispatcher->setControllersNamespace('App\Controllers');
$dispatcher->setControllersArguments($router, $match['name']);
$dispatcher->dispatch();
