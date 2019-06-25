<?php


class Bootstrap
{
    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $path = explode('/', trim($uri, '/')) ;

        $loadingFile = '../app/controllers/' . ucfirst ($path[0]) . 'Controller.php';
        if (file_exists($loadingFile)) {
            require_once $loadingFile;
        } else {
            // TODO: create 404 view
            echo '<h1>Not found</h1>';
            return false;
        }

        // TODO: We'll refactor loading logic later to make better UX.
        $class = (ucfirst ($path[0]). 'Controller');
        $controller = new $class();

        if (isset($path[2])) {
            $controller->{$path[1]}($path[2]);
        } else if (isset($path[1])) {
            $controller->{$path[1]}();
        }
    }
}