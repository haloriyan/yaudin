<?php

class ig {
	public function __construct() {
		$this->koneksi();
	}
	public function koneksi() {
		$this->konek = new mysqli("localhost", "root", "", "ig");
		return $this->konek;
	}
	public function cekSesi() {
		session_start();
		$sesi = $_SESSION['sesiig'];
		if(empty($sesi)) {
			header("location: ./auth");
		}
		return $sesi;
	}
	public function getConfig($struktur) {
		$q = mysqli_query($this->konek, "SELECT $struktur FROM konfigurasi");
		$r = mysqli_fetch_array($q);
		return $r[$struktur];
	}
	public function login($u, $p) {
		$q = mysqli_query($this->konek, "SELECT username,password FROM user WHERE username = '$u' AND password = '$p'");
		if(mysqli_num_rows($q) == 0) {
			setcookie('kukilogin', 'Username / Password Salah!', time() + 30);
		}else {
			session_start();
			$_SESSION['sesiig']=$u;
		}
	}
	public function register($a, $b, $c, $d, $e, $f, $g, $h, $i) {
		$q = mysqli_query($this->konek, "INSERT INTO user VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i', '', '')");
		session_start();
		$_SESSION['sesiig']=$d;
		return $q;
	}
	public function getUser($u, $struktur) {
		$q = mysqli_query($this->konek, "SELECT $struktur FROM user WHERE username = '$u'");
		$r = mysqli_fetch_array($q);
		return $r[$struktur];
	}
	public function cari($key) {
		$q = mysqli_query($this->konek, "SELECT * FROM user WHERE nama LIKE '%$key%' OR username LIKE '%$key%' LIMIT 10");
		if(mysqli_num_rows($q) == 0) {
			echo "<h2>Tidak ditemukan hasil :(</h2>";
		}else {
			while($r = mysqli_fetch_array($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function totPos($u) {
		$q = mysqli_query($this->konek, "SELECT * FROM pos WHERE username = '$u'");
		$t = mysqli_num_rows($q);
		return $t;
	}
	public function countArray($arai, $limit)  {
		if($arai == "") {
			return 0;
		}else {
			$pecah = explode($limit, $arai);
			return count($pecah);
		}
	}
	public function getAllPos($u, $limit) {
		$q = mysqli_query($this->konek, "SELECT * FROM pos WHERE username = '$u' ORDER BY dikirim DESC LIMIT $limit");
		if(mysqli_num_rows($q) == 0) {
			echo "<h1 class='rata-tengah'>Belum ada kiriman</h1>";
			echo "<style>#loadMorePos { display: none; }</style>";
		}else {
			while($r = mysqli_fetch_array($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function getPos($id, $struktur) {
		$q = mysqli_query($this->konek, "SELECT $struktur FROM pos WHERE idpos = '$id'");
		if(mysqli_num_rows($q) == 0) {
			echo "error";
			exit();
		}
		$r = mysqli_fetch_array($q);
		return $r[$struktur];
	}
	public function follow($saya, $target) {
		$r = mysqli_fetch_array(mysqli_query($this->konek, "SELECT * FROM user WHERE username = '$target'"));
		$follersTarget = $r['followers'];
		if($follersTarget != "") {
			$follBaru = $follersTarget.",".$saya;
		}else {
			$follBaru = $saya;
		}
		$ubah = mysqli_query($this->konek, "UPDATE user SET followers = '$follBaru' WHERE username = '$target'");

		// bagian saya
		$r2 = mysqli_fetch_array(mysqli_query($this->konek, "SELECT * FROM user WHERE username = '$saya'"));
		$follwingSaya = $r2['following'];
		if($follwingSaya != "") {
			$folwingBaru = $follwingSaya.",".$target;
		}else {
			$folwingBaru = $target;
		}
		$ubah2 = mysqli_query($this->konek, "UPDATE user SET following = '$folwingBaru' WHERE username = '$saya'");

		$id = rand(1,999999999);
		$q = mysqli_query($this->konek, "INSERT INTO following VALUES('$id', '$saya', '$target')");
	}
	public function unfoll($saya, $target) {
		$r = mysqli_fetch_array(mysqli_query($this->konek, "SELECT * FROM user WHERE username = '$target'"));
		$follersTarget = $r['followers'];
		$p = explode(",", $follersTarget);

		foreach ($p as $key => $value) {
			if($saya == $p[$key]) {
				unset($p[$key]);
			}
			$baru = implode(",", $p);
		}
		$ubah = mysqli_query($this->konek, "UPDATE user SET followers = '$baru' WHERE username = '$target'");

		// bagian saya
		$r2 = mysqli_fetch_array(mysqli_query($this->konek, "SELECT * FROM user WHERE username = '$saya'"));
		$follSaya = $r2['following'];
		$p2 = explode(",", $follSaya);

		foreach ($p2 as $key => $value) {
			if($target == $p2[$key]) {
				unset($p2[$key]);
			}
			$baru2 = implode(",", $p2);
		}
		$ubah2 = mysqli_query($this->konek, "UPDATE user SET following = '$baru2' WHERE username = '$saya'");

		$del = mysqli_query($this->konek, "DELETE FROM following WHERE user = '$saya' AND follow = '$target'");
	}
	public function like($id, $user) {
		$r = mysqli_fetch_array(mysqli_query($this->konek, "SELECT * FROM pos WHERE idpos = '$id'"));
		$likers = $r['likers'];
		if($likers != "") {
			$likerBaru = $likers.",".$user;
		}else {
			$likerBaru = $user;
		}
		$ubah = mysqli_query($this->konek, "UPDATE pos SET likers = '$likerBaru' WHERE idpos = '$id'");
	}
	public function unlike($id, $user) {
		$r = mysqli_fetch_array(mysqli_query($this->konek, "SELECT * FROM pos WHERE idpos = '$id'"));
		$likers = $r['likers'];

		$like = explode(",", $likers);

		foreach ($like as $key => $value) {
			if($user == $like[$key]) {
				unset($like[$key]);
			}
			$baru = implode(",", $like);
		}
		$ubah = mysqli_query($this->konek, "UPDATE pos SET likers = '$baru' WHERE idpos = '$id'");
	}
	public function totLike($id) {
		$q = mysqli_query($this->konek, "SELECT foto FROM pos WHERE idpos = '$id'");
		$t = mysqli_num_rows($q);
		return $t;
	}
	public function ubahUser($sesi, $struktur, $value) {
		$q = mysqli_query($this->konek, "UPDATE user SET $struktur = '$value' WHERE username = '$sesi'");
		return $q;
	}
	public function beranda($sesi, $limit) {
		$q = mysqli_query($this->konek, "SELECT * FROM pos INNER JOIN following WHERE user = '$sesi' AND username = follow ORDER BY dikirim DESC LIMIT $limit");
		while($r = mysqli_fetch_array($q)) {
			$hasil[] = $r;
		}
		return $hasil;
	}
	public function getKomen($id, $limit) {
		$q = mysqli_query($this->konek, "SELECT * FROM komentar WHERE idpos = '$id' ORDER BY dikirim DESC LIMIT $limit");
		if(mysqli_num_rows($q) == 0) {
			echo "<h3>Belum ada komentar</h3>";
		}else {
			while($r = mysqli_fetch_array($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function komentari($a, $b, $c, $d, $e) {
		$q = mysqli_query($this->konek, "INSERT INTO komentar VALUES('$a','$b','$c','$d','$e')");
		return $q;
	}
	public function hashtag($tag) {
		$q = mysqli_query($this->konek, "SELECT * FROM pos WHERE konten LIKE '%$tag%' ORDER BY dikirim DESC LIMIT 100");
		if(mysqli_num_rows($q) == 0) {
			echo "<h2>Belum ada kiriman</h2>";
		}else {
			while($r = mysqli_fetch_array($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function totKirimHashtag($tag) {
		$q = mysqli_query($this->konek, "SELECT idpos FROM pos WHERE konten LIKE '%$tag%'");
		$t = mysqli_num_rows($q);
		return $t;
	}
	public function post($a, $b, $c, $d, $e, $f) {
		$q = mysqli_query($this->konek, "INSERT INTO pos VALUES('$a','$b','$c','$d','$e','$f')");
		return $q;
	}
}

$ig = new ig();