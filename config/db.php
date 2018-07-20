<?php

session_start();
$con = new mysqli("localhost","root","i1k2i3","puskesmas");

class user {
	public $koneksi;

	function __construct($con){
		$this->koneksi = $con;
	}

	function login($username, $pass){
		$sql = "select username,hakakses from user where username='$username' and pass=PASSWORD('$pass') limit 1";
		$select = $this->koneksi->query($sql);
		if(!$select){
			die('Kesalahan Database'.$this->koneksi->error);
		}
		if($select->num_rows == 1){
			$row = $select->fetch_assoc();
			$_SESSION['id'] = $row['username'];
			$_SESSION['hakakses'] = $row['hakakses'];
			if ($row['hakakses']=='admin') {
				return "admin";
			}
			else if ($row['hakakses']=='user') {
				return "user";
			}
		}else{
			return "gagal";
		}
	}

	function logout(){
		session_destroy();
		header("location:../../");
	}
}

class data {
	public $koneksi;

	function __construct($con){
		$this->koneksi = $con;
	}

	function add_sup($kodesup,$namasup,$alamat,$telp,$kontak,$ket)
	{
		$this->koneksi->query("INSERT INTO supplier(kodesup,namasup,alamat,telp,kontak,ket) VALUES ('$kodesup','$namasup','$alamat','$telp','$kontak','$ket')") or die(mysqli_error($this->koneksi));
	}

	function edt_sup($kodesup,$namasup,$alamat,$telp,$kontak,$ket){
		$this->koneksi->query("UPDATE supplier SET namasup='$namasup',alamat='$alamat',telp='$telp',kontak='$kontak',ket='$ket' WHERE kodesup='$kodesup'") or die(mysqli_error($this->koneksi));
	}

	function del_sup($kodesup){
		$this->koneksi->query("DELETE FROM supplier WHERE kodesup='$kodesup'") or die(mysqli_error($this->koneksi));
	}

