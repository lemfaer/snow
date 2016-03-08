<?php

	class DB {

		private static $connection;

		public static function getConnection() {
			if(!isset(self::$connection)) {
				$paramArray = include(ROOT."/config/dbParams.php");
				$dsn = "mysql:host={$paramArray['host']};dbname={$paramArray['dbname']}";
				self::$connection = new PDO($dsn, $paramArray['user'], $paramArray['password']);
				self::$connection->exec("set names utf8");
			}
			return self::$connection;
		}

		public static function query($query, $binds = array()) {
			$db = self::getConnection();

			$result = $db->prepare($query);
			foreach ($binds as $key => $value) {
				$result->bindParam($key, strval($value), PDO::PARAM_STR);
			}
			$result->execute();

			if(!is_object($result) || !$result->rowCount()) {
				print_r($db->errorInfo()); //dev
				throw new Exception("404", 1);
			}

			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result;
		}

	}