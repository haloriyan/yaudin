<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Yaudin</title>
	<link href="fw/build/fw.css" rel="stylesheet">
	<link href="fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="fw/build/material-icons.css" rel="stylesheet">
	<link href="inc/css/style.index.css" rel="stylesheet">
	<script src="inc/js/jquery-3.1.1.js"></script>
	<script src="inc/js/script.index.js"></script>
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
		<img src="user/ryn.jpg">
		<h4>haloriyan</h4>
	</div>
</div>

<div class="container">
	<div class="pos">
		<div class="atasPos">
			<img src="user/ryn.jpg">
			<h4>haloriyan</h4>
		</div>
		<div class="konten">
			<img src="upload/hello world.jpg">
			<div>
				<div class="wrap">
					<b>haloriyan</b> Lorem ipsum dolor sit amet
				</div>
			</div>
		</div>
		<div class="react">
			<button id="like"><i class="fa fa-heart-o"></i></button>
			<button id="comment"><i class="fa fa-comment-o"></i></button>
		</div>
	</div>
	<div class="pos">
		<div class="atasPos">
			<img src="user/ryn.jpg">
			<h4>haloriyan</h4>
		</div>
		<div class="konten">
			<img src="upload/hai.jpg">
			<div>
				<div class="wrap">
					<b>haloriyan</b> Lorem ipsum dolor sit amet
				</div>
			</div>
		</div>
		<div class="react">
			<button id="like"><i class="fa fa-heart-o"></i></button>
			<button id="comment"><i class="fa fa-comment-o"></i></button>
		</div>
	</div>
	<div class="pos">
		<div class="atasPos">
			<img src="user/ryn.jpg">
			<h4>haloriyan</h4>
		</div>
		<div class="konten">
			<img src="upload/hello again.jpg">
			<div>
				<div class="wrap">
					<b>haloriyan</b> Lorem ipsum dolor sit amet
				</div>
			</div>
		</div>
		<div class="react">
			<button id="like"><i class="fa fa-heart-o"></i></button>
			<button id="comment"><i class="fa fa-comment-o"></i></button>
		</div>
	</div>
</div>

<div class="kanan">
	<div class="bagian" id="profil">
		<img src="user/ryn.jpg">
		<h4>Riyan Satria</h4>
	</div>
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