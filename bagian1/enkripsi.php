<?php 
function enkripsi($input) {
    $hasil = "";
    $huruf = str_split($input);

    foreach ($huruf as $indeks => $char) {
        $posisi = $indeks + 1; 
        $ascii = ord($char);   // Ambil nilai ASCII huruf tersebut

        if ($posisi % 2 != 0) {
            // Jika posisi ganjil (1, 3, 5): Tambah (+)
            $charBaru = chr($ascii + $posisi);
        } else {
            // Jika posisi genap (2, 4, 6): Kurang (-)
            $charBaru = chr($ascii - $posisi);
        }
        
        $hasil .= $charBaru;
    }
    return $hasil;
}

echo enkripsi("DFHKNQ"); // Output: EDKGSK
?>