<? top('Регистрация') ?>

<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="form">
	<h1>Регистрация</h1>
	<p class="rows"><input type="text" id="wallet" placeholder="Кошелек"></p>
	<p class="rows"><input type="text" id="name" placeholder="Псевдоним"></p>
	<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_HTML?>"></div>
	<p class="rows"><button onclick="send_post('account', 'register', 'wallet.name.g-recaptcha-response')">Создать аккаунт</button></p>
</div>

<? bottom() ?>
