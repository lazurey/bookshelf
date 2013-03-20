<?php
include 'head.php';
if (isset($_POST['del_book_str'])) {
	$del_book_str = trim($_POST['del_book_str']);
	deleteUserBookRelate($del_book_str);
}

 ?>