<?php
include 'konfigurasi.php';

class ig {
	public function __construct() {
		$this->koneksi();
	}
	public function koneksi() {
		$this->konek = new mysqli($host, $user, $pass, $nama);
		return $this->konek;
	}
	public function getConfig($struktur) {
		$q = mysqli_query($this->konek, "SELECT $struktur FROM konfigurasi");
		$r = mysqli_fetch_array($q);
		return $r[$struktur];
	}
}