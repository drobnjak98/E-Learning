<!DOCTYPE html>
<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: logIN.php");
        exit;
}
?>
<html lang="sr-latin">
<head>
<meta charset="utf8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<meta name="author" content="Jonathan Stipe" />
<meta name="copyright" content="&copy; 2012 Jonathan Stipe" />
<title>E-Ucenje</title>
<style>
body {
	margin: 0;
}

.header {
	text-align: center;
}

.sideNav {
   height: 100vh;
   width: 0;
   position: fixed;
   z-index: 1;
   top: 0;
   left: 0;
   background-color: rgb(46, 218, 195);
   overflow-x: hidden;
   padding-top: 60px;
   transition: 0.5s;
}
.sideNav a {
   padding: 8px 8px 8px 32px;
   text-decoration: none;
   font-size: 16px;
   color: #000000;
   font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
   display: block;
   transition: 0.3s;
}
.sidenav a:hover {
   color: #f1f1f1;
}
.sideNav .closeBtn {
   position: absolute;
   top: 0;
   right: 25px;
   font-size: 36px;
   margin-left: 50px;
}

/*
button {
   padding: 15px;
   background-color: rgb(0, 27, 145);
   color: rgb(255, 255, 255);
   font-size: 20px;
   border: none;
   border-radius: 2%;
}*/

.main-content{
   transition: 0.5s;
}

.navbar {
  overflow: hidden;
  background-color: #333;
  font-family: Arial, Helvetica, sans-serif;
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
  
  z-index: 500;
}

.navbar a {
  //float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .openSideNav {
  cursor: pointer;
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .openSideNav {
  background-color: red;
}

.right_side {
	float: right;
}

#tekst{
    margin: auto;
    width: 40%;
    margin-bottom: 20px;
    margin-top: 20px;
    padding-top: 15px;
    background-color: white;
    border: 5px solid #333;
    float: center;
    content: "";
    display: table;
    clear: both;
}

#tekst h3{
    margin-left:25px;
    margin-right:30px;
    margin-bottom:20px;
}

#tekst p{
    margin-left: 10px;
}

#tekst ul{
    display: block;
    margin-left: auto;
    margin-right: auto;
}

#tekst ul li{
}

#tekst ul li a{
    text-decoration: none;
    font-size: 20px;
    color: black;
}

#tekst ul li a:hover{
    color: rgb(46, 218, 195);
}

</style>
<script>
    <?php
        $greska=$_SESSION['student_kurs_sifra_greska'];
        if($greska!="")
        {
    ?>
            alert(<?php echo "\"" .$greska. "\""; ?>);
    <?php   
        }
        $_SESSION['student_kurs_sifra_greska']="";
    ?>
</script>  
</head>
<body>
<!-- stranicni meni-->
<div class="sideNav">	
	<!-- ovde da se ubace konkretni linkovi ka kursevima ... -->
        <a href="#" class="closeBtn">×</a>
        <br>
	<a href="pocetna_strana.php">Pocetna strana</a>        
<?php 
        if($_SESSION["tipKorisnika"] != 'admin') {
?>
        <a href="profill.php">Profil</a><?php
        }
?>
<?php 
        if($_SESSION["tipKorisnika"] == 'admin') {
?>
        <a href="admin/student/RadSaBazomStudenata.php">Rad sa bazom studenata</a>
        <a href="admin/profesor/RadSaBazomProfesora.php">Rad sa bazom profesora</a>
        <a href="admin/kurs/RadSaBazomKurseva.php">Rad sa bazom kurseva</a>
<?php
        }
?>
        <a href="proces.php?odjava">Odjava</a>
	<!-- ................................................... -->
</div>

<div class="main-content">
    
	<div class="header">
		<p id="header_p"><img src="logo_moodle2.png" /></p>
	</div>

	<div class="navbar">
		<div class="dropdown">
		<!-- sa klikom da dugme se otvara stranicni meni-->
			<button class="openSideNav"><i class="fa fa-align-justify"></i></button>
		</div>
		<!-- link koje ce da baca na pocetnu stranu od trenutno ulogovanog korisnika -->
		<a class="right_side" href="pocetna_strana.php"><i class="fa fa-home"></i></a>
	</div>	
