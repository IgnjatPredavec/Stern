<?php
    include 'baza.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>UNOS</title>
        <link rel="stylesheet" type="text/css"  href="style.css?v=<?php echo time();?>">
        <script type="text/javascript" src="jquery-1.11.0.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
        <script src="js/form-validation.js"></script> 
        <meta charset="UTF-8">
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
        <section class="forma">
            <section class="bold">
                <form action="skripta.php" method="POST" name="unos">
                    <label for="naslov">Naslov:</label><br>
                    <input  type="text" name="naslov" id="naslov"><br><br>
                    <span id="porukaNaslov"></span><br>

                    <label for="opis">Opis vijesti:</label><br>
                    <textarea name="opis" rows="10" cols="30" id="opis"></textarea><br><br>
                    <span id="porukaOpis"></span><br>

                    <label for="sadrzaj">Sadržaj vijesti: </label><br>
                    <textarea name="sadrzaj" rows="20" cols="50" id="sadrzaj"></textarea><br><br>
                    <span id="porukaSadrzaj"></span><br>

                    <label for="kategorija">Odaberite kategoriju:</label><br><br>
                    <select name="kategorija" id="kategorija">
                        <option value="" disabled selected>Odabir kategorije</option>
                        <option value="Esports">Esports</option>
                        <option value="Updates">Updates</option>
                    </select><br><br>
                    <span id="porukaKategorija"></span><br>

                    <label for="slika">Ubacite sliku:</label><br>
                    <input type="file" name="slika" accept="image/*" id="slika"><br><br>
                    <span id="porukaSlika"></span><br>

                    <label for="spremi">Spremi u arhivu:</label>
                    <br>
                    <input type="checkbox" value="spremi" name="spremi"><br><br>
                    
                    <input type="submit" name="posalji" value="Posalji" id="posalji">
                </form>  
            </section>  
        </section>

        <script type="text/javascript">

            document.getElementById("posalji").onclick = function(event) {
            
                var slanjeForme = true;
                

                var poljeNaslov = document.getElementById("naslov");
                var title = document.getElementById("naslov").value;
                if (title.length < 5 || title.length > 30) {
                    slanjeForme = false;
                    poljeNaslov.style.border="1px dashed red";
                    document.getElementById("porukaNaslov").innerHTML="<br>Naslov vjesti mora imati između 5 i 30 znakova!<br>";
                } else {
                    poljeNaslov.style.border="1px solid green";
                    document.getElementById("porukaNaslov").innerHTML="";
                }
                

                var poljeOpis = document.getElementById("opis");
                var opis = document.getElementById("opis").value;
                if (opis.length < 10 || opis.length > 100) {
                    slanjeForme = false;
                    poljeOpis.style.border="1px dashed red";
                    document.getElementById("porukaOpis").innerHTML="<br>Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
                } else {
                    poljeOpis.style.border="1px solid green";
                    document.getElementById("porukaOpis").innerHTML="";
                }
                

                var poljeSadrzaj = document.getElementById("sadrzaj");
                var sadrzaj = document.getElementById("sadrzaj").value;
                if (sadrzaj.length == 0) {
                    slanjeForme = false;
                    poljeSadrzaj.style.border="1px dashed red";
                    document.getElementById("porukaSadrzaj").innerHTML="<br>Sadržaj mora biti unesen!<br>";
                } else {
                    poljeSadrzaj.style.border="1px solid green";
                    document.getElementById("porukaSadrzaj").innerHTML="";
                }


                var poljeSlika = document.getElementById("slika");
                var slika = document.getElementById("slika").value;
                if (slika.length == 0) {
                    slanjeForme = false;
                    poljeSlika.style.border="1px dashed red";
                    document.getElementById("porukaSlika").innerHTML="<br>Slika mora biti unesena!<br>";
                } else {
                    poljeSlika.style.border="1px solid green";
                    document.getElementById("porukaSlika").innerHTML="";
                }
               

                var poljeKategorija = document.getElementById("kategorija");
                if(document.getElementById("kategorija").selectedIndex == 0) {
                    slanjeForme = false;
                    poljeKategorija.style.border="1px dashed red";
                    document.getElementById("porukaKategorija").innerHTML="<br>Kategorija mora biti odabrana!<br>";
                } else {
                    poljeKategorija.style.border="1px solid green";
                    document.getElementById("porukaKategorija").innerHTML="";
                }

                if (slanjeForme != true) {
                event.preventDefault();
                }
            
            };
        </script>
        <footer>
            <H1>VALORANT</H1>
        </footer>
    </body>
</html>