<?php 
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: logIN.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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

.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}
.pagination li.active a:hover {        
	background: #0397d6;
}
.pagination li.disabled i {
	color: #ccc;
}
.pagination li i {
	font-size: 16px;
	padding-top: 6px
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
/* Custom checkbox */
.custom-checkbox {
	position: relative;
}
.custom-checkbox input[type="checkbox"] {    
	opacity: 0;
	position: absolute;
	margin: 5px 0 0 3px;
	z-index: 9;
}
.custom-checkbox label:before{
	width: 18px;
	height: 18px;
}
.custom-checkbox label:before {
	content: '';
	margin-right: 10px;
	display: inline-block;
	vertical-align: text-top;
	background: white;
	border: 1px solid #bbb;
	border-radius: 2px;
	box-sizing: border-box;
	z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	content: '';
	position: absolute;
	left: 6px;
	top: 3px;
	width: 6px;
	height: 11px;
	border: solid #000;
	border-width: 0 3px 3px 0;
	transform: inherit;
	z-index: 3;
	transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
	border-color: #03A9F4;
	background: #03A9F4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
	color: #b8b8b8;
	cursor: auto;
	box-shadow: none;
	background: #ddd;
}
/* Modal styles */
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

#del {
	margin:10px;
}
#user {
	float: right;
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
</style>


<?php 
	include '../../KonekcijaSaBazom.php';
	$tabela = new KonekcijaSaBazom();

	$tempPage = 1;
	$studentInput = "";
	$ID = $ime = $prezime = $email = $studije = $sifra = "";
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{ 
		if(isset($_GET['tempPage'])) {
			$tempPage = $_GET['tempPage'];
		}
	} 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['studentInput'])) {
			$studentInput = $_POST['studentInput'];
		} else {
			$studentInput = "";
		}
		
		if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['email']) && isset($_POST['studije'])) {
			$ime = $_POST['ime'];
			$prezime = $_POST['prezime'];
			$email = $_POST['email'];
			$studije = $_POST['studije'];
			$sifra = $_POST['sifra'];
			$indeks = $_POST['indeks'];
            // ovo treba se izmeni
			$tabela->Insert($email, $ime, $prezime, $indeks, $studije, $sifra);
		}		
	}
?>
</head>
<body>
<!-- stranicni meni-->
<div class="sideNav">	
	<!-- ovde da se ubace konkretni linkovi ka kursevima ... -->
	<a href="#" class="closeBtn">×</a>
	<a href="RadSaBazomStudenata.php">Rad sa bazom studenata</a>
	<a href="../profesor/RadSaBazomProfesora">Rad sa bazom profesora</a>
	<a href="#">...</a>
    <a href="../../pocetna_strana.php">Pocetna strana</a>
	<a href="../../proces.php?odjava">Odjava</a>
	<!-- ................................................... -->
</div>
<div class="main-content">
	<div id="user"> 
		<!--<a id="logout" href="logOut.php"> Izloguj se</a>
		<button class="btn btn-default" onclick="window.location.href = 'logOut.php';"> Izloguj se </button>
        -->
    </div>
	
	<div class="header">
		<p id="header_p"><img src="../../logo_moodle2.png" /></p>
	</div>

	<div class="navbar">
		<div class="dropdown">
		<!-- sa klikom da dugme se otvara stranicni meni-->
			<button class="openSideNav"><i class="fa fa-align-justify"></i></button>
		</div>
		<!-- link koje ce da baca na pocetnu stranu od trenutno ulogovanog korisnika -->
		<a class="right_side" href="../../pocetna_strana.php"><i class="fa fa-home"></i></a>
	</div>
	
	<div class="userContent">
		<div class="container-xl">
			<div class="table-responsive">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-6">
								<h2>Rad sa <b>Studentima</b></h2>
							</div>							
							<div class="col-sm-6">
								<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Dodaj Novog Studenta</span></a>
								<!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Obriši</span></a>	-->					
							</div>
						</div>
					</div>
					<div>
						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<label for="fname">Pretraži studenta : </label>
							<input type="text" id="fname" name="studentInput" value="<?php echo $studentInput; ?>">	
							<button type="submit" ><i class="fa fa-search" aria-hidden="true"></i> </button>						
						</form>
					</div>
					<table class="table table-striped table-hover">
						<thead>
						
							<tr> 
								<th>Email</th>
								<th>Ime</th>
								<th>Prezime</th>								
								<th>Indeks</th>
								<th>Sifra</th>
								<th>Godina Studija</th>
								<th>Akcije</th>
							</tr>
						</thead>
						<tbody>
										
							 <?php 
								$tabela->insertStudentsIntoTable($studentInput, $tempPage);															
								
							 ?>
						</tbody>
					</table>
					<div class="clearfix"> 
						<?php echo $tabela->doPagination($tempPage); ?>
					</div>
				</div>
			</div>        
		</div>
		<!-- Edit Modal HTML -->
		<div id="addEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
						<div class="modal-header">						
							<h4 class="modal-title">Dodaj studenta</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">	
                            <div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email" required>
							</div>	
							<div class="form-group">
								<label>Ime</label>
								<input type="text" class="form-control" name="ime" required>
							</div>
							<div class="form-group">
								<label>Prezime</label>
								<input type="text" class="form-control" name="prezime" required>
							</div>
							<div class="form-group">
								<label>Indeks</label>
								<input type="text" class="form-control" name="indeks" required>
							</div>
							<div class="form-group">
								<label>Godina Studija</label>
								<input type="text" class="form-control" name="studije" required>
							</div>
							<div class="form-group">
								<label>Sifra</label>
								<input type="text" class="form-control" name="sifra" required>
							</div>	
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-success" value="Add">
						</div>
					</form>
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