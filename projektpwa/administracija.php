<!DOCTYPE html>
<html>
    <head>
        <title>Administracija</title>
        <meta charset="utf-8">
        <meta name="author" content="Luka Milovanović">
        <meta name="keywords" content="Seminarski rad"> 
        <meta name="description" content="Članak">
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    </head>
    <body> 
        <header>
        <img src="slike/valorant.png" alt="Valorant logo" class="logo">      
            <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="kategorija.php?id=Esports">ESPORTS</a></li>
                    <li><a href="kategorija.php?id=Updates">UPDATES</a></li>
                    <li><a href="administracija.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.php" target="_blank">UNOS</a></li>
                </ul>
            </nav>
        </header>


        <hr>


        <?php
            include 'baza.php';
            if($con){
                $query = "SELECT * FROM projektpwa";
            }
            $result = mysqli_query($con, $query);
        ?>
        <section>
        <?php
         while($row = mysqli_fetch_array($result)) {
            $id = $row["id"];
            echo '
            <section class="bold">
            <form action="" method="post">
        
            <label for="naslov">Naslov vijesti</label> <br><input type="text" name="naslov"  value="'.$row['naslov'].'">
            <br><br>
            <label for="opis">Opis</label> <br><textarea name="opis" id="" cols="30" rows="10" >'.$row['opis'].'</textarea>
            <br><br>
            <label for="sadrzaj">Sadrzaj vijesti</label> <br><textarea name="sadrzaj" cols="50" rows="20" >'.$row['sadrzaj'].'</textarea>
            <br><br>
            <label for="slika">Slika:</label> <br><input type="file" name="slika"  accept="image/jpg,image/gif,image/webp" value="'.$row['slika'].'">
            <br><br>
            <label for="kategorija">Kategorija vijesti: </label> 
            <br><br>
            <select name="kategorija" >
                <option value="" disabled selected>Odabir kategorije</option>
                <option value="Esports">Esports</option>
                <option value="Updates">Updates</option>
            </select>
            <br><br>
            <label for="prikaz">Prikazati na stranici</label> <br> Prikaži <input type="checkbox" name="prikaz">
            <br><br>
            <button type="reset" value="Ponisti">Ponisti</button>
            <button type="submit" value="Update" name="update">Izmjeni</button>
            <button type="submit" name="delete" value="Izbriši">Izbriši</button>
            <input type="hidden" name="id" value="'.$row['id'].'">
            </form><hr>
            </section>';
            
        }
        ?>
        </section>
        <?php
            if(isset($_POST['delete'])){
                $id = $_POST["id"];
                $query = "DELETE FROM projektpwa WHERE id=$id ";
                $result = mysqli_query($con, $query);
            }
            if(isset($_POST["update"])){
                $id = $_POST["id"];
                $prikaz = 0;
                if(isset($_POST["prikaz"])){
                    $prikaz = 1;
                }
                $naslov = $_POST["naslov"];
                $opis = $_POST["opis"];
                $sadrzaj = $_POST["sadrzaj"];
                $kategorija = $_POST["kategorija"];
                $slika= $_POST["slika"];
                $kategorija=strtoupper($kategorija);
                $datum = date('Y-m-d H:i:s');
                $query = "UPDATE projektpwa SET Naslov='$naslov' ,opis='$opis',sadrzaj='$sadrzaj',slika='$slika',kategorija='$kategorija',datum='$datum',arhiva='$prikaz' WHERE id=$id";
                $result = mysqli_query($con, $query);
            }
            mysqli_close($con);
        ?>
        <footer>
            <H1>VALORANT</H1>
        </footer>
    </body>
</html>