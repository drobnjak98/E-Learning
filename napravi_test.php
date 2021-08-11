<!DOCTYPE html>
<?php
    session_start();

        include './KonekcijaSaBazom.php';
    $tabela = new KonekcijaSaBazom();
?>
<?php
    $email=$_SESSION['idKorisnika'];
    $korisnik=$_SESSION['tipKorisnika'];
    $kurs=$_SESSION['kurs'];
    $test=$_SESSION['test'];
    if($email==null || $korisnik==null || $kurs==null || $test==null)
    {
        header("location: login.php");
        exit();
    }
    if($korisnik!="profesor")
    {
        header("location: login.php");
        exit();
    }
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
    $result= $mysqli->query("SELECT * FROM test WHERE sifra_kursa='$kurs' ORDER BY broj_testa DESC LIMIT 1") or die($mysqli->error);
    $row= $result->fetch_assoc();
    if($row!=null)
    {
        if(!($row['status']=="kreiran" && $row['poeni_svi']==0.0))
        {
          header("location: kurs.php");
          exit();
        }
    }
    else
    {
      $error="Prvo napraviti test";
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
        background-color: rgb(245, 239, 239);
        overflow-x: hidden;
        padding-top: 60px;
        transition: 0.5s;
      }
      .sideNav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 18px;
        font-style: italic;
        color: #368B11;
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

        #tekst{
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

        #tekst .polje1{
          float: left;
          width:40%;
          margin-left:40px;
          margin-bottom:20px;
          padding-top: 20px;
          padding-left:5px;
        }

        #tekst .polje2{
          float: left;
          width:100%;
          margin-bottom:20px;
          padding-top: 5px;
          padding-left:5px;
        }

        #tekst h3{
          margin-left:30px;
          margin-right:30px;
          margin-bottom:30px;
        }
        #tekst p{
          margin-left:40px;
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
          margin-bottom:20px;
          padding-top: 20px;
          padding-left:60px;
        }

        #uneseno .polje2{
          float: left;
          width:100%;
          margin-bottom:20px;
          padding-top: 5px;
          padding-left:5px;
          padding-bottom:10px;
          border-bottom: 1px solid black;
        }

        #uneseno .cuvanje{
          float: left;
          width:100%;
          margin-bottom:20px;
          padding-top: 5px;
          padding-left:5px;
        }

        #uneseno h3{
          margin-left:30px;
          margin-right:30px;
          margin-bottom:30px;
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

        <a  class="clk">Moji kursevi <b>></b> </a> 
        <ul class="sub">
            <?php echo $tabela->prikazKurseveNav($_SESSION["idKorisnika"], $_SESSION["tipKorisnika"]); ?>
        </ul>

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
      $result= $mysqli->query("SELECT * FROM test INNER JOIN kurs ON test.sifra_kursa=kurs.sifra_kursa WHERE test.sifra_kursa='$kurs' AND test.poeni_svi=0.0") or die($mysqli->error);
      $row= $result->fetch_assoc();
      $predmet=$row['naziv'];
      $test=$row['broj_testa'];
    ?>
    <div id="tekst">
      <h3>Unos pitanja za <?php echo($test); ?>. test iz predmeta <?php echo($predmet); ?></h3>
      <p>Pitanje:</p>
      <form action="proces.php" method="POST">
        <div class="polje2">
          <textarea  name="tekst" rows=2  style="resize: none; display:block; margin-left:auto; margin-right:auto; width:90%;"></textarea>
        </div>
        <div class="polje1">
          <label for="quantityf">Broj poena:</label>
          <input type="number" id="quantityf" name="quantityf" min="0.01" max="30" value="0.01" step="0.01" style="width: 100px;">
        </div>
        <div class="polje1">
          <label for="quantity" style=" margin-bottom:5px;">Broj odgovora:</label>
          <input type="number" id="quantity" name="quantity" min="2" max="6" value="2" style="width: 100px; margin-bottom:5px;">
          <button class="btn btn-success" type="submit" name="podesi_broj_odgovora" style="margin-left:10px;"> Podesi </button>
        </div>
        <div class="polje2">
          <p>Odgovori (čekirati tačne):</p>
          <?php
            $odgovor=$_SESSION['odgovor'];
            for($i=1; $i<$odgovor+1; $i++ ):
          ?>
              <input type="checkbox" id="tacno" name="tacno<?php echo($i); ?>" value="tacno" style="margin-left:50px;"><br>
              <textarea name="odgovor<?php echo($i); ?>" rows=1 style="resize: none; margin-bottom:15px; margin-top:5px; display:block; margin-left:auto; margin-right:auto; width: 90%;"></textarea>
          <?php endfor; ?>
        </div>
        <div class="polje2">
          <button class="btn btn-success" type="submit" name="dodaj_pitanje"  style="display: block; margin-left:auto; margin-right:auto; width: 150px; height: 50px;"><i class="material-icons">&#xE147;</i>  Dodaj pitanje</button>
        </div>
      </form>
    </div>
    <div id="uneseno">
      <h3><?php echo($test); ?>. test iz predmeta <?php echo($predmet); ?></h3>
      <hr style=" text-align:center; border-top: 1px solid black">
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
            <input type="hidden" id="pitanjebr" name="pitanjebr" value="<?php echo($pitanje); ?>">
            <label for="tekst_uneseno" style="margin-left:5px;" ><?php echo($br); ?>.</label>
            <textarea name="tekst_uneseno" rows=2 style="resize: none; display: block; margin-left:auto; margin-right:auto; width: 90%; "><?php echo($tekstpitanja); ?></textarea>
            <div class="polje1">
              <label for="quantityf_uneseno">Broj poena:</label>
              <input type="number" id="quantityf_uneseno" name="quantityf_uneseno" min="0.01" max="30" value="<?php echo($poeni); ?>" step="0.01" style="width: 100px;">
              <button type="submit" name="izmeni_pitanje" class="edit" style=" margin-left:150px; margin-bottom: 5px; margin-right: 10px;" ><i class="material-icons" data-toggle="tooltip" >&#xE254;</i></a>
              <button type="submit" name="obrisi_pitanje" class="delete" style=" margin-left:150px; margin-bottom:5px; margin-right:10px;"><i class="material-icons" data-toggle="tooltip" >&#xE872;</i></button>
            </div>
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
                  <input type="checkbox" id="tacno_uneseno" name="tacno_uneseno<?php echo($odgovor); ?>" value="tacno_uneseno" style="margin-left:50px;" <?php if ($tacan==TRUE): ?> checked <?php endif; ?>><br>
                  <textarea name="odgovor_uneseno<?php echo($odgovor); ?>" rows=1 style="resize: none; margin-bottom:15px; margin-top:5px; display:block; margin-left:auto; margin-right:auto; width: 90%;"><?php echo($tekstodgovora); ?></textarea>
            <?php endwhile ;?>
            </div>
            <input type="hidden" id="brodgovor_uneseno" name="brodgovor_uneseno" value="<?php echo($brodgovor_uneseno); ?>">
          </form>
          <?php $br++ ; ?>
      <?php endwhile ;?>
      <div class="cuvanje">
        <?php if($br!=1): ?>
          <form action="proces.php" method="POST">
            <button class="btn btn-success" type="submit" name="sacuvaj_test"  style="display: block; margin-left:auto; margin-right:auto; width: 150px; height: 50px;">Sacuvaj test</button>
          </form>
        <?php endif; ?>
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
      var j = 0;
      let clk = document.querySelector(".clk");
      let list = document.querySelector(".sub");
      list.style.display = "none";

      clk.addEventListener("click", () => {
        //console.log("jeeeee");
        let list = document.querySelector(".sub");
        if(j == 1){	
          list.style.display = "none";
              clk.innerHTML = "Moji kursevi <b>></b>";
          j--;
        } else if(j == 0) {
          list.style.display = "block";
              clk.innerHTML = "Moji kursevi <b>\\/<b>";
          j++;
        }
      });
    </script>
  </body>
</html>