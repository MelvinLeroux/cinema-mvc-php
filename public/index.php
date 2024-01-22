<?php 


require __DIR__.'/../vendor/autoload.php';


$router = new AltoRouter();

//! ATTENTION, si la partie fixe (BASE_URI) contient des caractères spéciaux ou des espaces, AltoRouter ne fonctionne pas ! 
$router->setBasePath($_SERVER['BASE_URI']);



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
if($match !== false) {
  
    $controllerToUse = 'App\Controllers\\' . $match['target']['controller'];
    // dd($router,$match, $match['target'], $match['target']['controller'],$controllerToUse);
    $methodToUse = $match['target']['method'];
   
    $params = $match['params'];
  
    $controller = new $controllerToUse();

    $controller->$methodToUse($params);
   

} else {
    echo "Erreur 404 - la page n'existe pas";
}