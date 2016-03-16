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
			$result->execute($binds);

			if(!is_object($result) || !$result->rowCount()) {
				$dev = implode(", ", $db->errorInfo()); //dev
				throw new Exception("404 db: $dev", 1);
			}

			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result;
		}

	}