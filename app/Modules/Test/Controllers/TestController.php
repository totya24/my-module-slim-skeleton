<?php

namespace App\Modules\Test\Controllers;

use \App\Modules\Test\Models\TestModel;

class TestController extends \App\Controllers\BaseController
{
    public function test($request, $response, $args = null){

        $dataModel = new TestModel($this->container);
        $data = $dataModel->getAllItem();

        print_r($data);

        return $this->render($response, '@Test/test.twig', []);
    }
}