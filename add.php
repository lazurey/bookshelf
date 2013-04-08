<?php
include 'head.php';
if (isset($_POST['ways'])) {
	$way = trim($_POST['ways']);
	$value = "";
	if ($way == 'douban') {
		$value = trim($_POST['db_link']);
	} else if ($way == 'isbn') {
		$value = trim($_POST['isbn']);
	} else if ($way == 'title') {
		$value = trim($_POST['title']);
	}
	if (strlen($value) > 0) {
		saveNewBook($way, $value);
		echo "<script>location.href='index.php';</script>";
	}

}

?>
<h1>添加一本书</h1>
<form action='' method='post'>
	<table id='add-book-table'>
		<tr>
			<td class='choice'>
				<input id='douban' type='radio' name='ways' value='douban'>
				<label for='douban'>豆瓣链接<sup>推荐</sup></label>
			</td>
			<td>
				<label for='douban'>
					<input type="text" placeholder='http://book.douban.com/subject/1424314/' name='db_link'>
				</label>
			</td>
		</tr>
		<tr>
			<td class='choice'>
				<input id='isbn' type='radio' name='ways' value='isbn'>
				<label for='isbn'>ISBN<sup>推荐</sup></label>
			</td>
			<td>
				<label for='isbn'>
					<input type='text' placeholder='9780451524935' name='isbn'>
				</label>
			</td>
		</tr>
		<tr>
			<td class='choice'>
				<input id='title' type='radio' name='ways' value='title'>
				<label for='title'>书名<sup>不推荐</sup></label>
			</td>
			<td>
				<label for='title'>
					<input type='text' name='title' placeholder='1984'>
				</label>
			</td>
		</tr>
	</table>
	<input type='submit' value='提交'>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="index.php">取消</a>
</form>

<?php 
include 'foot.php';
?>