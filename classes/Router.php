<?php

namespace classes;

class Router 
{
    public array $routes;


    public function register(string $route, callable|array $action){
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $route){
        $route = explode('?', $route)[0];

        if(! array_key_exists($route, $this->routes)){
            throw new \exceptions\UnexpectedURLException();
        }

        $action = $this->routes[$route];

        if(is_callable($action)){
            return call_user_func($action);
        }

        if(is_array($action)){
            [$class, $method] = $action;
            
            if(class_exists($class)){
                $class = new $class();
                
                if(method_exists($class,$method)){
                   return call_user_func_array([$class,$method], []);
                }
            }
        }
        
    }


}
