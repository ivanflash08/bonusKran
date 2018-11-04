<?
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bonusSite_db');

define('RECAPTCHA_HTML', '6Lc6F3IUAAAAAL6bsqQhsSRhPY89G2QMyW4qDUoI');
define('RECAPTCHA_SECRET', '6Lc6F3IUAAAAAEUnF6iGdJR6tFZ8pn8Kvpsk0-GJ');

define('MIN_BONUS', 10);
define('MAX_BONUS', 50);

define('PAY_SECRET', 'SfiR577suTGLgwnP');
define('PAY_ID', '668177191');
define('PAY_ACCOUNT', 'P1005660533');

define('MIN_PAY', 10);
define('REF_BONUS', 3);

function db() {
	global $db;
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$db)
		exit('Ошибка подключеня к БД');
}
 ?>
