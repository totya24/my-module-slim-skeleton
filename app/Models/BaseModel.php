<?php

namespace App\Models;

class BaseModel 
{
    protected $db = null;
    protected $container = null;

    public function __construct( \Interop\Container\ContainerInterface $container ){
        $this->container = $container;
        $this->db = $container->get('db');
    }

}