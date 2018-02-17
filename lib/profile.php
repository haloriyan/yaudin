<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Riyan Satria</title>
	<link href="../fw/build/fw.css" rel="stylesheet">
	<link href="../fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="../fw/build/material-icons.css" rel="stylesheet">
	<link href="../inc/css/style.profile.css" rel="stylesheet">
	<script src="../inc/js/jquery-3.1.1.js"></script>
</head>
<body>

<div class="atas">
	<h1 class="judul">Yaudin</h1>
	<div class="pencarian">
		<form>
			<input type="text" class="box" id="cari" oninput="pencarian();" placeholder="cari...">
			<button id="xCari" type="button"><i class="fa fa-close"></i></button>
		</form>
	</div>
	<nav class="menu">
		<a href="#"><li id="explore"><i class="material-icons">explore</i></li></a>
		<a href="#"><li><i class="material-icons">favorite_border</i></li></a>
		<a href="#"><li><i class="material-icons">account_circle</i></li></a>
	</nav>
</div>

<div class="hasilCari">
	<div class="hasil">
		<img src="../user/ryn.jpg">
		<h4>haloriyan</h4>
	</div>
</div>

<div class="profile">
	<div class="wrap">
		<div class="kiri">
			<img src="../user/ryn.jpg">
		</div>
		<div class="kanan">
			<h2>Riyan Satria</h2>
			<h3>@haloriyan <button class="tbl biru"><i class="fa fa-plus"></i> Ikuti</button></h3>
			<div class="detail">
				<div>
					24<br />
					kiriman
				</div>
				<div>
					350<br />
					pengikut
				</div>
				<div>
					20<br />
					diikuti
				</div>
			</div>
		</div>
	</div>
</div>

<div class="kiriman">
	<a href="#">
		<div class="pos">
			<img src="../upload/alan suryajana.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/hai.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/hello again.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/hello world.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/uye.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/mamam.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/ken.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/sss.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/zz.jpg">
		</div>
	</a>
	<a href="#">
		<div class="pos">
			<img src="../upload/mantab.jpg">
		</div>
	</a>
</div>

<script>
	function pencarian() {
		$(function() {
			var key = $("#cari").val();
			if(key == "") {
				$(".hasilCari").fadeOut(300);
			}else {
				$(".hasilCari").fadeIn(300);
			}
		});
	}
	$(function() {
		$("#xCari").click(function() {
			$("#cari").val('');
			$(".hasilCari").fadeOut(300);
		});
	})
</script>

</body>
</html>