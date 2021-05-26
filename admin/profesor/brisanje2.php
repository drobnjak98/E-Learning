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
		#del {
			margin-left: 30px;
			margin-right: 30px;
	
		}
	</style>
	
	<?php 
		$id = "";
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			include '../../KonekcijaSaBazom.php';
	        $tabela = new KonekcijaSaBazom();
            $ID = $_POST['idToDelete'];
			$test = false;
			
            if($tabela->DeleteProf($ID)) {
                echo "<script language=\"javascript\">alert('Slika je uspeno obrisana.');</script>";
				header('Location: RadSaBazomProfesora.php');
			}
            else  
                echo "<script language=\"javascript\">alert('Doslo je do greske u brisanju.');</script>";
		}
	?>
	
	</head>
    <body>
	<div id="deleteEmployeeModal" >
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="modal-header">						
							<h4 class="modal-title">Izbriši profesora iz baze</h4>
							<button type="button" class="close" onclick="povratak()">&times;</button>
						</div>
						<div class="modal-body">					
							<p>Dali ste sigurni da želite da obrišete?</p>
							<p class="text-warning"><small>Ovaj korak nema povratka.</small></p>
						</div>
						<div id="del">
							<label>ID</label>
							<input type="text" class="form-control" name="idToDelete" id="elementToDelete" value="<?php echo $id;?>" readonly>
						</div>						
						<div class="modal-footer">
							<a href="RadSaBazomProfesora.php" id="link">Odustani</a>
							<!--<input type="button" class="btn btn-danger" onclick="obrisi()" value="Obriši"> -->
							<input type="submit" class="btn btn-danger" value="Delete">
						</div>
					</form>
				</div>
			</div>
		</div>
				<script>
			function povratak() {
				window.location="RadSaBazomProfesora.php";
			}	
		</script>
    </body>
</html>