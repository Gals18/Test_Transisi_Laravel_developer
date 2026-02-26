<?php

function tampilkanTabelBiner($totalBaris = 8, $totalKolom = 8, $pola = [])
{
   $jumlahPola = count($pola);
   $angka = 1;

   echo "<table border='1' cellpadding='10' style='border-collapse: collapse; text-align: center;'>";

   for ($baris = 1; $baris <= $totalBaris; $baris++) {
      echo "<tr>";
      for ($kolom = 1; $kolom <= $totalKolom; $kolom++) {

         // Ambil status biner dari pola
         $status = $pola[($angka - 1) % $jumlahPola];

         // Tentukan warna berdasarkan status 1 atau 0
         $warnaBg = ($status == 1) ? "black" : "white";
         $warnaTeks = ($status == 1) ? "white" : "black";

         echo "<td style='background-color: $warnaBg; color: $warnaTeks; width: 40px;'>$angka</td>";

         $angka++;
      }
      echo "</tr>";
   }

   echo "</table>";
}
$input = [1, 1, 0, 0, 1, 0, 1, 0, 0, 1, 1, 0];
tampilkanTabelBiner(8, 8, $input);
