<?php 
	session_start();
	/*
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: logovanje/logIN.php");
		exit;
	}*/
	
	// da se promeni lokacija za tabela studenti
	include 'KonekcijaSaBazom.php';
	$tabela = new KonekcijaSaBazom();
		
	$id = $_SESSION['idKorisnika'];
	$tipKorisnika = $_SESSION["tipKorisnika"];
    $imePrezime = $_SESSION["podaciKorisnika"];
	
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
			$tabela->UnesiSliku($name, $id, $tipKorisnika);
			
			// Upload file
			move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
		} else {
			echo "<script> alert(\"Unesite drugi format slike!\"); </script>";
		}
 
	}

	$profilna = $tabela->uzmiProfilnuSliku($id, $tipKorisnika);
	if ($profilna == "") {
		$profilna = "profil.jpg";
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <style>
      body{
          margin-top:20px;
          color: #1a202c;
          text-align: left;
          background-color: #ffffff;    
      }
      .main-body {
          padding: 15px;
      }
      .card {
          box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
      }

      .card {
          position: relative;
          display: flex;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: rgb(245, 239, 239);
          background-clip: border-box;
          border: 0 solid rgba(0,0,0,.125);
          border-radius: .25rem;
      }

      .card-body {
          flex: 1 1 auto;
          min-height: 1px;
          padding: 1rem;
      }

      .gutters-sm {
          margin-right: -5px;
          margin-left: -5px;
      }

      .gutters-sm>.col, .gutters-sm>[class*=col-] {
          padding-right: 5px;
          padding-left: 5px;
      }
      .mb-3, .my-3 {
          margin-bottom: 1rem!important;
      }

      .bg-gray-300 {
          background-color: #ffffff;
      }
      .h-100 {
          height: 100%!important;
      }
      .shadow-none {
          box-shadow: none!important;
      }
      /* moj css nadole */
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
        font-size: 18px;
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

      .dropdown:hover .openSideNav {
        background-color: red;
      }

      #right_side {
        float: right;
      }

      .navbar a {
        /*float: left;*/
        font-size: 16px;
        color: white;
        text-align: center;
        text-decoration: none;
      }
    </style>

  </head>
   <body>

    <div class="sideNav">	
      <!-- ovde da se ubace konkretni linkovi ka kursevima ... -->
      <a href="#" class="closeBtn">×</a>
      <br>
      <!-- ovako ce dabude nadalje ali zbog prezentiranja neka bude obicni link za sada
      <button class="btn btn-light" onclick="window.location.href = 'profill.php';" style="margin-left: 15px"> <img  src="upload/<?php echo $profilna; ?>" width="25px" height="25px"/> <?php echo $_SESSION["podaciKorisnika"]; ?> </button>
      -->
      <a href="pocetna_strana.php">Pocetna strana</a>
      <a href="profill.php">Profil</a>
      <a href="proces.php?odjava">Odjava</a>
      <!-- ................................................... -->
    </div>

    <div class="main-content">

      <div class="header">
        <p id="header_p"><img src="logo_moodle2.png" /></p>		
      </div>        

      <nav class="navbar sticky-top navbar-dark bg-dark">
          
        <div class="dropdown">
          <!-- sa klikom da dugme se otvara stranicni meni-->
            <button class="openSideNav"><i class="fa fa-align-justify"></i></button>
        </div>
        <a id="right_side" href="pocetna_strana.php"><i class="fa fa-home"></i></a>
  
      </nav>

      <div class="container">
        <div class="main-body">
            
          <div class="row gutters-sm">
                    
            <!-- profilna slika -->
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="upload/<?php echo $profilna; ?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $imePrezime; ?></h4> 
                      <br>
                      <form method="post" id="form-pic" action="" enctype='multipart/form-data'>
                        <input type="button" id="loadFileXml" value="Izaberi sliku" onclick="document.getElementById('file').click();" class="btn btn-primary"/>
                        <input type="file" style="display:none;" id="file" name="file"/>
                        <button type="submit" name='but_upload' class="btn btn-outline-primary">Sacuvaj sliku</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>                      
            </div>
                    
            <!-- osnovne informacije -->
            <div class="col-md-5 ">
              <div class="card mb-3">
                <div class="card-body">
                  <?php
                    $tabela->UcitajPodatke($id, $tipKorisnika);
                  ?>
                </div>
              </div>                 
										 					  
            </div>
					
            <!-- kursevi -->
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"><b>Kursevi:</b></i></h6>
                  <?php 
                    $tabela->prikazKurseveNaProfilu($id, $tipKorisnika);
                  ?>                            
                </div> 							  
              </div>
            </div>
          </div>					
        </div>
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
          i--;
      });
      function showNav() {
          document.querySelector(".sideNav").style.width = "220px";
          document.querySelector('.main-content').style.marginLeft = "220px";
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