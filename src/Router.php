<?php
namespace Vannghia\PetCare;
class Router{
    protected $router = [];
    public function addRoutes($uri, $controller, $action){
        $this->router[$uri] = ['controller' => $controller, 'action' => $action];
    }


    public function handle($uri){
        if (array_key_exists($uri, $this->router)) {
            $controller = $this->router[$uri]['controller'];
            $action = $this->router[$uri]['action'];
            $controller = new $controller();
            $controller->$action();
        } else {
            throw new \Exception("No route found for URI: $uri");
        }
    }

}