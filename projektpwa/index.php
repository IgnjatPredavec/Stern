<?php
    include 'baza.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pocetna</title>
        <meta charset="utf-8">
        <meta name="author" content="Luka Milovanović">
        <meta name="keywords" content="Seminarski rad"> 
        <meta name="description" content="Pocetna">
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <header>
        <img src="slike/valorant.png" alt="Valorant logo" class="logo">      
            <nav>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="kategorija.php?id=Esports">ESPORTS</a></li>
                    <li><a href="kategorija.php?id=Updates">UPDATES</a></li>
                    <li><a href="login.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.php" target="_blank">UNOS</a></li>
                </ul>
            </nav>
        </header>
        <!-- ------------------------------------------------------------------------------------ -->
        <hr>
    
        <section class="podnaslov" id="Esports">
            <h2>Esports ➭</h2>
        </section>
        <section class="objave">
        <?php
            define('UPLPATH', 'slike/');
            if($con){
                $query = "SELECT * FROM projektpwa WHERE arhiva=1 AND kategorija='Esports' ORDER BY Datum DESC LIMIT 3";
            }
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
            $id = $row["id"];
            echo '<article>';
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
            }
        ?>
        </section>
        <!-- ------------------------------------------------------------------------------------ -->
        <hr>


        <section class="podnaslov2" id="Updates">
            <h2>UPDATES ➭</h2>
        </section>
        <section class="objave">
            
        <?php
            if($con){
                $query = "SELECT * FROM projektpwa WHERE arhiva=1 AND kategorija='Updates' ORDER BY datum DESC LIMIT 3";
            }
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
            $id = $row["id"];
            echo '<article>';
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
            }
        ?>
    </section>
        <footer>
            <H1>VALORANT</H1>
        </footer>
    </body>
</html>
