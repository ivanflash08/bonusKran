<?
include 'bonusSite/config.php';
db();

$query  = mysqli_query($db, "SELECT `name`, `total` FROM `users` ORDER BY `total` DESC LIMIT 10");

if (mysqli_num_rows($query)) {
		while ($row = mysqli_fetch_assoc($query))
		 		$str .= '<tr><td>'.$row['name'].'</td><td>'.$row['total'].'</td></tr>';
}
else
 		$str = '<tr><td>n/a</td><td>n/a</td></tr>';

file_put_contents('cache/top1.txt', $str);

$str = '';


$query  = mysqli_query($db, "SELECT * FROM `history` ORDER BY `sum` DESC LIMIT 10");

if (mysqli_num_rows($query)) {
		while ($row = mysqli_fetch_assoc($query))
			 $str .= '<tr><td>'.$row['date'].'</td><td>'.$row['name'].'</td><td>'.r2f($row['sum']).'</td></tr>';
}
		else
 			$str = '<tr><td>n/a</td><td>n/a</td><td>n/a</td></tr>';

file_put_contents('cache/top2.txt', $str);

?>
