<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Selamat Datang di Yaudin</title>
	<link href="fw/build/fw.css" rel="stylesheet">
	<link href="fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="fw/build/material-icons.css" rel="stylesheet">
	<link href="inc/css/style.auth.css" rel="stylesheet">
	<script src="inc/js/jquery-3.1.1.js"></script>
	<script>
		$(function() {
			$("#tblRegist").click(function() {
				$("#bagLogin").hide();
				$("#bagRegist").fadeIn(340);
			});
			$("#tblLogin").click(function() {
				$("#bagLogin").fadeIn(400);
				$("#bagRegist").hide();
			});
			$("#register").click(function() {
				var nama = $("#namaReg").val();
				var email = $("#mailReg").val();
				var uname = $("#unameReg").val();
				var pwd = $("#pwdReg").val();
				var regist = 'nama='+nama+'&email='+email+'&username='+uname+'&password='+pwd;
				if(nama == "" || email == "" || uname == "" || pwd == "") {
					return false;
				}else {
					$.ajax({
						type: "POST",
						url: "aksi/register.php",
						data: regist,
						success: function() {
							document.location = "./";
						}
					});
				}
				return false;
			});
			$("#login").click(function() {
				var uname = $("#unameLog").val();
				var pwd = $("#pwdLog").val();
				var log = 'username='+uname+'&password='+pwd;
				if(uname == "" || pwd == "") {
					return false;
				}
				$.ajax({
					type: "POST",
					url: "aksi/login.php",
					data: log,
					success: function() {
						document.location = "./";
					}
				});
				return false;
			});
		});
	</script>
</head>
<body>

<div class="container">
	<div id="bagLogin">
		<div class="wrap">
			<h2>Masuk</h2>
			<form>
				<div class="isi">Username</div>
				<input type="text" class="box" id="unameLog">
				<div class="isi">Password</div>
				<input type="password" class="box" id="pwdLog">
				<div class="bag-tombol rata-tengah">
					<button class="tbl biru" id="login">LOGIN</button><br />
					<div style="margin-top: 9px;">
						belum punya akun? <a href="#" id="tblRegist">mendaftar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="bagRegist" style="display: none;">
		<div class="wrap">
			<h2>Mendaftar</h2>
			<form>
				<div class="isi">Nama</div>
				<input type="text" class="box" id="namaReg">
				<div class="isi">Email</div>
				<input type="email" class="box" id="mailReg">
				<div class="isi">Username</div>
				<input type="text" class="box" id="unameReg">
				<div class="isi">Password</div>
				<input type="password" class="box" id="pwdReg">
				<div class="bag-tombol rata-tengah">
					<button class="tbl biru" id="register">MENDAFTAR</button>
					<div style="margin-top: 9px;">
						sudah punya akun? <a href="#" id="tblLogin">masuk</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="footer">
		<div class="wrap">
			<i class="fa fa-copyright"></i> 2018 Yaudin<br />
		</div>
	</div>
</div>

</body>
</html>