<?php
$con = mysqli_connect("localhost", "root", "", "esetindonesia");

if ($con->connect_errno) {
  echo "err";
  exit();
}

if (isset($_POST['kirim'])) {

  $namaLengkap = trim(htmlentities($_POST['namaLengkap']));
  $perusahaan = trim(htmlentities($_POST['perusahaan']));
  $email = trim(htmlentities($_POST['email']));
  $wa = trim(htmlentities($_POST['wa']));
  $keterangan = trim(htmlentities($_POST['keterangan']));
  $jumlahpc = trim(htmlentities($_POST['jumlahPc']));

  $data = mysqli_query($con, "INSERT INTO penawaran (namaLengkap,perusahaan,email,wa,jumlahPc,keterangan) VALUES ('$namaLengkap','$perusahaan','$email','$wa','$jumlahPc','$keterangan')");

  header('location:/success.html');
}
