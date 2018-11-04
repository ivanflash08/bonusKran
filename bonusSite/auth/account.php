<?

if ($_POST['protect_f']) {

		$_POST['protect'] += 0;

		if ($_POST['protect'] != 0 and $_POST['protect'] != 1)
			message('Ошибка обработки формы');

		db();

		mysqli_query($db, "UPDATE `users` SET `protect` = $_POST[protect] WHERE `id` = $_SESSION[id]");
		$_SESSION['protect'] = $_POST['protect'];

		message('Изменения сохранены');
}

else if ($_POST['bonus_f']){
		valid_captcha();
		$time = time();

		db();

		$query = mysqli_query($db, "SELECT `time` FROM `time_limit` WHERE `ip` = '$_SERVER[REMOTE_ADDR]'");
		$limit = strtotime('+ 10 seconds');

		if (!mysqli_num_rows($query)) {
				mysqli_query($db, "INSERT INTO `time_limit` VALUES ('$_SERVER[REMOTE_ADDR]', $limit)");
		}
		else {
				$row = mysqli_fetch_assoc($query);
				if ($time < $row['time'])
				message('до следущего бонуса осталось: ' . ($row['time'] -$time). 'сек');

					mysqli_query($db, "UPDATE `time_limit` SET `time` = $limit WHERE `ip` = '$_SERVER[REMOTE_ADDR]'");
		}

		if ($_SESSION['total'] >= 100)
		  $disc = 40;

		else if ($_SESSION['total'] >= 50)
		  $disc = 20;

		else
		  $disc = 0;



		$bonus = round(mt_rand(MIN_BONUS, MAX_BONUS) / mt_rand( (MIN_BONUS * 5), (MAX_BONUS * 5) - $disc), 2);

		mysqli_query($db, "UPDATE `users` SET `balance` = `balance` + $bonus, `total` = `total` + 1 WHERE `id` = $_SESSION[id]");
		$_SESSION['balance'] += $bonus;
		$_SESSION['total'] += 1;

		message('получен бонус ' .r2f($bonus). ' руб.');
}


else if ($_POST['pay_f']) {
		if ($_SESSION['balance'] < MIN_PAY)
				message('Минимальная сумма для выплат '.r2f(MIN_PAY).' руб.');

		if ($_SESSION['ref'])
				$ref_bonus = ($_SESSION['balance'] * REF_BONUS) / 100;
		else
				$ref_bonus = 0;

		db();

		$balance = $_SESSION['balance'];
		$_SESSION['balance'] = 0;
		mysqli_query($db, "UPDATE `users` SET `balance` = 0 WHERE `id` = $_SESSION[id]");

		if ($_SESSION['ref'])
				mysqli_query($db, "UPDATE `users` SET `balance` = `balance` + $ref_bonus WHERE `id` = $_SESSION[ref]");

		mysqli_query($db, "INSERT INTO `history` VALUES(NOW(), '$_SESSION[name]', $balance)");


		require_once('cpayeer.php');
		$accountNumber = PAY_ACCOUNT;
		$apiId = PAY_ID;
		$apiKey = PAY_SECRET;
		$payeer = new CPayeer($accountNumber, $apiId, $apiKey);

		if ($payeer->isAuth()) {
				$arTransfer = $payeer->transfer(array(
						'curIn' => 'RUB',
						'sum' => 0.10,
						'curOut' => 'RUB',
						//'sumOut' => 1,
						'to' => 'P1005660533',
						'comment' => 'выплата бонусов',
						));
				if (empty($arTransfer['errors']))
						message('Выплата произведена, сума: '.$r2f($balance).' руб,  Номер транзакции: '.$arTransfer['historyId']);
				else
						message(print_r($arTransfer['errors'], true));
		}
		else
				message(print_r($payeer->getErrors(), true));
}


else if ($_POST['loto_f']) {

	$sunduk = array_pop($_POST);

	if ($sunduk < 1 or $sunduk > 6)
			message('сундук указан неверно');

	else if (!is_numeric($_POST['sum']) or $_POST['sum'] < 5)
		message('укажите суму, не мение 5 рублей');

		if ($sum > $_SESSION['balance'])
			message('Недостаточно денег');

	$rand = mt_rand(1, 6);
	db();

	if ($sunduk != $rand){
		$_SESSION['balance'] -= $_POST['sum'];
		mysqli_query($db, "UPDATE `users` SET `balance` = `balance` - $_POST[sum] WHERE `id` = $_SESSION[id]");
		message("Очень жаль но вы проиграли $_POST[sum] руб., победным оказался $rand сундук");
	}
	else {
	$double = round($_POST['sum'] * 2, 2);
	$_SESSION['balance'] += $double;
	mysqli_query($db, "UPDATE `users` SET `balance` = `balance` + $double WHERE `id` = $_SESSION[id]");
	message("Ура! Вы удвоили вашу суму");
	}
}

?>
