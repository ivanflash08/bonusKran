<?

function valid_wallet() {
	if (substr($_POST['wallet'], 0, 1) != 'P' or !is_numeric(substr($_POST['wallet'], 1)))
		message('Кошелек указан неверно');
}

if ($_POST['register_f']) {

	valid_captcha();

	if (!preg_match('/^[A-z0-9]{3,15}$/', $_POST['name']))
	message('Псевдоним может содержать только латинские буквы и цифры без пробелов, длиной от 3 до 15 символов');

	valid_wallet();

	db();

	if (mysqli_num_rows(mysqli_query($db, "SELECT `id` FROM `users` WHERE `wallet` = '$_POST[wallet]'")))
		message('Этот кошелек уже зарегистрирован');

  	mysqli_query($db, "INSERT INTO `users` VALUES('', '$_POST[name]', '$_POST[wallet]')");

	message('Регистрация завершена');
}


else if ($_POST['login_f']) {

	valid_captcha();
	valid_wallet();
	db();

	$query = mysqli_query($db, "SELECT * FROM `users` WHERE `wallet` = '$_POST[wallet]'");

	if (!mysqli_num_rows($query))
		message('Аккаунт не найден');

	$row = mysqli_fetch_assoc($query);

	foreach ($row as $key => $val)
		$_SESSION[$key] = $val;

	go('profile');

}

?>
