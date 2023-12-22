<?php
    $id=$_GET["id"];
    include 'baza.php';
    if($con){
        $query = "SELECT * FROM projektpwa WHERE id = '$id'";
    }
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Članak</title>
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
                    <li><a href="login.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.php" target="_blank">UNOS</a></li>
                </ul>
            </nav>
        </header>
  
        <?php
        define('UPLPATH', 'slike/');
        while($row = mysqli_fetch_array($result)) {
        echo ' <article class="artikl">';    
        echo '    <section>';
        echo '        <h1>';
        echo            $row["naslov"];
        echo '        </h1>';
        echo '        <p class="podnaslov3">';
        echo            $row["opis"];
        echo '        </p>';
        echo '        <img src="' . UPLPATH . $row['slika'] . '">';
        echo '        <section class="vijest">';
        echo '          <p class="tekst">';
        echo                $row["sadrzaj"];
        echo '          </p>';
        echo '        </section>';
        echo '    </section>';
        echo '</article>';
        }
        ?>
        <footer>
            <H1>VALORANT</H1>
        </footer>
    </body>
</html>