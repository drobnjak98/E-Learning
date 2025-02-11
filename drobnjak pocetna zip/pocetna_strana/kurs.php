<!DOCTYPE html>
<?php
    session_start();
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

.wrapper {
    margin: 24px 80px;
    height: auto;
    padding: 48px;
    border-radius: 15px;
    box-shadow: 0px 0px 12px 7px rgba(61,55,76,0.64);
}
.opis {
  margin: 24px 15px;
  margin
  position: relative;
  height: auto;
  word-wrap: break-word;
}
.sekcija {
  border-bottom: 1px solid gray;
  padding: 24px 0px;
}
.lista {
    display: flex;
    flex-direction: column;
}
.listItem {
    padding-top: 12px;
}
.fa {
    padding-top:24px;
    font-size: 20px;
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
        <a href="profill.php">Profil</a>
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
    if($_SESSION["tipKorisnika"] == "student")  // pocetak student sesije
    {
?>
<div class='wrapper'>
<?php
$sifra = $_GET["pocetna_kurs"]; 
$mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
$mysqli -> set_charset("utf8");

$result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$sifra'") or die($mysqli->error);
while($row = $result->fetch_assoc())
{
?>
<div style="display: flex; justify-content: space-between">
    <h3><?php echo($row['naziv']); ?></h3>
    <button class="btn-danger" style="border-radius: 5px">Sacuvaj</button>
    </div>
    <div contentEditable="true" class="opis"><?php echo($row['opis']); ?></div>
    <div class="sekcija" style="border-top: 1px solid gray;">
        <h4>Nedelja 1</h4>
        <ul class="lista" >
            <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_3.doc</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_4.doc</li>
        <ul>
    </div>

    <div class="sekcija">
        <h4>Nedelja 2</h4>
        <ul class="lista" >
            <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
        <ul>
    </div>

    <div class="sekcija">
        <h4>Nedelja 3</h4>
        <ul class="lista" >
            <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
        <ul>
    </div>
    
    <div class="sekcija">
        <h4>Nedelja 4</h4>
        <ul class="lista" >
            <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
        <ul>
    </div>
    <div class="sekcija">
        <h4>Nedelja 5</h4>
        <ul class="lista" >
            <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
        <ul>
    </div>

    <div class="sekcija">
        <h4>Nedelja 6</h4>
        <ul class="lista" >
            <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
        <ul>
    </div>
    
    <div class="sekcija">
        <h4>Nedelja 7</h4>
        <ul class="lista" >
            <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
            <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
        <ul>
    </div>
    <div class="sekcija">
        <h4>Nedelja 8</h4>
    </div>
    
    <div class="sekcija">
        <h4>Nedelja 9</h4>
    </div>
    <div class="sekcija">
        <h4>Nedelja 10</h4>
    </div>

    <div class="sekcija">
        <h4>Nedelja 11</h4>
        <ul>
        <ul>
    </div>
    
    <div class="sekcija">
        <h4>Nedelja 12</h4>
        <ul>
        <ul>
    </div>
    <div class="sekcija">
        <h4>Nedelja 13</h4>
        <ul>
        <ul>
    </div>
    
    <div class="sekcija">
        <h4>Nedelja 14</h4>
        <ul>
        <ul>
    </div>
    <div class="sekcija">
        <h4>Nedelja 15</h4>
        <ul>
        <ul>
    </div>
</div>
<?php        
    }
} // kraj student sesije 
?>
<?php
    if($_SESSION["tipKorisnika"] == "profesor")
    {
    ?>
    <div class='wrapper'>
    <?php
    $sifra = $_GET["pocetna_kurs"]; 
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
    $mysqli -> set_charset("utf8");
    
    $result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$sifra'") or die($mysqli->error);
    while($row = $result->fetch_assoc())
    {
    ?>
    <div style="display: flex; justify-content: space-between">
        <h3><?php echo($row['naziv']); ?></h3>
        <div>
        <button class="btn-danger" style="border-radius: 5px">Izmeni</button>
        <button class="btn-primary" style="border-radius: 5px;">Sacuvaj</button>
        </div>
        </div>
        <div contentEditable="true" class="opis">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ipsa velit unde tempore deleniti? Similique error nihil reiciendis eveniet corrupti rem, reprehenderit commodi iure pariatur, nobis exercitationem, nulla quam enim?
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis sed repellat molestiae laborum quas, minima distinctio dolore perspiciatis doloribus nulla perferendis laboriosam corporis, provident ad quasi nemo ipsa dicta blanditiis.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero totam harum eveniet doloribus? Reprehenderit velit dolor magni repellendus dolorem consequatur rem in placeat dolorum mollitia, architecto itaque laudantium, accusamus ratione!</div>
        <div style=" float:right; ">
        </div>
      
        <div class="sekcija" style="border-top: 1px solid gray;">
            <h4>Nedelja 1</h4>
        <div>
        <button class="btn-primary" style="border-radius: 5px">Dodaj fajl</button>
        </div>
            <ul class="lista" >
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_2.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_3.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <ul>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 2</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 3</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 4</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 5</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 6</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 7</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 8</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 9</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
        </div>
        <div class="sekcija">
            <h4>Nedelja 10</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 11</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 12</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 13</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 14</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 15</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
    </div>
    <?php        
    } 
 } // kraj student sesije 
?>
<?php
    if($_SESSION["tipKorisnika"] == "admin")
    {
    ?>
    <div class='wrapper'>
    <?php
    $sifra = $_GET["pocetna_kurs"]; 
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
    $mysqli -> set_charset("utf8");
    
    $result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$sifra'") or die($mysqli->error);
    while($row = $result->fetch_assoc())
    {
    ?>
    <div style="display: flex; justify-content: space-between">
        <h3><?php echo($row['naziv']); ?></h3>
        <div>
        <button class="btn-danger" style="border-radius: 5px">Izmeni</button>
        <button class="btn-primary" style="border-radius: 5px;">Sacuvaj</button>
        </div>
        </div>
        <div class="opis">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur mollitia reiciendis quia sunt tempore vel totam magni, facere voluptatem nostrum, eum nobis corporis, harum quo delectus aliquid fugiat dolorum possimus. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis quo porro sequi repudiandae ab, sit, nemo architecto sunt fuga debitis laborum unde! Iusto nam ipsa enim fugiat quisquam? Quod, ea! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum aliquid assumenda fugit beatae ratione? Et itaque, iusto quia libero rerum veniam officiis dignissimos nisi, in expedita autem minus consequuntur id!</div>
        <div style=" float:right; ">
        </div>
      
        <div class="sekcija" style="border-top: 1px solid gray;">
            <h4>Nedelja 1</h4>
        <div>
        <button class="btn-primary" style="border-radius: 5px">Dodaj fajl</button>
        </div>
            <ul class="lista" >
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_2.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_3.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <div style="justify-content: space-between;">
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf </li>
                <button style="margin-left:1050px; border-radius:5px;" class='btn-danger'>obrisi</button>
            </div>
            <ul>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 2</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 3</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 4</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 5</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 6</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 7</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul class="lista" >
                <li class="fa"><a>&#xf15c; </a>Fajl_1.pdf</li>
                <li class="fa"><a>&#xf15c; </a>Fajl_2.doc</li>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 8</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 9</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
        </div>
        <div class="sekcija">
            <h4>Nedelja 10</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
        </div>
    
        <div class="sekcija">
            <h4>Nedelja 11</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 12</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 13</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        
        <div class="sekcija">
            <h4>Nedelja 14</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
        <div class="sekcija">
            <h4>Nedelja 15</h4>
        <button class="btn-danger" style="border-radius: 5px">Dodaj fajl</button>
            <ul>
            <ul>
        </div>
    </div>
    <?php        
    } 
 } // kraj student sesije 
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