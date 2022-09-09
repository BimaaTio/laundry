<?php

// Koneksi 
$host = 'localhost';
$name = 'root';
$pass = '';
$dbname = 'db_laundry';  // Iki manut database e nggon mu

$conn = mysqli_connect($host, $name, $pass, $dbname);
if(!$conn){
  echo 'Koneksi Gagal';
}
// ===========================================

// Function Query 
function query($query) {
  global $conn;

  $result = mysqli_query($conn, $query);
  $rows = [];

  while($row = mysqli_fetch_assoc($result)){
      $rows[] = $row;
  }

  return $rows;
}
// ============================================

// Register
function register($data) {
  global $conn;
  // Ambil data dari form POST register[]
  $nama = ucwords(htmlspecialchars(stripslashes($_POST['name'])));
  $uname = ucwords(htmlspecialchars(stripslashes($_POST['uname'])));
  $pass1 = mysqli_real_escape_string($conn, $data['pass1']);
  $pass2 = mysqli_real_escape_string($conn, $data['pass2']);
  $role = 'A';
  

  // Cek Username sudah ad / belum
  $cek_uname = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$uname'");
  if( mysqli_fetch_assoc($cek_uname)  ) {
      echo "
          <script>
          alert('Username Sudah ada!, Silahkan Gunakan Username lain')
          </script>";
      return false;
  }

  // Konfirmasi Password cocok / tidak cocok
  if( $pass1 !== $pass2 ) {
      echo "<script>
              alert('Konfirmasi Password tidak sesuai')
            </script>";
      return false;
  }

  // Proses encrypt password / pengacakan password
  $password = password_hash($pass1, PASSWORD_BCRYPT);

  // Proses insert data ke database
  mysqli_query($conn, "INSERT INTO tb_user VALUES (NULL, '$nama', '$uname' , '$password', '$role') ");

  return mysqli_affected_rows($conn); 
}
// end Register