<?php
    include 'baza.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registracija</title>
        <meta charset="utf-8">
        <meta name="author" content="Luka Milovanović">
        <meta name="keywords" content="Seminarski rad"> 
        <meta name="description" content="Kategorija">
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

        <style>
            h1{
                text-align:center;
                color:darkcyan;
            }
            .a{
                text-align:center;
                color:darkcyan;
            }
            form{
                width: 100%;
                margin: auto;
                margin-top: 40px;
                text-align: center;
                margin-bottom: 30px;
            }
            .bojaPoruke{
                color:darkcyan;
            }
        </style>
    </head>

    <body>
        <h1>Dobrodošli</h1>
        <form method="POST">
            <label for="title">Ime: </label><br />
            <input type="text" name="ime" id="ime" class="unos"><br />
            <span id="porukaIme" class="bojaPoruke"></span><br>

            <label for="title">Prezime: </label><br />
            <input type="text" name="prezime" id="prezime" class="unos"><br />
            <span id="porukaPrezime" class="bojaPoruke"></span><br>


            <label for="title">Korisničko ime: </label><br />
            <input type="text" name="username" id="username" class="unos"><br />
            <span id="porukaUsername" class="bojaPoruke"></span><br>

            <label for="title">Lozinka: </label><br />
            <input type="password" name="password" id="password" class="unos"><br />
            <span id="porukaPass" class="bojaPoruke"></span><br>

            <label for="title">Ponovljena lozinka: </label><br />
            <input type="password" name="ppassword" id="ppassword" class="unos"><br />
            <span id="porukaPpass" class="bojaPoruke"></span><br>

            <button type="submit" value="Prijava" id="slanje" name="slanje">Prijava</button>
        </form>

    <?php
        if($con){
            if(isset($_POST["slanje"])){
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $username = $_POST['username'];
                $lozinka = $_POST['password'];
                $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
                $razina = 0;
                $registriranKorisnik = 0;

                $sql = "SELECT username FROM korisnik WHERE username = ?";
                $stmt = mysqli_stmt_init($con);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
                if(mysqli_stmt_num_rows($stmt) > 0){
                    echo 'Korisničko ime već postoji!';
                }else{
                    $sql = "INSERT INTO korisnik (ime, prezime, username, pass, razina)VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($con);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
                        mysqli_stmt_execute($stmt);
                        $registriranKorisnik = 1;
                    }
                }
                if($registriranKorisnik == 1) {
                    echo '<form><p>Korisnik je uspješno registriran!</p></form>';
                    header("Location: login.php");
                    exit();
                }
            }
        }
    ?>
        <script type="text/javascript">
            document.getElementById("slanje").onclick = function(event) {
            
                var slanjeForme = true;
                
                // Ime korisnika mora biti uneseno
                var poljeIme = document.getElementById("ime");
                var ime = document.getElementById("ime").value;
                if (ime.length == 0) {
                    slanjeForme = false;
                    poljeIme.style.border="1px dashed red";
                    document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
                } else {
                    poljeIme.style.border="1px solid green";
                    document.getElementById("porukaIme").innerHTML="";
                }
                // Prezime korisnika mora biti uneseno

                var poljePrezime = document.getElementById("prezime");
                var prezime = document.getElementById("prezime").value;
                if (prezime.length == 0) {
                    slanjeForme = false;
                    poljePrezime.style.border="1px dashed red";
                    document.getElementById("porukaPrezime").innerHTML="<br>Unesite Prezime!<br>";
                } else {
                    poljePrezime.style.border="1px solid green";
                    document.getElementById("porukaPrezime").innerHTML="";
                }
                
                // Korisničko ime mora biti uneseno
                var poljeUsername = document.getElementById("username");
                var username = document.getElementById("username").value;
                if (username.length == 0) {
                    slanjeForme = false;
                    poljeUsername.style.border="1px dashed red";
                    document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
                } else {
                    poljeUsername.style.border="1px solid green";
                    document.getElementById("porukaUsername").innerHTML="";
                }
                
                // Provjera podudaranja lozinki
                var poljePass = document.getElementById("password");
                var pass = document.getElementById("password").value;
                var poljePassRep = document.getElementById("ppassword");
                var passRep = document.getElementById("ppassword").value;
                if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                    slanjeForme = false;
                    poljePass.style.border="1px dashed red";
                    poljePassRep.style.border="1px dashed red";
                    document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
                    document.getElementById("porukaPpass").innerHTML="<br>Lozinke nisu iste!<br>";
                } else {
                    poljePass.style.border="1px solid green";
                    poljePassRep.style.border="1px solid green";
                    document.getElementById("porukaPass").innerHTML="";
                    document.getElementById("porukaPpass").innerHTML="";
                }
                
                if (slanjeForme != true) {
                    event.preventDefault();
                }
            
            };
        </script>
</body>
</html>