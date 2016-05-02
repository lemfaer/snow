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
		self::handler();

		$uri = $this->getURI();

		$found = false;
		foreach($this->routeArray as $uriPattern => $path) {
			if(preg_match("~^$uriPattern$~", $uri)) {
				$found = true;

				$path = preg_replace("~$uriPattern~", $path, $uri);

				$segments = explode("/", $path);
				$class = ucfirst(array_shift($segments))."Controller";
				$method = "action".ucfirst(array_shift($segments));

				call_user_func_array(array(new $class, $method), $segments);
				break;
			}
		}

		if(!$found) {
			throw new PageNotFoundException("unknown page");
		}
	}

	public static function handler(Exception $e = null) {
		if(!isset($e)) {
			set_exception_handler(array(__CLASS__, "handler"));
			return;
		}
		?>

		<script>
			var elem = document.getElementsByTagName("body")[0];

			if(elem) {
				elem.innerHTML = '';
			}
		</script>

		<?php
		try {
			if($e instanceof PageNotFoundException) {
				View::template("/template/404.php");
			} else {
				View::template("/template/error.php");
			}
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("admin error views not found", $e);
		}
	}

}