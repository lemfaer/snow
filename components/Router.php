<?php

	class Router {

		private $routeArray;

		public function __construct() {
			$this->routeArray = include(ROOT."/config/routes.php");
		} 

		private function getURI() {
			if (!empty($_SERVER['REQUEST_URI'])) {
            	return trim($_SERVER['REQUEST_URI'], '/');
        	}
		}

		public function run() {
			$uri = $this->getURI();

			foreach($this->routeArray as $uriPattern => $path) {

				if(preg_match("~^$uriPattern$~", $uri)) {
					$path = preg_replace("~$uriPattern~", $path, $uri);

					$segments = explode("/", $path);
					$class = ucfirst(array_shift($segments))."Controller";
					$method = "action".ucfirst(array_shift($segments));

					call_user_func_array(array(new $class, $method), $segments);
					break;
				}

			}

		}

	}