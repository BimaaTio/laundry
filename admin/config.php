<?php

if($_GET['hal'] == '' ){
  include 'pages/index.php';
} else if( $_GET['hal'] == 'outlet' ) {
  include 'pages/outlet.php';
} else if( $_GET['hal'] == 'transaksi' ){
  include 'pages/transaksi.php';
}