</div>
<?php
    if($_SESSION["tipKorisnika"] == "student")
    {
?>
        <div id="tekst">
            <form action="proces.php" method="POST">
                <input type="text" name="sifra" placeholder="šifra kursa" style=" margin-left:20px; margin-bottom:15px; width: 60%;">
                <button class="btn btn-success" type="submit" name="dodaj_kurs_sifra"  style=" margin-left:20px; margin-right:20px; margin-bottom:15px; width: 150px; "><i class="material-icons">&#xE147;</i>  Dodaj kurs</button>
            </form>
        </div>
        <div id="tekst">
            <h3>Moji kursevi:</h3>
            <ul>
<?php
        $email=$_SESSION["idKorisnika"];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli -> set_charset("utf8");
        $result= $mysqli->query("SELECT * FROM prati INNER JOIN kurs ON prati.sifra_kursa=kurs.sifra_kursa WHERE prati.email_student='$email'") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>
        </div>
<?php
    }
?>
<?php
    if($_SESSION["tipKorisnika"] == "profesor")
    {
?>
        <div id="tekst">
            <h3>Moji kursevi:</h3>
            <p>Prva godina</p>
            <ul>
<?php
        $email=$_SESSION["idKorisnika"];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli -> set_charset("utf8");
        $result= $mysqli->query("SELECT * FROM  kurs WHERE email_nastavnik='$email' AND godina=1") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>
            <p>Druga godina</p>
            <ul>
<?php
        $result= $mysqli->query("SELECT * FROM  kurs WHERE email_nastavnik='$email' AND godina=2") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>
            <p>Treća godina</p>
            <ul>
<?php
        $result= $mysqli->query("SELECT * FROM  kurs WHERE email_nastavnik='$email' AND godina=3") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>
            <p>Četvrta godina</p>
            <ul>
<?php
        $result= $mysqli->query("SELECT * FROM  kurs WHERE email_nastavnik='$email' AND godina=4") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>                      
        </div>
<?php
    }
?>
<?php
    if($_SESSION["tipKorisnika"] == "admin")
    {
?>
        <div id="tekst">
            <h3>Svi kursevi:</h3>
            <p>Prva godina</p>
            <ul>
<?php
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli -> set_charset("utf8");
        $result= $mysqli->query("SELECT * FROM  kurs WHERE godina=1") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>
            <p>Druga godina</p>
            <ul>
<?php
        $result= $mysqli->query("SELECT * FROM  kurs WHERE godina=2") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>
            <p>Treća godina</p>
            <ul>
<?php
        $result= $mysqli->query("SELECT * FROM  kurs WHERE godina=3") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>
            <p>Četvrta godina</p>
            <ul>
<?php
        $result= $mysqli->query("SELECT * FROM  kurs WHERE godina=4") or die($mysqli->error);
        while($row = $result->fetch_assoc())
        {
?>
                <li><a href="kurs.php?pocetna_kurs=<?php echo($row['sifra_kursa']); ?>"><?php echo($row['naziv']); ?></a></li>
<?php        
        }
?>
            </ul>                      
        </div>
<?php
    }
?>
<script>
var i = 0;

let openBtn = document.querySelector(".openSideNav");
openBtn.addEventListener("click", () => {
	if (i == 0) {
		showNav();
		i++;
	} else {
		hideNav();
		i--;
	}
});
let closeBtn = document.querySelector(".closeBtn");
closeBtn.addEventListener("click", () => {
   hideNav();
   i--;
});
function showNav() {
   document.querySelector(".sideNav").style.width = "200px";
   // margina na 0  da ne se guzva sajt
   document.querySelector('.main-content').style.marginLeft = "200px";
}
function hideNav() {
   document.querySelector(".sideNav").style.width = "0";
   document.querySelector('.main-content').style.marginLeft = "0px";
}

</script>
</body>
</html>