	function terima($sup,$bulan){
		$select = $this->koneksi->query("SELECT brgmasuk.tglmasuk, barang.namabrg, brgmasuk.jumlah, satuan.namasatuan, supplier.namasup FROM brgmasuk INNER JOIN barang ON brgmasuk.kodebrg = barang.kodebrg INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan INNER JOIN supplier ON barang.kodesup = supplier.kodesup WHERE supplier.kodesup='$sup' AND month(brgmasuk.tglmasuk)='$bulan' AND brgmasuk.jumlah!='0'");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function masuk($bulan){
		$select = $this->koneksi->query("SELECT barang.kodebrg, brgmasuk.tglmasuk, barang.namabrg, brgmasuk.jumlah, satuan.namasatuan, barang.harga, (barang.harga*brgmasuk.jumlah) AS subtotal, supplier.namasup FROM brgmasuk INNER JOIN barang ON brgmasuk.kodebrg = barang.kodebrg INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan INNER JOIN supplier ON barang.kodesup = supplier.kodesup WHERE month(brgmasuk.tglmasuk)='$bulan' ORDER BY barang.kodebrg ASC");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function keluar($bulan){
		$select = $this->koneksi->query("SELECT barang.kodebrg, brgkeluar.tglkeluar, barang.namabrg, brgkeluar.jumlah, satuan.namasatuan, barang.harga, (brgkeluar.jumlah*barang.harga) AS subtotal, brgmasuk.kodemasuk FROM brgkeluar INNER JOIN brgmasuk ON brgkeluar.kodemasuk = brgmasuk.kodemasuk INNER JOIN barang ON brgmasuk.kodebrg = barang.kodebrg INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan WHERE month(brgkeluar.tglkeluar)='$bulan' AND brgkeluar.ket LIKE '%digunakan%' ORDER BY brgmasuk.kodemasuk ASC");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function showsup(){
		$select = $this->koneksi->query("SELECT kodesup, namasup FROM supplier");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function showjen(){
		$select = $this->koneksi->query("SELECT kodejen, namajen FROM jenisbarang");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function showsat(){
		$select = $this->koneksi->query("SELECT kodesatuan, namasatuan FROM satuan");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function showbrg(){
		$select = $this->koneksi->query("SELECT barang.kodebrg,barang.namabrg,satuan.namasatuan,barang.jumlah FROM barang INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan;");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function showbrgmasuk(){
		$select = $this->koneksi->query("SELECT brgmasuk.kodemasuk,brgmasuk.tglmasuk,barang.namabrg,brgmasuk.jumlah,satuan.namasatuan FROM brgmasuk INNER JOIN barang ON brgmasuk.kodebrg = barang.kodebrg INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan;");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function showupdatebrg(){
		$select = $this->koneksi->query("SELECT barang.kodebrg, barang.namabrg, jenisbarang.namajen, barang.jumlah, satuan.namasatuan, barang.tglmsk from barang INNER JOIN jenisbarang ON barang.kodejen = jenisbarang.kodejen INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan");
		while ($fetch = $select->fetch_assoc()) {
			$data[] = $fetch;
		}
		return $data;
	}

	function add_brg($kodebrg,$namabrg,$kodejen,$jumlah,$harga,$kodesatuan,$tglmsk,$kodesup,$foto){
		$nama_foto=$foto['name'];
		$lokasi_foto=$foto['tmp_name'];

		if (empty($nama_foto)) {
			$nama_foto="default.png";
		}

		if (!empty($lokasi_foto)) {
			move_uploaded_file($lokasi_foto, "../../assets/images/barang/$nama_foto");
		}

		$this->koneksi->query("INSERT INTO barang(kodebrg,namabrg,kodejen,jumlah,harga,kodesatuan,tglmsk,kodesup,foto) VALUES ('$kodebrg','$namabrg','$kodejen','$jumlah','$harga','$kodesatuan','$tglmsk','$kodesup','$nama_foto')") or die(mysqli_error($this->koneksi));
	}

	function select_brg($kodebrg){
		$select = $this->koneksi->query("SELECT * FROM barang WHERE kodebrg='$kodebrg'");
		$fetch = $select->fetch_assoc();
        return $fetch;
	}

	function edt_brg($kodebrg,$namabrg,$kodejen,$jumlah,$harga,$kodesatuan,$tglmsk,$kodesup){
		/*
		error_reporting(0); 
        $nama_foto=$foto['name'];
        $lokasi_foto=$foto['tmp_name'];
        if (empty($nama_foto)) {
			$nama_foto="default.png";
		if (!empty($lokasi_foto)) {
			$data_lama = $this->select_brg($kodebrg);
            $foto_lama = $data_lama['foto'];
            if (file_exists("../../assets/images/barang/$foto_lama")) {
            	unlink("../../assets/images/barang/$foto_lama");
            }
            move_uploaded_file($lokasi_foto, "../../assets/images/barang/$nama_foto");
            $this->koneksi->query("UPDATE barang SET namabrg='$namabrg',kodejen='$kodejen',jumlah='$jumlah',harga='$harga',kodesatuan='$kodesatuan',tglmsk='$tglmsk',kodesup='$kodesup',foto='$nama_foto' WHERE kodebrg='$kodebrg'") or die(mysqli_error($this->koneksi));
		} else {
			$this->koneksi->query("UPDATE barang SET namabrg='$namabrg',kodejen='$kodejen',jumlah='$jumlah',harga='$harga',kodesatuan='$kodesatuan',tglmsk='$tglmsk',kodesup='$kodesup',foto='$nama_foto' WHERE kodebrg='$kodebrg'") or die(mysqli_error($this->koneksi));
		}
		*/
		$this->koneksi->query("UPDATE barang SET namabrg='$namabrg',kodejen='$kodejen',jumlah='$jumlah',harga='$harga',kodesatuan='$kodesatuan',tglmsk='$tglmsk',kodesup='$kodesup' WHERE kodebrg='$kodebrg'") or die(mysqli_error($this->koneksi));
	}

	function del_brg($kodebrg){
		$this->koneksi->query("DELETE FROM barang WHERE kodebrg='$kodebrg'") or die(mysqli_error($this->koneksi));
	}

	function add_sat($kodesatuan,$namasatuan)
	{
		$this->koneksi->query("INSERT INTO satuan(kodesatuan,namasatuan) VALUES ('$kodesatuan','$namasatuan')") or die(mysqli_error($this->koneksi));
	}

	function edt_sat($kodesatuan,$namasatuan)
	{
		$this->koneksi->query("UPDATE satuan set namasatuan='$namasatuan' WHERE kodesatuan='$kodesatuan'") or die(mysqli_error($this->koneksi));
	}

	function del_sat($kodesatuan)
	{
		$this->koneksi->query("DELETE FROM satuan WHERE kodesatuan='$kodesatuan'") or die(mysqli_error($this->koneksi));
	}

	function add_jen($kodejen,$namajen)
	{
		$this->koneksi->query("INSERT INTO jenisbarang(kodejen,namajen) VALUES ('$kodejen','$namajen')") or die(mysqli_error($this->koneksi));
	}

	function edt_jen($kodejen,$namajen)
	{
		$this->koneksi->query("UPDATE jenisbarang set namajen='$namajen' WHERE kodejen='$kodejen'") or die(mysqli_error($this->koneksi));
	}

	function del_jen($kodejen)
	{
		$this->koneksi->query("DELETE FROM jenisbarang WHERE kodejen='$kodejen'") or die(mysqli_error($this->koneksi));
	}

	function add_user($username,$pass,$hakakses){
		$this->koneksi->query("INSERT INTO user(username,pass,hakakses) VALUES ('$username',PASSWORD('$pass'),'$hakakses')") or die(mysqli_error($this->koneksi));
	}

	function edt_user($newuser,$username,$pass,$hakakses){
		$this->koneksi->query("UPDATE user SET username='$newuser',pass=PASSWORD('$pass'),hakakses='$hakakses' WHERE username='$username'") or die(mysqli_error($this->koneksi));
	}

	function del_user($username){
		$this->koneksi->query("DELETE FROM user WHERE username='$username'") or die(mysqli_error($this->koneksi));
	}

	function add_brgin($kodemasuk,$tglmasuk,$kodebrg,$jumlah){
		$this->koneksi->query("INSERT INTO brgmasuk(kodemasuk,tglmasuk,kodebrg,jumlah) VALUES ('$kodemasuk','$tglmasuk','$kodebrg','$jumlah')") or die(mysqli_error($this->koneksi));
		$this->koneksi->query("UPDATE barang SET jumlah=jumlah-'$jumlah' WHERE kodebrg='$kodebrg'") or die(mysqli_error($this->koneksi));
	}

	function del_brgin($kodemasuk,$kodebrg,$jumlah){
		$this->koneksi->query("UPDATE barang SET jumlah=jumlah+'$jumlah' WHERE kodebrg='$kodebrg'") or die(mysqli_error($this->koneksi));
		$this->koneksi->query("DELETE FROM brgmasuk WHERE kodemasuk='$kodemasuk'") or die(mysqli_error($this->koneksi));
	}

	function add_brgout($kodekeluar,$kodemasuk,$tglkeluar,$jumlah,$ket){
		$this->koneksi->query("INSERT INTO brgkeluar(kodekeluar,kodemasuk,tglkeluar,jumlah,ket) VALUES ('$kodekeluar','$kodemasuk','$tglkeluar','$jumlah','$ket')") or die(mysqli_error($this->koneksi));
		$this->koneksi->query("UPDATE brgmasuk SET jumlah=jumlah-'$jumlah' WHERE kodemasuk='$kodemasuk'") or die(mysqli_error($this->koneksi));
	}

	function del_brgout($kodekeluar,$kodemasuk,$jumlah){
		$this->koneksi->query("UPDATE brgmasuk SET jumlah=jumlah+'$jumlah' WHERE kodemasuk='$kodemasuk'") or die(mysqli_error($this->koneksi));
		$this->koneksi->query("DELETE FROM brgkeluar WHERE kodekeluar='$kodekeluar'") or die(mysqli_error($this->koneksi));
	}
}
$user = new user($con);
$data = new data($con);
?>