<?php
    $kat=$_GET["id"];
    include 'baza.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kategorija <?php echo $kat?></title>
        <meta charset="utf-8">
        <meta name="author" content="Luka Milovanović">
        <meta name="keywords" content="Seminarski rad"> 
        <meta name="description" content="Kategorija">
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
            $query = "SELECT * FROM projektpwa WHERE kategorija='". $kat ."' ORDER BY datum DESC";
            $result = mysqli_query($con, $query);
        ?>
        
        <section class="podnaslov">
            <h2><?php echo $kat?></h2>
        </section>

        
        <?php
            define('UPLPATH', 'slike/');
            $i=0;
            while($row = mysqli_fetch_array($result)) {
            if($i%3 == 0){
                $query = "SELECT * FROM projektpwa WHERE kategorija='". $kat ."' ORDER BY datum DESC LIMIT ".$i.",3";
                $result1 = mysqli_query($con, $query);
                echo ' <section class="kat">';
                while($row = mysqli_fetch_array($result1)) {
                    $id = $row["id"];
                    echo '<article class="artikl1">';
                    echo '  <a href="clanak.php?id=' . $id . '">';
                    echo '      <img src="' . UPLPATH . $row['slika'] . '">';
                    echo '      <h3>';
                    echo            $row['naslov'];
                    echo '      </h3>';
                    echo '      <br> ';
                    echo '      <p>';
                    echo            $row['opis'];
                    echo '      </p> ';
                    echo '  </a>';
                    echo '</article>';   
                    $i++;   
                } 
            }
            echo ' </section>';
            }
        ?>
        <footer>
        <H1>VALORANT</H1>
        </footer>
    </body>
</html>