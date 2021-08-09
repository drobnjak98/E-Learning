<!DOCTYPE html>
<?php
    session_start();
?>
<?php
    $kurs=$_SESSION['kurs'];
    if($kurs==null)
    {
        header("location: login.php");
        exit();
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
        body
        {
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
        h3{
          margin: auto;
          margin-top:20px;
          float: center;
          content: "";
          display: table;
          clear: both;
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
          border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
          margin: 5px 0 0;
          font-size: 24px;
          margin: auto;
          float: center;
          content: "";
          display: table;
          clear: both;
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
    </style>  
  </head>
  <body>
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
			    <button class="openSideNav"><i class="fa fa-align-justify"></i></button>
		    </div>
		    <a class="right_side" href="#home"><i class="fa fa-home"></i></a>
	    </div>
    </div>
    <?php
      $kurs=$_SESSION['kurs'];
      $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
      $mysqli -> set_charset("utf8");
      $result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$kurs'") or die($mysqli->error);
      $row= $result->fetch_assoc();
      $predmet=$row['naziv'];
      $kursgdn=$row['godina'];
    ?>
    <div class="container-xl">
			<div class="table-responsive">
				<div class="table-wrapper">
					<div class="table-title">
						<h2>Rezultati testova iz predmeta <?php echo($predmet); ?></h2>
					</div>
					<table class="table table-striped table-hover">
						<thead>
						
							<tr> 
								<th>Indeks</th>
                <th>Godina upisa</th>
								<th>Ime</th>
								<th>Prezime</th>
            <?php
              $result= $mysqli->query("SELECT COUNT(broj_testa) AS testcnt FROM test WHERE sifra_kursa='$kurs'") or die($mysqli->error);
              $row = $result->fetch_assoc();
              $testcnt=$row['testcnt'];
              $result= $mysqli->query("SELECT * FROM test WHERE sifra_kursa='$kurs'") or die($mysqli->error);
              while($row = $result->fetch_assoc()):
                $testh=$row['broj_testa'];
            ?>
                <th><?php echo($testh); ?>. test</th>
            <?php
              endwhile;
            ?>
                <th>Ukupno</th>
							</tr>
						</thead>
						<tbody>
          <?php
            $result= $mysqli->query("SELECT * FROM student INNER JOIN prati ON student.email_student=prati.email_student WHERE student.godina=$kursgdn AND prati.sifra_kursa='$kurs' ORDER BY student.upis ASC, student.indeks ASC") or die($mysqli->error);
            while($row = $result->fetch_assoc()):
              $emailstud=$row['email_student'];
          ?>
              <tr>
                <td><?php echo($row['indeks']); ?></td>
                <td><?php echo($row['upis']); ?></td>
								<td><?php echo($row['ime_student']); ?></td>
								<td><?php echo($row['prezime_student']); ?></td>
            <?php
              for($i=1;$i<=$testcnt;$i++)
              {
                $results= $mysqli->query("SELECT * FROM student INNER JOIN radio ON student.email_student=radio.email_student WHERE student.email_student='$emailstud' AND radio.broj_testa=$i") or die($mysqli->error);
                $rows= $results->fetch_assoc();
                if($rows['bodovi']!=null && $rows['bodovi']!=-1)
                {
            ?>
                  <td><?php echo($rows['bodovi']); ?></td>
            <?php
                }
                else
                {
            ?>
                  <td>nije radio/la</td>
            <?php
                }
              }
            ?>
            <?php
              $results= $mysqli->query("SELECT SUM(bodovi) AS ukupno FROM student INNER JOIN radio ON student.email_student=radio.email_student WHERE student.email_student='$emailstud' AND radio.bodovi!=-1") or die($mysqli->error);
              $rows= $results->fetch_assoc();
              if($rows['ukupno']==null)
              {
            ?>
                <td>0</td>
            <?php
              }
              else
              {
            ?>
                <td><?php echo($rows['ukupno']); ?></td>
            <?php
              }
            ?>
              </tr>									
          <?php
            endwhile;
          ?>
						</tbody>
					</table>
				</div>
			</div>        
		</div>
    <button onclick="povratak()" class="btn-primary" style="border-radius: 5px; display: block; margin-left: auto; margin-right:auto; margin-top:50px;">Povratak na stranicu kursa</button>

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
      function povratak(){
        location.replace("kurs.php");
      }
    </script>
  </body>
</html>