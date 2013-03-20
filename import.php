<?php
include 'head.php';

function import() {
	$db_user = "lazurey";
	$uid = 1;
	$status = "read"; // wish: 想读; reading: 在读; read: 读过
	$start = 0;
	$count = 100; // 每次获取100本
	$res = getDoubanJson($db_user, $status, $start, $count);
	$pages_count = importFromDouban($res, $uid);
	$total = $res->total;
	while ($total > $start + $count) {
		$start += $count;
		$res = getDoubanJson($db_user, $status, $start, $count);
		$pages_count += importFromDouban($res, $uid);
	}
	echo "本次完毕, 请返回首页查看!";
}

// echo "total=" . $total . "&start=" . $start . "&count=" . $count;
// echo "<br>你一共买了" . $pages_count . "页书了";
// foreach ($res->collections as $book) {
// 	print_r($book);
// }
?>

<form action='' method='post'>
	<input type="text" name="db_id" id="douban">
	<a onclick="check();">提交</a>
	<div style="display:none">
		<input type="submit" value="提交">
	</div>
</form>

<script type="text/javascript">
function check() {
	var 
}
</script>