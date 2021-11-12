<?php
date_default_timezone_set("Asia/Jakarta");
$con = mysqli_connect("localhost", "akum6355_eset", "MZ4MfCiCBU3D5MA", "akum6355_esetindonesia");

if ($con->connect_errno) {
  echo "err";
  exit();
}



if (isset($_POST['kirim'])) {

  function sendMessage($telegram_id, $nama, $perusahaan, $email, $wa, $jumlahpc, $keterangan, $secret_token)
  {
    $url =  "https://api.telegram.org/bot" . $secret_token . "/sendMessage?chat_id=" . $telegram_id . "&parse_mode=markdown";
    $text = "Tanggal Masuk: *" . date('d/m/Y') . "* \nJam: *" . date('h:i') . "WIB* \nNama Lengkap: *" . $nama . "* \nPerusahaan/Instansi: *" . $perusahaan . "* \nEmail: *" . $email . "* \nTelp/WhatsApp: *" . $wa . "* \nJumlah PC/Laptop: *" . $jumlahpc . "* \nKeterangan Lain: _" . $keterangan . "_";

    // $url = $url . "&text=" . urlencode("Nama Lengkap: " . $nama . "\n Perusahaan/Instansi: " . $perusahaan . "\n Email: " . $email . "\n Telp/WhatsApp: " . $wa . "\n Jumlah PC/Laptop: " . $jumlahpc . "\n Keterangan: " . $keterangan);

    $url = $url . "&text=" . urlencode($text);
    $ch = curl_init();

    $optArray = array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
    );

    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
  }

  $namaLengkap = trim(htmlentities($_POST['namaLengkap']));
  $perusahaan = trim(htmlentities($_POST['perusahaan']));
  $email = trim(htmlentities($_POST['email']));
  $wa = trim(htmlentities($_POST['wa']));
  $keterangan = trim(htmlentities($_POST['keterangan']));
  $jumlahpc = trim(htmlentities($_POST['jumlahpc']));


  $data = mysqli_query($con, "INSERT INTO penawaran (namaLengkap,perusahaan,email,wa,jumlahPc,keterangan) VALUES ('$namaLengkap','$perusahaan','$email','$wa','$jumlahpc','$keterangan')");

  $secret_token = "2143650264:AAE4NWW2kV-sUQpn9MtCRKe7xTFVeP0B18U";
  $telegram_id = ["470830212", "934672013"];

  foreach ($telegram_id as $id_tele) {
    sendMessage($id_tele, $namaLengkap, $perusahaan, $email, $wa, $jumlahpc, $keterangan, $secret_token);
  }
  header('location:/success.html');
}
