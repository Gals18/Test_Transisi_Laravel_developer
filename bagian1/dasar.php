<?php
//buat sebuah array baru untuk menyimpan data nilai.
 $nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";

//mengubah string menjadi runtutan array string
 $array_nilai = explode(" ", $nilai);

 //mengubah array string menjadi int 
$array_int = array_map('intval', $array_nilai);

//mencari nilai rata rata
$rataNilai = array_sum($array_int)/count($array_int);
echo "Nilai rata - rata: ". $rataNilai."<br>";

// fungsi rsort digunkan untuk mengurutkan dari terbesar ke terkecil
rsort($array_int);

//mengambil 7 angka, dari urutan pertama sampe urutan ke 7 
$tujuh_tertinggi = array_slice($array_int, 0, 7);
echo "7 Nilai Tertinggi: " . implode(", ", $tujuh_tertinggi)."<br>";

//fungsi sort untuk mengurutkan dari terkecil ke terbesar
sort($array_int);

//mengambil 7 nilai terendah
$tujuh_terendah = array_slice($array_int, 0, 7);
echo "7 Nilai terendah : ". implode(',',$tujuh_terendah)."<br>";



?>