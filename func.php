<?php
// Functions file

// Save json to db
function importFromDouban($json_str, $uid) {
	$pages_count = 0;
	foreach ($json_str->collections as $item) {
		// print_r($book);
		$book = $item->book;
		$title = $book->title;
		$db_id = $book->id;
		$isbn = $book->isbn13;
		checkAndSaveBookByIsbn($uid, $title, $db_id, $isbn);
		echo "<a href='http://book.douban.com/subject/" . $db_id . "/'>" . $title . "  " . $isbn;		
		if (intval(trim($book->pages))) {
			$pages_count += intval(trim($book->pages));
		}
		echo "<br>";
	}
	return $pages_count;
}

function checkAndSaveBookByIsbn ($uid, $title, $db_id, $isbn) {
	$checkSql = "SELECT * FROM book WHERE isbn = '" . $isbn . "'";
	$result = mysql_query($checkSql);
	$date = date("Y-m-d");
	if (mysql_num_rows($result) > 0) {
		$this_book = mysql_fetch_array($result);
		$checkRelSql = "SELECT * FROM relate WHERE uid = " . $uid . " AND $bid = " . $this_book['bid'];
		$relResult = mysql_query($checkRelSql);
		if (mysql_num_rows($relResult) > 0) {
			return false;
		} else {
			$addRelSql = "INSERT INTO relate (rid, uid, bid, buy_date, status, remark) VALUES ";
			$addRelSql .= "('', " . $uid . ", " . $this_book['bid'] . ", " . $date . ", 1, '')";
			mysql_query($addRelSql);
		}
	} else {
		$addNewBookSql = "INSERT INTO book (bid, title, status, isbn, dbid, remark) VALUES ";
		$addNewBookSql .= "('', '" . $title . "', 1, '" . $isbn . "', '" . $db_id . "', '')";
		mysql_query($addNewBookSql);
		$bid = mysql_insert_id();
		$addRelSql = "INSERT INTO relate (rid, uid, bid, buy_date, status, remark) VALUES ";
		$addRelSql .= "('', " . $uid . ", " . $bid . ", " . $date . ", 1, '')";
		mysql_query($addRelSql);
	}
}
/*
Json structure returned from douban.com
stdClass Object ( 
	[status] => read 
	[comment] => 消磨时间吧，不算好看。700本mark。 
	[updated] => 2013-03-18 20:56:58 
	[book] => stdClass Object ( 
		[publisher] => 生活·读书·新知三联书店 
		[subtitle] => 
		[isbn10] => 710803543X 
		[isbn13] => 9787108035431 
		[title] => 台湾味道 
		[url] => http://api.douban.com/v2/book/5914556 
		[origin_title] => 
		[image] => http://img3.douban.com/mpic/s4629138.jpg 
		[alt_title] => 
		[binding] => 平装 
		[rating] => stdClass Object ( 
			[max] => 10 
			[numRaters] => 897 
			[average] => 7.6 
			[min] => 0 ) 
		[author_intro] => 焦桐 
		[pages] => 232 
		[price] => 32.00元 
		[author] => Array ( [0] => 焦桐 ) 
		[translator] => Array ( ) 
		[images] => stdClass Object ( 
			[small] => http://img3.douban.com/spic/s4629138.jpg 
			[large] => http://img3.douban.com/lpic/s4629138.jpg 
			[medium] => http://img3.douban.com/mpic/s4629138.jpg ) 
		[alt] => http://book.douban.com/subject/5914556/ 
		[pubdate] => 2011-1 
		[id] => 5914556 
		[tags] => Array ( 
			[0] => stdClass Object ( 
				[count] => 1000 
				[name] => 台湾 
				[title] => 台湾 ) 
			[1] => stdClass Object ( 
				[count] => 915 
				[name] => 美食 
				[title] => 美食 ) 
		[user_id] => 1779594 
		[book_id] => 5914556 
		[tags] => Array ( [0] => 2013 ) 
		[rating] => stdClass Object ( 
			[max] => 5 
			[value] => 3 
			[min] => 0 ) 
			[id] => 656145753 ) 

*/

function getDoubanJson($db_user, $status, $start, $count) {
	$url = "https://api.douban.com/v2/book/user/" . $db_user 
		. "/collections?status=" . $status . "&count=" . $count . "&start=" . $start;
	$ch = curl_init($url);
	$options = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array('Content-type: application/json')
	);
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);
	$json = json_decode($result);
	return $json;
}

function getUserBookshelf($uid) {
	$sql = "SELECT b.*, r.* FROM book b, relate r WHERE r.uid = " . $uid . " and r.bid = b.bid ORDER BY b.bid DESC";
	$result = mysql_query($sql);
	if (mysql_num_rows($result) > 0) {
		return $result;
	} else {
		return false;
	}
}

function deleteUserBookRelate($book_str) {
	$uid = 1;
	$delSql = "DELETE from relate WHERE uid = " . $uid . " AND bid in (" . $book_str . ")";
	mysql_query($delSql);
	return true;
}

?>
