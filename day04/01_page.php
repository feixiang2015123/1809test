<?php
include 'DB.php';
include 'Page.php';

$db  = new DB;
$arr = $db->table('poetry')->fetchAll();
// count() 查看数组中有多少元素
$total = count($arr);
echo '总数量: ', $total, '<br>';
$p = $_GET['p'] ?? 1;
echo '当前页: ', $p, '<br>';

//每页数量
$num = 10;

//页数= 向上取整(总数量 / 每页数量)
$pages = ceil($total / $num);
echo "总页数: {$pages}<br>";

//第一页的数据. limit 0,10    limit 序号,数量
$index = ($p - 1) * $num; //序号=(页数-1)*每页数量

//分页数据
$arr = $db->table('poetry')->limit("$index,$num")->fetchAll();

//分页类
$page = new Page($total, $num);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		span{
			display: inline-block;
			padding: 5px;
			width: 50px;
			text-align: center;

			border-radius: 2px;
			text-decoration: none;
			margin: 0 3px;
			color: gray;
			background-color: lightgray;
		}

		a{
			display: inline-block;
			padding: 5px;
			width: 50px;
			text-align: center;
			border: 1px solid purple;
			border-radius: 2px;
			text-decoration: none;
			margin: 0 3px;
			color: black;
		}
		a:hover{
			background-color: rgba(0, 255, 0, 0.5);
			color: white;
		}
	</style>
</head>
<body>
	<p>
		<!-- 显示分页 -->
		<?php $page->show();?>
	</p>
	<table border="1" cellspacing="0">
		<tr>
			<td>题目</td>
			<td>作者</td>
			<td>类型</td>
			<td>内容</td>
		</tr>
		<?php foreach ($arr as $key => $value): ?>
		<tr>
			<td><?php echo $value['title']; ?></td>
			<td><?php echo $value['author']; ?></td>
			<td><?php echo $value['kind']; ?></td>
			<td><?php echo nl2br($value['content']); ?></td>
		</tr>
		<?php endforeach;?>

	</table>
	<p>
		<!-- 显示分页 -->
		<?php $page->show();?>
	</p>
</body>
</html>
