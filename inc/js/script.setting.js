function munculPopup(selector) {
	$(function() {
		$(".bg,"+selector).fadeIn(300);
		$(selector+" .popup").fadeIn(300).css({"top":"0px"});
	});
}
function hilangPopup(selector) {
	$(function() {
		$(".bg,"+selector).fadeOut(300);
		$(selector+" .popup").fadeOut(300).css({"top":"-150%"});
	});
}
$(function() {
	$("#saveUmum").click(function() {
		var nama = $("#namaSet").val();
		var email = $("#mailSet").val();
		var bio = $("#bioSet").val();
		var umum = 'nama='+nama+'&email='+email+'&bio='+bio+'&tipe=umum';
		$.ajax({
			type: "POST",
			url: "aksi/saveSetting.php",
			data: umum,
			success: function() {
				munculPopup("#notif");
				setTimeout(function() {
					hilangPopup("#notif");
				}, 1500);
			}
		});
		return false;
	});
});
$(document).keydown(function(e) {
	if(e.which == 27) {
		$(".bg,.popupWrapper").fadeOut(290);
		$(".popup").css({"top":"-150%"}).fadeOut(200);
	}
});