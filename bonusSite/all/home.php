<? top ('главная страница') ?>

<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="form">
    <h1>получи бонус</h1>
    <p>Получи бонус до 1 Руб.</p>
    <div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_HTML?>"></div>
    <p class="rows"><button onclick="send_post('account', 'bonus', 'g-recaptcha-response')">получить</button></p>
</div>


<h1>Топ Активных</h1>
<table>
    <tr><th>псевдоним</th><th>получено бонусов</th></tr>
<?include 'cache/top1.txt' ?>
</table>

<h1>Последние выплаты</h1>
<table>
    <tr><th>дата</th><th>Пользователь</th><th>Сума</th></tr>
<? include 'cache/top2.txt' ?>
</table>

<? bottom() ?>
