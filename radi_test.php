<!DOCTYPE html>
<?php
    session_start();
?>
<?php
    $email=$_SESSION['idKorisnika'];
    $korisnik=$_SESSION['tipKorisnika'];
    $kurs=$_SESSION['kurs'];
    $uradjen=$_SESSION['uradjen'];
    if($email==null || $korisnik==null || $kurs==null || $uradjen==null)
    {
        header("location: login.php");
        exit();
    }
    if($korisnik!="student")
    {
        header("location: login.php");
        exit();
    }
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
    $result= $mysqli->query("SELECT * FROM radio INNER JOIN test ON radio.sifra_kursa=test.sifra_kursa AND radio.broj_testa=test.broj_testa WHERE radio.email_student='$email' AND test.sifra_kursa='$kurs' ORDER BY test.broj_testa DESC LIMIT 1") or die($mysqli->error);
    $row= $result->fetch_assoc();
    if($row!=null)
    {
        $bodovi_konacno=$row['bodovi'];
        if(!($row['status']=="omogucen" && ($row['bodovi']==-1.0 || ($row['bodovi']!=-1 && $uradjen=='da'))))
        {
          header("location: kurs.php");
          exit();
        }
    }
    else
    {
      $error="Nije dostupan nijedan test";
      header("location: kurs.php");
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

        #uneseno{
          margin: auto;
          width: 55%;
          margin-bottom: 20px;
          margin-top: 20px;
          padding-top: 20px;
          background-color: white;
          border: 5px solid #333;
          float: center;
          content: "";
          display: table;
          clear: both;
        }
        #uneseno .polje1{
          float: left;
          width:100%;
          padding-top: 20px;
          border-top: 1px solid black;
          border-bottom: 1px solid black;
        }

        #uneseno .polje2{
          float: left;
          width:100%;
          padding-top: 5px;
          padding-left:5px;
          margin-bottom: 20px;
          border-top: 1px solid black;
          border-bottom: 2px solid black;
        }

        #uneseno .zadatak{
          float: left;
        }

        #uneseno .poeni{
          float: right;
        }

        #uneseno .kraj{
          float: left;
          width:100%;
          margin-bottom:20px;
          padding-top: 5px;
          padding-left:5px;
        }

        #uneseno h3{
          margin-left:30px;
          margin-right:30px;
          margin-bottom:20px;
        }
    </style>
    <script>
    <?php
      $greska=$_SESSION['greska_pitanje'];
      if($greska!="")
      {
    ?>
        alert(<?php echo "\"" .$greska. "\""; ?>);
    <?php   
      }
      $_SESSION['greska_pitanje']="";
    ?>
    </script>   
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
      if($uradjen=="da")
      {
    ?>
        <div id="uneseno">
          <h3>Ostvaren broj bodova: <?php echo($bodovi_konacno); ?></h3>
        </div>
    <?php
      }
    ?>
    <?php
      $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
      $mysqli -> set_charset("utf8");
      $result= $mysqli->query("SELECT * FROM test INNER JOIN kurs ON test.sifra_kursa=kurs.sifra_kursa WHERE test.sifra_kursa='$kurs' AND test.status='omogucen'") or die($mysqli->error);
      $row= $result->fetch_assoc();
      $predmet=$row['naziv'];
      $test=$row['broj_testa'];
    ?>   
    <div id="uneseno">
      <h3><?php echo($test); ?>. test iz predmeta <?php echo($predmet); ?></h3>
      <hr style=" text-align:center; border-top: 2px solid black">
      <?php
        $kurs=$_SESSION['kurs'];
        $test=$_SESSION['test'];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli -> set_charset("utf8");
        $result= $mysqli->query("SELECT * FROM pitanje WHERE pitanje.sifra_kursa='$kurs' AND pitanje.broj_testa=$test") or die($mysqli->error);
        $br=1;
        while($row = $result->fetch_assoc()):
          $pitanje=$row['broj_pitanja'];
          $tekstpitanja=$row['tekst_pitanja'];
          $poeni=$row['poeni'];
      ?>
          <form action="proces.php" method="POST">
          <div class="zadatak">
            <p style="margin-left:5px;" ><?php echo($br); ?>.</p>
          </div>
          <div class="poeni">
            <p style="margin-right:5px; color: gray;" ><?php echo($poeni); ?></p>
          </div>
            <input type="hidden" id="pitanjebr<?php echo($pitanje); ?>" name="pitanjebr<?php echo($pitanje); ?>" value="<?php echo($pitanje); ?>">
            <p name="tekst_uneseno" style="display: block; margin-left:auto; margin-right:auto; width: 90%; "><?php echo($tekstpitanja); ?><?php if($uradjen=="da" && strpos($_SESSION['pitanja_student'],"_".$pitanje."_")===FALSE): ?><i class="material-icons" style="color: red;">close</i><?php endif; ?> <?php if($uradjen=="da" && strpos($_SESSION['pitanja_student'],"_".$pitanje."_")!==FALSE): ?><i class="material-icons" style="color: green;">check</i><?php endif; ?></p>
          <div class="polje2">
            <?php
              $resultodg= $mysqli->query("SELECT * FROM odgovor WHERE odgovor.sifra_kursa='$kurs' AND odgovor.broj_testa=$test AND odgovor.broj_pitanja=$pitanje") or die($mysqli->error);
              $brodgovor_uneseno=0;
              while($rowodg = $resultodg->fetch_assoc()):
                $odgovor=$rowodg['broj_odgovora'];
                $tekstodgovora=$rowodg['tekst_odgovora'];
                $tacan=$rowodg['tacan'];
                $brodgovor_uneseno++;
            ?>
                  <input type="checkbox" id="odgovor<?php echo($odgovor); ?>" name="odgovor<?php echo($odgovor); ?>" value="tacno" style="margin-left:50px;" <?php if($uradjen=="da" && strpos($_SESSION['odgovori_student'],"_".$odgovor."_")!==FALSE): ?>checked<?php endif; ?>>
                  <label for="odgovor<?php echo($odgovor); ?>" style="<?php if($uradjen=="da" && $tacan==1): ?>background-color: green;<?php endif; ?> <?php if($uradjen=="da" && $tacan==0 && strpos($_SESSION['odgovori_student'],"_".$odgovor."_")!==FALSE): ?>background-color: red;<?php endif; ?>"><?php echo($tekstodgovora); ?></label><br>
            <?php endwhile ;?>
          </div>
            <input type="hidden" id="brodgovor<?php echo($pitanje); ?>" name="brodgovor<?php echo($br); ?>" value="<?php echo($brodgovor_uneseno); ?>">
          <?php $br++ ; ?>
      <?php 
        endwhile ;
      ?>
            <input type="hidden" id="sva_pitanja" name="sva_pitanja" value="<?php echo($br-1); ?>">
          <div class="kraj">
            <?php if($uradjen=="ne"): ?>
                <button class="btn btn-success" type="submit" name="predaj_test"  style="display: block; margin-left:auto; margin-right:auto; width: 150px; height: 50px;">Predaj test</button>
            <?php endif; ?>
            <?php if($uradjen=="da"): ?>
                <button class="btn btn-success" type="submit" name="nazad_na_kurs"  style="display: block; margin-left:auto; margin-right:auto; width: 150px; height: 50px;">Nazad</button>
            <?php endif; ?>
          </div>
          </form>
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