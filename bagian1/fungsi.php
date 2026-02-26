<?php
function hitungHurufKecil($text) {
    // fungsi untuk mencocokan semua huruf kecil dan simpan di $matches
    preg_match_all('/[a-z]/', $text, $matches);
    
    $jumlah = count($matches[0]);
    
    return "\"$text\" mengandung $jumlah buah huruf kecil"."<br>";
}

function buat_gram($string, $n){
$kata = explode(" ",$string);
$hasil = [];
$total_kata = count($kata);
for ($i = 0; $i < $total_kata; $i +=$n){
$potonganKata = array_slice($kata,$i,$n);
$hasil[] = implode(" ",$potonganKata);
}
return implode(",",$hasil)."<br>";
}

//menampilkan berapa bnyk huruf kecil dari parameter yang dikirim
echo hitungHurufKecil("TranSISI"); 

$input = "Jakarta adalah ibukota negara Republik Indonesia";
echo "Ini Adalah Unigram : ".buat_gram($input,1); //Unigram
echo "Ini Adalah Bigram : ".buat_gram($input,2); //Bigram
echo "Ini Adalah Trigram : ".buat_gram($input,3); //Trigram
?>