<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">		
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
				background:  #DCDCDC;
				/*background-color: rgba(0,0,0,0.5) !important;*/
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
		$idErr = $staraErr = $novaErr = "";
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			include 'KonekcijaSaBazom.php';
        	$tabela=new KonekcijaSaBazom();
						
            $id = $_POST['id'];
			$staraSifra = $_POST['staraSifra'];
			$novaSifra = $_POST['novaSifra'];
			
		//	echo $novaSifra;
			
			$n = $tabela->PromenaSifre($id, $staraSifra, $novaSifra);
		//	echo $n;
			
            if($n == 0) {
                //uspesno promenjena sifra
				header('Location: logIN.php');
			} else if($n == 1){ 
                $staraErr = "* Pogrešili ste šifru!";
			} else if($n == 2) {
				$idErr = "* Unešeni mail ne postoji";
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
							<h4 class="modal-title">Promena sifre</h4>
							<button type="button" class="close" onclick="povratak()">&times;</button>
						</div>
						<div class="modal-body">					
							<div class="form-group">
								<label>Vaš email</label>
								<span id="greska"><?php echo $idErr;?></span>
								<input type="text" class="form-control"  name="id" required>
							</div>
							<div class="form-group">
								<label>Stara šifra</label>
								<span id="greska"><?php echo $staraErr;?></span>
								<input type="password" class="form-control"  name="staraSifra" required>
							</div>
							<div class="form-group">
								<label>Nova šifra</label>
								<input type="password" class="form-control"  name="novaSifra" required>
							</div>	
						</div>
						<div class="modal-footer">
							<a href="logIN.php" id="link">Odustani</a>
							<input type="submit" class="btn btn-info" value="Zacuvaj">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			function povratak() {
				window.location="logIN.php";
			}	
		</script>
</body>
</html>