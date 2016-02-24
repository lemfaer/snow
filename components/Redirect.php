<?php 

	class Redirect {

		public function __construct($path) {
			echo $this->generateJS($path);
		}

		private function generateJS($path) {
			$js =  "<script type='text/javascript'>";
			$js .= "document.location = '$path'";
			$js .= "</script>";

			return $js;
		}

	}