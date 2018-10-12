<?php
namespace App\Controllers;

use \App\Models\Food;

Class MainController extends BaseController
{
	public function home($request, $response, $args = null){
        $this->setMeta('title', 'Test page');

        $data = [
			'title' => 'my slim boilerplate',
		];
		$this->render($response, 'pages/page.twig', $data);
	}
}