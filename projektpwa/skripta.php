<?php
    $spremi = 0;
    if(isset($_POST["spremi"])){
        $spremi = 1;
    }
    if(isset($_POST["posalji"])){
        $naslov = $_POST["naslov"];
        $opis = $_POST["opis"];
        $sadrzaj = $_POST["sadrzaj"];
        $kategorija = $_POST["kategorija"];
        $slika= $_POST["slika"];
        $kategorija=strtoupper($kategorija);
        $datum = date('Y-m-d H:i:s');
    }

    include 'baza.php';

    if($con){
        $query = "INSERT INTO projektpwa (naslov,opis,sadrzaj,slika,kategorija,datum,arhiva) VALUES ('$naslov','$opis','$sadrzaj','$slika','$kategorija','$datum','$spremi');";
        $result = mysqli_query($con, $query);
    }
    mysqli_close($con);

?>

