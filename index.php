<?

if ($_SERVER['REQUEST_URI'] == '/')
	$page = 'home';
else
	$page = substr($_SERVER['REQUEST_URI'], 1);


	session_start();

	include 'config.php';


	if (file_exists("all/$page.php"))
		include "all/$page.php";

	else if ($_SESSION['id'] == 1 and file_exists("auth/$page.php"))
		include "auth/$page.php";

	else if ($_SESSION['id'] != 1 and file_exists("guest/$page.php"))
		include "guest/$page.php";

	else
		exit('Страница 404');



function db() {
	global $db;
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$db)
		exit('Ошибка подключеня к БД');
}


function valid_captcha() {
	if (!$_POST['g-recaptcha-response'])
		message('Капча введена неверно');

	$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.RECAPTCHA_SECRET.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
	$data = json_decode(file_get_contents($url));
	if ($data->success == false)
		message('Капча введена неверно');
}


function top($title) {
	include 'html/top.php';
}



function bottom() {
	include 'html/bottom.php';
}



function message($text) {
	exit('{"message":"'.$text.'"}');
}


function go($url) {
	exit('{"go":"'.$url.'"}');
}

?>
