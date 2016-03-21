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

			if((int)$result->errorInfo()[0]) {
				throw new UncheckedQueryException("DB error: ".implode(", ", $result->errorInfo()));
			}

			if(!$result->rowCount()) {
				foreach ($binds as $key => $value) {
					$query = str_replace($key, $value, $query);
				}
				throw new QueryEmptyResultException($query);
			}

			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result;
		}

	}