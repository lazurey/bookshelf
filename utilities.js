function manageBook() {
	alert(2);
}

function deleteBooks() {
	var books = $('input[type=checkbox]:checked');
	var book_str = "";
	for (var i = 0; i < books.length; i++) {
		book_str += books.eq(i).val() + ",";
	}
	book_str = book_str.substring(0, book_str.length - 1);
	$.ajax({
		url: "delRel.php",
		data: "del_book_str=" + book_str,
		type: "POST"
	}).done(function(data) {
		window.location.reload();
	});
	// deleteUserBookRelate
}