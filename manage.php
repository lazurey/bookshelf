<?php
include 'head.php';
$uid = 1;
$books = getUserBookshelf($uid);
$html = "<ul class='manage-books'>";
while ($book = mysql_fetch_array($books)) {
	$html .= "<li><input type='checkbox' value='" . $book['bid'] . "'><a href='http://book.douban.com/subject/" . $book['dbid'] . "/'>" . $book['title'] . "</a></li>";
}

?>
<h1>我的书架</h1>
<section class="book-list">
	<?php echo $html; ?>
</section>
<section class="manage-option">
	<ul>
		<li><a href="add.php">添加一本书</a></li>
		<li><a onclick="manageBook();">管理选一本书</a></li>
		<li><a onclick="deleteBooks();">删除选中的书</a></li>
		<li>
			<p>Tips:<br> 使用Tab和Space来选择你要选的书</p>
		</li>
	</ul>
</section>
<?php 
include 'foot.php';
?>