<?php

namespace App\Models;

class BaseModel 
{
    protected $container = null;

    public function __construct( \Interop\Container\ContainerInterface $container ){
        $this->container = $container;
    }
    
    public function __get($property){
        if( $this->container->has($property) ){
            return $this->container->get($property);
        }
    }

}