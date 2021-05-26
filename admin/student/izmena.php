<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<style>
			body{
				//background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
				background-color: #DCDCDC;
				background-size: cover;
				background-repeat: no-repeat;
				height: 100%;
				font-family: 'Numans', sans-serif;
			}
		
			.modal .modal-dialog {
				max-width: 400px;
				z-index: 9999;
			}
			.modal .modal-header, .modal .modal-body, .modal .modal-footer {
				padding: 20px 30px;
			}
			.modal .modal-content {
				border-radius: 3px;
				font-size: 14px;
			}
			.modal .modal-footer {
				background: #ecf0f1;
				border-radius: 0 0 3px 3px;
			}
			.modal .modal-title {
				display: inline-block;
			}
			.modal .form-control {
				border-radius: 2px;
				box-shadow: none;
				border-color: #dddddd;
			}
			.modal textarea.form-control {
				resize: vertical;
			}
			.modal .btn {
				border-radius: 2px;
				min-width: 100px;
			}	
			.modal form label {
				font-weight: normal;
			}
			#link {
				text-decoration: none;
				
				margin-right: 10px;
			}
			
			#greska {
				color: red;
				margin-left: 45px;
			}
	
	</style>
	
	<?php 
		$email = $ime = $prezime = $indeks = $studije = $sifra = "";
		$sifraErr = $emailErr = $imeErr = $prezimeErr = "";
		
		if(isset($_GET['id'])) {
			$email = $_GET['id'];
		}
		if(isset($_GET['ime'])) {
			$ime = $_GET['ime'];
		}
		if(isset($_GET['prezime'])) {
			$prezime = $_GET['prezime'];
		}
		if(isset($_GET['indeks'])) {
			$indeks = $_GET['indeks'];
		}
		if(isset($_GET['studije'])) {
			$studije = $_GET['studije'];
		}
		if(isset($_GET['sifra'])) {
			$sifra = $_GET['sifra'];
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			include '../../KonekcijaSaBazom.php';
	        $tabela = new KonekcijaSaBazom();
			
            $Email = $_POST['emailZaIsmeniti'];
			$Ime = $_POST['imeZaIsmeniti'];
			$Prezime = $_POST['prezimeZaIsmeniti'];
			$Indeks = $_POST['indeksZaIsmeniti'];
			$Studije = $_POST['studijeZaIsmeniti'];
			$Sifra = $_POST['sifraZaIsmeniti'];
			
			$email = $Email;
			$ime = $Ime;
			$prezime = $Prezime;
			$indeks = $Indeks;
			$studije = $Studije;
			$sifra = $Sifra;
			
			// ovo se moze promeni po zelji
			if(strlen($Sifra) < 1 ) {
				$sifraErr = "* Morate uneti vise od 3 karaktera";
			} /*else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "* Nevalidan format email-a";
			} */else if (!preg_match("/^[a-zA-Z-' ]*$/",$ime)) {
				$imeErr = "* Samo slova i prazno mesto su dozvoljeni";
			}  else if (!preg_match("/^[a-zA-Z-' ]*$/",$prezime)) {
				$prezimeErr = "* Samo slova i prazno mesto su dozvoljeni";
			} else {
				if($tabela->Update($Email, $Ime, $Prezime, $Indeks, $Studije ,$Sifra, $Indeks)) {
					echo "<script language=\"javascript\">alert('Izmene su uspesno ucitane.');</script>";
					header('Location: RadSaBazomStudenata.php');
				}
				else  
					echo "<script language=\"javascript\">alert('Doslo je do greske pri ucitavanje izmena.');</script>";
			}
		}
	?>
	
    </head>
    <body>


		<div id="editEmployeeModal" >
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="modal-header">						
							<h4 class="modal-title">Izmena podataka o studentu</h4>
							<button type="button" class="close" onclick="povratak()">&times;</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Email</label>
								<span id="greska"><?php echo $emailErr;?></span>
								<input type="email" class="form-control" value="<?php echo $email; ?>" name="emailZaIsmeniti" readonly>
							</div>				
							<div class="form-group">
								<label>Ime</label>
								<span id="greska"><?php echo $imeErr;?></span>
								<input type="text" class="form-control" value="<?php echo $ime; ?>" name="imeZaIsmeniti" required>
							</div>
							<div class="form-group">
								<label>Prezime</label>
								<span id="greska"><?php echo $prezimeErr;?></span>
								<input type="text" class="form-control" value="<?php echo $prezime; ?>" name="prezimeZaIsmeniti" required>
							</div>
							<div class="form-group">
								<label>Indeks</label>
								<input type="text" class="form-control" value="<?php echo $indeks; ?>" name="indeksZaIsmeniti" required>
							</div>
							<div class="form-group">
								<label>Godina studija</label>
								<input type="number" class="form-control" value="<?php echo $studije; ?>" name="studijeZaIsmeniti"  min="1" max="5" required>
							</div>	
							<div class="form-group">
								<label>Sifra</label>
								<span id="greska"><?php echo $sifraErr;?></span>
								<input type="text" class="form-control" value="<?php echo $sifra; ?>" name="sifraZaIsmeniti" required>
							</div>	
						</div>
						<div class="modal-footer">
							<a href="RadSaBazomStudenata.php" id="link">Odustani</a>
							<input type="submit" class="btn btn-info" value="Zacuvaj">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			function povratak() {
				window.location="RadSaBazomStudenata.php";
			}	
		</script>
</body>
</html>