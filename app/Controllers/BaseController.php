<?php
namespace App\Controllers;

use \Slim\Views\Twig;

Class BaseController
{

	protected $view = null;
	protected $flash = null;
	protected $container = null;
	protected $twigEnv = null;
	protected $baseUrl = null;
	protected $assetsUrl = null;

	public function __construct( \Interop\Container\ContainerInterface $container, Twig $twig ){

		$request = $container->get('request');
		$assets = $container->get('assets');
		
		$this->view = $twig;
		$this->flash = $container->get('flash');
		$this->container = $container;
		$this->twigEnv = $twig->getEnvironment();
		$this->baseUrl = $request->getUri()->getBaseUrl();
		$this->assetsUrl = $this->baseUrl . $assets['baseDir'];

		$appData = [
			'baseUrl' => $this->baseUrl,
			'assetsUrl' => $this->assetsUrl,
			'styleSheets' => [],
			'headerScripts' => [],
			'footerScripts' => [],
			'meta' => []
		];

		if(!empty($assets['css'])){
			foreach($assets['css'] as $id => $css){
				$appData['styleSheets'][$id] = ($this->_isExternalUrl($css) ? '' : $this->assetsUrl) . $css;
			}
		}
		if(!empty($assets['js']['header'])){
			foreach($assets['js']['header'] as $id => $js){
				$appData['headerScripts'][$id] = ($this->_isExternalUrl($js) ? '' : $this->assetsUrl) . $js;
			}
		}
		if(!empty($assets['js']['footer'])){
			foreach($assets['js']['footer'] as $id => $js){
				$appData['footerScripts'][$id] = ($this->_isExternalUrl($js) ? '' : $this->assetsUrl) . $js;
			}
		}

		$this->twigEnv->addGlobal('app', $appData);
	}
	
    public function _isExternalUrl($url){
		return !(strpos($url, '//') === false);
	}
    
	public function addCss($css = null, $id = null){
		if( empty($css) ) return false;

		$appData = $this->twigEnv->getGlobals('app');
		if( is_null($id) ){
			$pathInfo = pathinfo($css);
			$id = $pathInfo['filename'];
		}
		$appData['app']['styleSheets'][$id] = ($this->_isExternalUrl($css) ? '' : $this->assetsUrl) . $css;

		$this->twigEnv->addGlobal('app', $appData['app']);
	}

	public function removeCss($id){
		$appData = $this->twigEnv->getGlobals('app');
		unset($appData['app']['styleSheets'][$id]);
		$this->twigEnv->addGlobal('app', $appData['app']);
	}

	public function addFooterScript($script = null, $id = null, $order = null){
		$this->addScript($script, $id, $order, 'footerScripts');
	}
	
	public function addHeaderScript($script = null, $id = null, $order = null){
		$this->addScript($script, $id, $order, 'headerScripts');
	}

	public function addScript($script = null, $id = null, $order = null, $position = 'headerScripts'){
		if( empty($script) ) return false;

		$appData = $this->twigEnv->getGlobals('app');
		$scripts = $appData['app'][$position];
		if(is_null($id)){
			$pathInfo = pathinfo($script);
			$id = $pathInfo['filename'];
		}
		
        $script = ($this->_isExternalUrl($script) ? '' : $this->assetsUrl) . $script;
		
        if($order){
            $ordering = explode(':', $order);
            $pos = array_search($ordering[1], array_keys($scripts));
            
            if(false !== $pos){
                $pos = $ordering[0] == 'after' ? $pos+1 : $pos;
                $scripts = array_slice($scripts, 0, $pos, true) + [$id => $script] + array_slice($scripts, $pos, null, true);
            }
        } else {
            $scripts[$id] = $script;
        }
            
        $appData['app'][$position] = $scripts;  
        
		$this->twigEnv->addGlobal('app', $appData['app']);
	}
	
	public function removeScript($id, $position = null){
		$appData = $this->twigEnv->getGlobals('app');
        
		if($position == 'header' || is_null($position)){
			unset($appData['app']['headerScripts'][$id]);
		}
        
		if($position == 'footer' || is_null($position)){
			unset($appData['app']['footerScripts'][$id]);
		}
        
		$this->twigEnv->addGlobal('app', $appData['app']);
	}

	public function setMeta($data, $value = null){
		$metaData = [];
		if( is_array($data) ){
			$metaData = $data;
		} else {
			if( !is_null($value) ){
				$metaData[$data] = $value;
			}
		}
		
		if(empty($metaData)) return false;
		
        $appData = $this->twigEnv->getGlobals('app');
		$currentMeta = $appData['app']['meta'];
        $newMeta = array_merge($currentMeta,$metaData);
		$appData['app']['meta'] = $newMeta;
        $this->twigEnv->addGlobal('app', $appData['app']);
	}
	
	public function render($template = null, $data = []){
		return $this->view->render($template, $data);
	}
	
}