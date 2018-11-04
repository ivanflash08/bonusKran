<? top('Профиль') ?>

<script src="https://www.google.com/recaptcha/api.js"></script>

<h1><?=$_SESSION['name']?></h1>
<p>Ваш баланс: <?=r2f($_SESSION['balance'])?> руб.</p>
<p>Регистрационный IP: <?=$_SESSION['ip']?></p>
<p>Реф. ссылка: http://bonussite/<?=$_SESSION['id']?></p>
<p>получено бонусов: <?=$_SESSION['total']?></p>

<? if ($_SESSION['protect'] == 1): ?>
<input type="hidden" id="protect" value="0">
<p><button class="rows" onclick="send_post('account', 'protect', 'protect')">Выключить проверку по IP</button></p>
<? else : ?>
<input type="hidden" id="protect" value="1">
<p><button class="rows" onclick="send_post('account', 'protect', 'protect')">Включить проверку по IP</button></p>
<? endif; ?>

<P><button class="rows" onclick="send_post('account', 'pay')">Оформить выплату</button></p>


<h1>Список рефералов</h1>

<table>
  <tr><th>#</th><th>псевдоним</th><th>баланс</th> </tr>
  <?

  if ($_SESSION['reflist']) {
    foreach ($_SESSION['reflist']  as $key => $val) {
      echo '<tr><td>'.($key + 1).'</td><td>'.$val[0].'</td><td>'.r2f($val[1]).'</td></tr>';
    }
  }
  else
        echo '<tr><td>n/a</td><td>n/a</td><td>n/a</td></tr>';
  ?>
</table>

<? bottom() ?>
