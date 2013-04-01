<?php
include 'head.php';
$uid = 1;
$books = getUserBookshelf($uid);
$total = mysql_num_rows($books);
$html = "<h5>共" . $total . "本...</h5><ul class='books'>";
while ($book = mysql_fetch_array($books)) {
	if (strlen($book['dbid']) > 3) {
		$html .= "<li><a href='http://book.douban.com/subject/" . $book['dbid'] . "/'>" . $book['title'] . "</a></li>";	
	} else {
		$html .= "<li>" . $book['title'] . "</li>";
	}
	
}

?>
<h1>我的书架</h1>
<?php echo $html; ?>

<?php 
include 'foot.php';
?>