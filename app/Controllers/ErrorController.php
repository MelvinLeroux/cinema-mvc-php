<?php
namespace App\Controllers;
/**
 * Cette classe représente le contrôleur
 * qui va gérer les erreurs HTTP
 */
class ErrorController extends CoreController
{ 
    public function err404()
    {
        // on modifie le status code de la réponse HTTP
        // @see https://www.php.net/manual/fr/function.http-response-code.php
        header('HTTP/1.0 404 Not Found');
        $this->show('error/error404');
    }
}
