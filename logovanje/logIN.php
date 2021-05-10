<?php
		session_start();
		
		/*
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			header("location: Profil.php");
			exit;
		}*/
		
		include 'KonekcijaSaBazom.php';
        $tabela=new KonekcijaSaBazom();
		$passErr = "0";
		$userErr = "0";
		$user = "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_POST['kIme'];
			$sifra = $_POST['sifra'];
			/*if($id == "") {
				$userErr = "2";
			}
			if($sifra == "") {
				$passErr = "3";
			}*/	
            
			//provera dali se je ulogovao admin
			$result0 = $tabela->LogovanjeAdmin($id);
			$N0 = $result0->num_rows;
			if($N0 > 0 ) {
				$row = $result0->fetch_assoc();
				if ($row['sifra_admin'] == $sifra) {
					$_SESSION["loggedin"] = true;
					$_SESSION["tipKorisnika"] = "admin";
					$_SESSION["idKorisnika"] = $id;
					$podaci = $row['ime_admin'];
					$_SESSION["podaciKorisnika"] = $podaci;
					
					//probno stoji ovo
					$passErr = "0";
					$userErr = "0";
					//echo "<script language=\"javascript\">alert('Uspesno ulogovan student sa mail: ".$id.".');</script>";
					header('Location: ../pocetna_strana.php');
				} else {
					//pogresna sifra
					$passErr = "1";
					$user = $id;
				}
			} else {			
				//provera dali se je ulogovao student
				$result1 = $tabela->LogovanjeStudenta($id);
				$N1 = $result1->num_rows;
				if($N1 > 0 ) {
					$row = $result1->fetch_assoc();
					if ($row['sifra_student'] == $sifra) {
						$_SESSION["loggedin"] = true;
						$_SESSION["tipKorisnika"] = "student";
                        $_SESSION["idKorisnika"] = $id;
						$podaci = "" . $row['ime_student'] . " " . $row['prezime_student'];
                        $_SESSION["podaciKorisnika"] = $podaci;
						
						//probno stoji ovo
						$passErr = "0";
						$userErr = "0";
						//echo "<script language=\"javascript\">alert('Uspesno ulogovan student sa mail: ".$id.".');</script>";
						header('Location: ../pocetna_strana.php');
					} else {
						//pogresna sifra
						$passErr = "1";
						$user = $id;
					}
				} else {				
					//pretraziti dali se je ulogovao profesor
					$result2 = $tabela->LogovanjeProfesora($id);
					$N2 = $result2->num_rows;
					if($N2 > 0 ) {
						$row = $result2->fetch_assoc();
						if ($row['sifra_nastavnik'] == $sifra) {
							$_SESSION["loggedin"] = true;
							$_SESSION['tipKorisnika'] = "profesor";
							$_SESSION["idKorisnika"] = $id;
							$podaci = "" . $row['ime_nastavnik'] . " " . $row['prezime_nastavnik'];
							$_SESSION["podaciKorisnika"] = $podaci;
							
							$passErr = "0";
							$userErr = "0";							
							//echo "<script language=\"javascript\">alert('Uspesno ulogovan profesor sa mail: ".$id."');</script>";						
							header('Location: ../pocetna_strana.php');
						} else {
							//pogresna sifra
							$passErr = "1";
							$user = $id;
						}
					} else {
						//pogresno korisnicko ime ili nepostojecko
						$userErr = "1";
					}
				}
			}
		}
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
	
	<style>
		html,body{
		//background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
		background-color: #DCDCDC;
		background-size: cover;
		background-repeat: no-repeat;
		height: 100%;
		font-family: 'Numans', sans-serif;
		}

		.container{
		height: 100%;
		align-content: center;
		}

		.card{
		height: 340px;
		margin-top: auto;
		margin-bottom: auto;
		width: 400px;
		background-color: rgba(0,0,0,0.5) !important;
		}

		.social_icon span{
		font-size: 60px;
		margin-left: 10px;
		color: #FFC312;
		}

		.social_icon span:hover{
		color: white;
		cursor: pointer;
		}

		.card-header h3{
		color: white;
		}

		.social_icon{
		position: absolute;
		right: 20px;
		top: -45px;
		}

		.input-group-prepend span{
		width: 50px;
		background-color: #FFC312;
		color: black;
		border:0 !important;
		}

		input:focus{
		outline: 0 0 0 0  !important;
		box-shadow: 0 0 0 0 !important;

		}

		.remember{
		color: white;
		}

		.remember input
		{
		width: 20px;
		height: 20px;
		margin-left: 15px;
		margin-right: 5px;
		}

		.login_btn{
		color: black;
		background-color: #FFC312;
		width: 100px;
		}

		.login_btn:hover{
		color: black;
		background-color: white;
		}

		.links{
		color: white;
		}

		.links a{
		margin-left: 4px;
		}
		#sredina {
			text-align: center;
		}			
		#lnk {
			color: white;
		}
		
		.err {
			color: red;
			padding-left: 80px;	
		}
	</style>

</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Uloguj se</h3>
				<div class="d-flex justify-content-end social_icon">
					<!-- <span><img src="logo_moodle2.png"/></span> -->
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<?php
						if($userErr == "1") {
							echo "<span class=\"err\">* Uneseno korisnicko ime ne postoji </span>";
						}
					?>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="E-mail" name="kIme" value="<?php echo $user; ?>">						
					</div>
					<?php
						if($passErr == "1") {
							echo "<span class=\"err\">* Pogresili ste lozinku </span>";
						}
					?>					
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Šifra" name="sifra">
					</div> 
					<!--
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div> -->
					<div class="form-group" id="sredina">
						<input type="submit" value="Login" class="btn login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center">
					<a href="passChange.php" id="lnk">Želite da promenite šifru?</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>