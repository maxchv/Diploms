<?php

namespace MVC\Config;

class DbConfig {

	public static function getConnection() {
		//$db = mysqli_connect("localhost","mysqladmin", "itstep");
        $db = mysqli_connect("localhost","mysqladmin", "itstep");
		mysqli_set_charset($db, "utf8");
		mysqli_select_db($db, "maxchv");
		
		return $db;
	}
}