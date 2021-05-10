<?php 
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: logIN.php");
		exit;
	}
	
	// da se promeni lokacija za tabela studenti
	include 'logovanje/KonekcijaSaBazom.php';
	$tabela = new KonekcijaSaBazom();
		
	$id = $_SESSION['idKorisnika'];/*
	$tipKorisnika = $_SESSION['tipKorisnika'];
	
	$tabela->UcitajPodatke($id, $tipKorisnika);*/
	if(isset($_POST['but_upload'])){
 
		$name = $_FILES['file']['name'];
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);

		// Select file type
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Valid file extensions
		$extensions_arr = array("jpg","jpeg","png","gif");

		// Check extension
		if( in_array($imageFileType,$extensions_arr) ){
			/*
			// Insert record
			$query = "insert into images(name) values('".$name."')";
			mysqli_query($con,$query);
			*/
			$tabela->UnesiSliku($name, $id);
			
			// Upload file
			move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
		} else {
			echo "<script> alert(\"Unesite drugi format slike!\"); </script>";
		}
 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
   font-size: 25px;
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

#main {
	width: 450px;;
	margin-top: 0px;
	margin-left: auto;
	margin-right: auto;	
}

#user {
	float: right;
	display: inline;
	
}

#user a {	
	text-decoration: none;
	color: grey;
	padding-right: 15px;
	text-style: bold;
}

#logout {
	background-color: lightgreen;
	padding: 5px;
	padding-top: 15px;
	border: 1px solid green;
	margin-left: 10px;
}

#logout:hover {
	background-color: green;
	color: black;
}

.profil {
	border: 1px solid grey;
	padding: 5px;
	padding-top: 15px;
	background-color: lightgrey;
}

.profil:hover {
	background-color: white;
}

#line {
	margin-top: 90px;	
}

#basic-info img{
	float: left;
	margin-right: 20px;
	margin-top: 20px;	
}

#basic-info p{
	padding: 10px;
}

#basic-info-up{
	margin-top: 20px;
}

#text {
	padding-top: 20px;
	font-weight: bold;
}

</style>


</head>
<body>
<div class="sideNav">	
	<!-- ovde da se ubace konkretni linkovi ka kursevima ... -->
	<a href="#" class="closeBtn">×</a>
	<a href="#">Login</a>
	<a href="#">Register</a>
	<a href="#">Home</a>
	<a href="logovanje/logOut.php">Odjavaaa</a>
	<!-- ................................................... -->
</div>
<div class="main-content">
	<div id="user"> 
	<!--	<a class="profil" href="#"><img  src="profil.jpg" width="25px" height="25px"/> <?php echo $_SESSION["podaciKorisnika"]; ?> </a>
		<a id="logout" href="logOut.php"> Izloguj se</a> -->
		<button class="btn btn-default" onclick="window.location.href = 'Profil.php';"> <img  src="profil.jpg" width="25px" height="25px"/> <?php echo $_SESSION["podaciKorisnika"]; ?> </button>
		<button class="btn btn-default" onclick="window.location.href = 'logovanje/logOut.php';"> Izloguj se </button>
	</div>
	

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
	<div id="main">
		
		<div id="basic-info">
			<?php		
				//ovde da se izmeni da se uzme id od zeljene osobe
				$id = $_SESSION["idKorisnika"];
				$tipKorisnika = $_SESSION["tipKorisnika"];
				
				$tabela->UcitajPodatke($id, $tipKorisnika);
			?>		
			<!--	<a href="#" style="float:left;"> Promeni sliku </a> -->
			<br>
			<form method="post" id="form-pic" action="" enctype='multipart/form-data'>
				<input type="button" id="loadFileXml" value="Izaberi sliku" onclick="document.getElementById('file').click();" class="btn btn-default"/>
				<input type="file" style="display:none;" id="file" name="file"/>
				<button type="submit" name='but_upload' class="btn btn-default">Sacuvaj sliku</button>
			</form>			
		<div>
		<hr id="line">
	
	<br><br><br><br>
		
	<h1>Ovde da se prikazu kursevi</h1>
	<p>..................................</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	
	<h1>Here is some sample text</h1>
	<p>Here is some random sample text too</p>
	</div>

</div>
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
});
function showNav() {
   document.querySelector(".sideNav").style.width = "200px";
   document.querySelector('.main-content').style.marginLeft = "200px";
}
function hideNav() {
   document.querySelector(".sideNav").style.width = "0";
   document.querySelector('.main-content').style.marginLeft = "0px";
}
function forward(){
	header('Location: Profil.php');
}
</script>
</body>
</html>