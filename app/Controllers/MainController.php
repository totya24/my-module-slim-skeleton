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
		sdf
		$this->render('pages/page.twig', $data);
	}
}