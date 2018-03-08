<?php
include '../../ig.php';

$sesi = $ig->cekSesi();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Cari | Yaudin</title>
	<link href="../fw/build/fw.css" rel="stylesheet">
	<link href="../fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="../inc/css/mobile/style.cari.css" rel="stylesheet">
	<script src="../inc/js/jquery-3.1.1.js"></script>
</head>
<body>

<div class="atas">
	<div id="tblBack"><i class="fa fa-arrow-left"></i></div>
	<div class="pencarian">
		<form>
			<input type="text" class="box" id="key" placeholder="cari sesuatu..." oninput="pencarian()">
		</form>
	</div>
</div>

<div class="controls">
	<a href="../"><li><i class="fa fa-home"></i></li></a>
	<a href="./mobile/cari" id="active"><li><i class="fa fa-search"></i></li></a>
	<a href="./mobile/compose"><li><i class="fa fa-plus"></i></li></a>
	<a href="#"><li><i class="fa fa-heart-o"></i></li></a>
	<a href="../my/<?php echo $sesi; ?>"><li><i class="fa fa-user-o"></i></li></a>
</div>

<div class="serp">
</div>

<script>
	function pencarian() {
		$(function() {
			var key = $("#key").val();
			var cari = "namakuki=keycari&isikuki="+key+'&durasi=300';
			if(key == "") {
				$(".serp").fadeOut(300);
			}else {
				$(".serp").html("<i class='fa fa-spinner'></i>").css({"text-align":"center"});
				$(".serp").fadeIn(300);
				$.ajax({
					type: "POST",
					url: "../aksi/setCookie.php",
					data: cari,
					success: function() {
						$(".serp").load("../aksi/load/pencarian2.php");
					}
				})
			}
		});
	}
	$(function() {
		$("#tblBack").click(function() {
			window.history.back(-1);
		});
	})
</script>

</body>
</html>