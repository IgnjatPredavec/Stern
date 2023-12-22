<?php
    include 'baza.php';
?>
<?php
    session_start();
    if($con){
        if (isset($_POST['submit'])) {
            if (isset($_POST['submit'])) {
                $user = $_POST["username"];
                $pass = $_POST["pass"];
                $query = "SELECT username, pass, razina FROM korisnik WHERE username = ?;";
                $stmt = mysqli_stmt_init($con);
    
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $user);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $username, $hash,$lvl);
                    mysqli_stmt_fetch($stmt);
    
                    if (password_verify($pass,$hash) && mysqli_stmt_num_rows($stmt) > 0) {
                        if($lvl == 1) {
                            header("Location: administracija.php");
                            exit();
                        }
                        else {
                            echo "<form><p>Bok $username! Uspješno ste prijavljeni, ali niste administrator.</p></form>";
                            echo '<form><a href="index.php">Povratak na početnu stranicu</a></form>';
                        }

                    } else {
                        echo '<form><p>Ne postoji korisnik s unesenim podatcima!</p></form>';
                        echo '<form><a href="registracija.php">Registracija</a></form>';
                    }
    
                    mysqli_stmt_close($stmt);
                }  
            }
        }
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="author" content="Luka Milovanović">
        <meta name="keywords" content="Seminarski rad"> 
        <meta name="description" content="Kategorija">
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
        <style>
            h1{
                text-align:center;
                color:red;
            }
            .a{
                text-align:center;
            }
            a:link {
                text-decoration:none;
            }
            a:visited {
                text-decoration:none;
            }
            a:hover {
                text-decoration:none;
            }
            a:active {
                text-decoration:none;
            }
        </style>
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


        <hr>
        <h1>Dobrodošli! Prijavite se!</h1>
        <form method="POST">
            <label for="username">Korisničko ime</label>
            <br />
            <input name="username" type="text" required class="unos"/>
            <br />
            <label for="pass">Lozinka</label>
            <br />
            <input name="pass" type="password" required class="unos"/>
            <br /> <br>
            <input name="submit" type="submit" value="Pošalji" />
        </form>
    <footer>
        <H1>VALORANT</H1>
    </footer>
    </body>
</html>
