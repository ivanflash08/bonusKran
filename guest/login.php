<? top('Вход') ?>

<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="form">
	<h1>Вход</h1>
	<p class="rows"><input type="text" id="wallet" placeholder="Кошелек"></p>
	<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_HTML?>"></div>
	<p class="rows"><button onclick="send_post('account', 'login', 'wallet.name.g-recaptcha-response')">Войти в аккаунт</button></p>
</div>

<? bottom() ?>
