<?php
class Gatekeeper {
	private static $user;
	private static $userColumns = "id, username, firstName, lastName, lastSeen, email, level, notifyBoard";


	public static function getUser(DatabasePDO &$db) {
		if(isset(self::$user['id'])) {
			return self::$user;
		}

		self::$user = self::getUserFromSession($db);
		if(isset(self::$user['id'])) {
			self::$user['authorized_by']="session";
			return self::$user;
		}

		self::$user = self::getUserFromCookie($db);
		if(isset(self::$user['id'])) {
			self::$user['authorized_by']="cookie";
			return self::$user;
		}

		// TODO: remember me does not work?
		//die($_COOKIE['code']);

		return null;
	}

	private static function getUserFromSession(&$db) {
		return $db->getRow("SELECT ".self::$userColumns." FROM users WHERE id=? LIMIT 1", array(intval($_SESSION['userID'])));
	}

	private static function getUserFromCookie(&$db) {
		return $db->getRow("SELECT ".self::$userColumns." FROM users WHERE MD5(CONCAT(username,password,'".SALT."'))=? LIMIT 1", array($_COOKIE['code']));
	}


	public static function login($username, $password, DatabasePDO &$db, $saveCookie) {
		self::$user = $db->getRow("SELECT ".self::$userColumns." FROM users WHERE username=? AND password=? LIMIT 1", array($username, $password));
		self::$user['authorized_by']="login";

		$_SESSION['userID'] = self::$user['id'];

		if($saveCookie) {
			setcookie("code", md5(self::$user['username'].self::$user['password'].SALT), time()+3600*24*356, '/');
		}

		return self::$user;
	}

	public static function logout() {
		unset($_SESSION['userID']);
		setcookie("code", NULL, time()-666, '/');
	}
}
?>