<? top('Вход для Администратора') ?>

<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="form">
	<h1>Вход для Администратора</h1>
	<p class="rows"><input type="text" id="login" placeholder="Логин"></p>
	<p class="rows"><input type="password" id="password" placeholder="пароль"></p>
	<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_HTML?>"></div>
	<p class="rows"><button onclick="send_post('account', 'a_login', 'login.password.g-recaptcha-response')">Войти в админку</button></p>
</div>

<? bottom() ?>
