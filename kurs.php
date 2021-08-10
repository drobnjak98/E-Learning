<!DOCTYPE html>
<?php
    session_start();
    if (isset($_GET['pocetna_kurs'])) {
    $_SESSION['kurs'] =  $_GET['pocetna_kurs'];
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

#tekst{
    margin: auto;
    width: 40%;
    margin-bottom: 20px;
    margin-top: 20px;
    padding-top: 15px;
    background-color: white;
    border: 5px solid #333;
    float: center;
    content: "";
    display: table;
    clear: both;
}

#tekst h3{
    margin-left:25px;
    margin-right:30px;
    margin-bottom:20px;
}

#tekst p{
    margin-left: 10px;
}

#tekst ul{
    display: block;
    margin-left: auto;
    margin-right: auto;
}

#tekst ul li{
}

#tekst ul li a{
    text-decoration: none;
    font-size: 20px;
    color: black;
}

#tekst ul li a:hover{
    color: rgb(46, 218, 195);
}

.wrapper {
    margin: 24px 80px;
    height: auto;
    padding: 48px;
    border-radius: 15px;
    box-shadow: 0px 0px 12px 7px rgba(61,55,76,0.64);
}
.opis {
  margin: 24px 15px;
  margin
  position: relative;
  height: auto;
  word-wrap: break-word;
}
.sekcija {
  border-bottom: 1px solid gray;
  padding: 24px 0px;
}
.lista {
    display: flex;
    flex-direction: column;
}
.listItem {
    padding-top: 12px;
}
.fa {
    padding-top:24px;
    font-size: 20px;
}
/* ...... css za popup tabellu*/

.my-custom-scrollbar {
position: relative;
height: 200px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}

/*.................. */
</style>
<script>
    <?php
        $greska=$_SESSION['student_kurs_sifra_greska'];
        if($greska!="")
        {
    ?>
            alert(<?php echo "\"" .$greska. "\""; ?>);
    <?php   
        }
        $_SESSION['student_kurs_sifra_greska']="";
    ?>
</script>  
</head>
<body>
<!-- stranicni meni-->
<div class="sideNav">   
    	<!-- ovde da se ubace konkretni linkovi ka kursevima ... -->
        <a href="#" class="closeBtn">×</a>
        <br>
	<a href="pocetna_strana.php">Pocetna strana</a>        
<?php 
        if($_SESSION["tipKorisnika"] != 'admin') {
?>
        <a href="profill.php">Profil</a><?php
        }
?>
<?php 
        if($_SESSION["tipKorisnika"] == 'admin') {
?>
        <a href="admin/student/RadSaBazomStudenata.php">Rad sa bazom studenata</a>
        <a href="admin/profesor/RadSaBazomProfesora.php">Rad sa bazom profesora</a>
        <a href="admin/kurs/RadSaBazomKurseva.php">Rad sa bazom kurseva</a>
<?php
        }
?>
        <a href="proces.php?odjava">Odjava</a>
    <!-- ................................................... -->
</div>
<div class="main-content">
    
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
</div>
<!-- dodato za test-->
<?php
        $sifra=$_SESSION['kurs'];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli -> set_charset("utf8");
        $result= $mysqli->query("SELECT * FROM test WHERE sifra_kursa='$sifra' ORDER BY broj_testa DESC LIMIT 1") or die($mysqli->error);
        $row= $result->fetch_assoc();
        if($row!=null)
        {
            $_SESSION['test']=$row['broj_testa'];
            $status=$row['status'];
            $poeni=$row['poeni_svi'];
        }
        else
        {
            $_SESSION['test']=0;
            $status="onemogucen";
            $poeni=0.0;
        }    
?>
<!-- kraj dodatog za test-->
<?php
    if($_SESSION["tipKorisnika"] == "student")  // pocetak student sesije
    {
?>
<div class='wrapper'>
<?php
$sifra = $_SESSION['kurs']; 
$mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
$mysqli -> set_charset("utf8");

$result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$sifra'") or die($mysqli->error);
while($row = $result->fetch_assoc())
{
?>
<div style="display: flex; justify-content: space-between">
    <h3><?php echo($row['naziv']); ?></h3>
    </div>
   <!-- <div contentEditable="true" class="opis"><?php //echo($row['opis']); ?></div> -->
    <!-- dodato za test-->
    <div>
    <?php
            $email=$_SESSION['idKorisnika'];
            $test=$_SESSION['test'];
            $result= $mysqli->query("SELECT * FROM radio WHERE sifra_kursa='$sifra' AND broj_testa=$test AND email_student='$email'") or die($mysqli->error);
            $row= $result->fetch_assoc();
            $bodovi=$row['bodovi'];
            if($status=="omogucen" && ($bodovi==-1 || $bodovi==null))
            {
    ?>
                <form action="proces.php" method="POST">
                    <button class="btn-primary" style="border-radius: 5px;" type="submit" name="pokreni_test"> Pokreni test </button>
                </form>
    <?php
            }
    ?>       
    </div> 
    <br>
    <div>
        <a href="rezultati_test.php"><button class="btn-primary" style="border-radius: 5px;">Rezultati</button></a>
    </div>   
    <br>    
    <!-- kraj dodatog za test-->
<?php        
    }
} // kraj student sesije 
?>

<?php
    if($_SESSION["tipKorisnika"] == "profesor") //pocetak profesor sesije
    {
    ?>
    <div class='wrapper'>
    <?php
    $sifra = $_SESSION['kurs']; 
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
    $mysqli -> set_charset("utf8");
    
    $result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$sifra'") or die($mysqli->error);
    while($row = $result->fetch_assoc())
    {
    ?>

    <div style="display: flex; justify-content: space-between">
        <h3><?php echo($row['naziv']); ?></h3>
        <div>
        <input class="btn-danger" style="border-radius: 5px;" form="files-upload" type='submit' name='submit' value='Sacuvaj' onclick="return confirm('Da li ste sigurni da zelite da sacuvate promene?')">
        </div>
        </div>
    <!--    <div contentEditable="true" class="opis"><?php //echo($row['opis']); ?></div> -->
        <div style=" float:right; ">
        </div>
        <!-- dodato za test-->
        <div>
        <?php
            if($status=="onemogucen" || ($poeni==0.0 && $status=="kreiran"))
            {
        ?>
                <form action="proces.php" method="POST">
                    <input type="hidden" name="status" value="<?php echo $status;?>">
                    <button class="btn-primary" style="border-radius: 5px;" type="submit" name="kreiran_test"> Napravi test </button>
                </form>
        <?php
            }
        ?>
        <?php
            if($poeni>0.0 && $status=="kreiran")
            {
        ?>
                <form action="proces.php" method="POST">
                    <button class="btn-primary" style="border-radius: 5px;" type="submit" name="omoguci_test"> Omoguci test </button>
                </form>
        <?php
            }
        ?>
        <?php
            if($status=="omogucen")
            {
        ?>
                <form action="proces.php" method="POST">
                    <button class="btn-primary" style="border-radius: 5px;" type="submit" name="onemoguci_test"> Onemoguci test </button>
                </form>
        <?php
            }
        ?>  
        </div>  
        <br>
        <div>
            <a href="rezultati_test.php"><button class="btn-primary" style="border-radius: 5px;">Rezultati</button></a>
        </div>   
        <br>       
        <!-- kraj dodatog za test-->
    <?php        
    } 
 } // kraj profesor sesije 
?>

<?php
    if($_SESSION["tipKorisnika"] == "admin") //pocetak admin sesije
    {
    ?>
    <div class='wrapper'>
    <?php
    $sifra = $_SESSION['kurs']; 
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
    $mysqli -> set_charset("utf8");
    
    $result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$sifra'") or die($mysqli->error);
    while($row = $result->fetch_assoc())
    {
    ?>
    <div style="display: flex; justify-content: space-between">
        <h3><?php echo($row['naziv']); ?></h3>
        <div>
        <input class="btn-danger" style="border-radius: 5px;" form="files-upload" type='submit' name='submit' value='Sacuvaj' onclick="return confirm('Da li ste sigurni da zelite da sacuvate promene?')">

        </div>
        </div>
   <!--     <div class="opis">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur mollitia reiciendis quia sunt tempore vel totam magni, facere voluptatem nostrum, eum nobis corporis, harum quo delectus aliquid fugiat dolorum possimus. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis quo porro sequi repudiandae ab, sit, nemo architecto sunt fuga debitis laborum unde! Iusto nam ipsa enim fugiat quisquam? Quod, ea! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum aliquid assumenda fugit beatae ratione? Et itaque, iusto quia libero rerum veniam officiis dignissimos nisi, in expedita autem minus consequuntur id!</div> -->
        <div style=" float:right; ">
        </div>
        <!-- dodato za test -->
        <div>
            <a href="rezultati_test.php"><button class="btn-primary" style="border-radius: 5px;">Rezultati</button></a>
        </div>
        <br>  
        <!-- kraj dodatog za test -->
        <?php        
    } 
 } // kraj admin sesije 
?>

<?php
    if(($_SESSION["tipKorisnika"] == "profesor" || $_SESSION["tipKorisnika"] == "admin") && isset($_POST['submit'])){
        //uciniti fajl vidljivim
        if(isset($_POST['checkboxShow'])){
            $show_checkboxes = $_POST['checkboxShow'];
            if(!empty($show_checkboxes))
            {
                $number_of_checkboxes = count($show_checkboxes);
                for($i=0; $i < $number_of_checkboxes; $i++)
                {
                    $current_checkbox = $show_checkboxes[$i];
                    $update_checkbox="UPDATE fajl SET vidljivost='1' WHERE id='$current_checkbox'";
                    mysqli_query($mysqli,$update_checkbox);
                }
            }
        }

        //uciniti fajl nevidljivim
        if(isset($_POST['checkboxHide'])){
            $hide_checkboxes = $_POST['checkboxHide'];
            if(!empty($hide_checkboxes))
            {
                $number_of_checkboxes = count($hide_checkboxes);
                for($i=0; $i < $number_of_checkboxes; $i++)
                {
                    $current_checkbox = $hide_checkboxes[$i];
                    $update_checkbox="UPDATE fajl SET vidljivost='0' WHERE id='$current_checkbox'";
                    mysqli_query($mysqli,$update_checkbox);
                }
            }
        }

        //brisanje fajlova
        if(isset($_POST['checkboxDelete'])){
            $delete_checkboxes = $_POST['checkboxDelete'];
            if(!empty($delete_checkboxes))
            {
                $number_of_checkboxes = count($delete_checkboxes);
                for($i=0; $i < $number_of_checkboxes; $i++)
                {
                    $current_checkbox = $delete_checkboxes[$i];
                    $delete_checkbox="DELETE FROM fajl WHERE id='$current_checkbox'";
                    mysqli_query($mysqli,$delete_checkbox);
                }
            }
        }

        //upload fajlova
        for ($i=0; $i < 15; $i++) {
        $result = $mysqli->query("SELECT * FROM fajl WHERE sifra_kursa='$sifra' AND id_sekcije='$i' ORDER BY redni_broj DESC LIMIT 1") or die($mysqli->error);
        $row = $result->fetch_assoc();

            $count_files = count($_FILES['files'.$i]['name']);
            for ($j=0; $j < $count_files; $j++) {
                $file_name = $_FILES['files'.$i]['name'][$j];
                $file_tmp_name=$_FILES['files'.$i]['tmp_name'][$j];
                $file_error=$_FILES['files'.$i]['error'][$j];
                $file_ext=explode('.',$file_name);
                $file_act_ext=strtolower(end($file_ext));
                if($file_error===0){
                    $file_random_name=uniqid('',true).".".$file_act_ext;
                    $file_dest="fajlovi/$file_random_name";
                    move_uploaded_file($file_tmp_name,$file_dest);

                    if(empty($row))
                        $redni_broj = $j;
                    else $redni_broj = $row['redni_broj'] + 1 + $j;

                    $files_insert = "INSERT INTO fajl (id, naziv, lokacija, tip_fajla, sifra_kursa, id_sekcije, redni_broj, vidljivost) VALUES (0, '$file_name', '$file_dest', '$file_act_ext', '$sifra', '$i', '$redni_broj', 0);";
                    mysqli_query($mysqli,$files_insert);
                }
            }
        }        
    }
?>
<?php
    //forma ce biti prikazana samo profesoru i adminu
    if($_SESSION["tipKorisnika"] == "profesor" || $_SESSION["tipKorisnika"] == "admin"){
?>
        <form id="files-upload" method='post'action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype='multipart/form-data'>
<?php
    }
?>
<?php
    //postavljanje fajlova i opcija po nedeljama
    for ($i=0; $i < 15; $i++) {

        if ($i == 0) {
            echo '<div class="sekcija" style="border-top: 1px solid gray;">';
        }
        else
            echo '<div class="sekcija">';
        echo '<h4>Nedelja '.($i+1).'</h4>
                <ul class="lista" >';

        $result = $mysqli->query("SELECT * FROM fajl WHERE sifra_kursa='$sifra' AND id_sekcije='$i' ORDER BY redni_broj ASC") or die($mysqli->error);
        while($row = $result->fetch_assoc()){
            if (!($_SESSION["tipKorisnika"] == "student" && $row['vidljivost']==0)) {
                echo   '<li class="fa">
                        <div id="file-div'.$row['id'].'" style="display: inline-block; padding: 5px;">';

                    //pomocna checkbox polja za izmene
                    if($_SESSION["tipKorisnika"] == "profesor" || $_SESSION["tipKorisnika"] == "admin"){
                        echo '<input style="display: none;" id="checkboxShowId'.$row['id'].'" type="checkbox" name="checkboxShow[]" value="'.$row['id'].'" ';
                        echo ($row['vidljivost']==1) ? 'checked' : '';
                        echo '/>
                        <input style="display: none;" id="checkboxHideId'.$row['id'].'" type="checkbox" name="checkboxHide[]" value="'.$row['id'].'" ';
                        echo ($row['vidljivost']==0) ? 'checked' : '';
                        echo '/>
                        <input style="display: none;" id="checkboxDeleteId'.$row['id'].'" type="checkbox" name="checkboxDelete[]" value="'.$row['id'].'" />';
                    }

                    //link ka fajlu - studentu se ne prikazuju nevidljivi fajlovi
                        echo '<a id="file-link'.$row['id'].'" style="opacity: ';
                        echo ($row['vidljivost']==0) ? 0.33 : 1;
                        echo '" href="'.$row['lokacija'].'">
                            <span class="fas fa-file"></span> '.$row['naziv'].'
                        </a>';

                    //tasteri za izmene
                    if($_SESSION["tipKorisnika"] == "profesor" || $_SESSION["tipKorisnika"] == "admin"){
                        echo '<button id="btn-file-show'.$row['id'].'" type="button" class="btn-primary" style="';
                        if ($row['vidljivost']==1) echo 'display: none; ';
                        echo 'margin-left:50px; border-radius: 5px;" id="delete'.$i.'" onclick="setFileDivBgColor(\''.$row['id'].'\'); showFileLink(\''.$row['id'].'\');">
                            <span class="fas fa-eye"></span>
                        </button>                        
                        <button id="btn-file-hide'.$row['id'].'" type="button" class="btn-primary" style="';
                        if ($row['vidljivost']==0) echo 'display: none; ';
                        echo 'margin-left:50px; border-radius: 5px;" id="delete'.$i.'" onclick="setFileDivBgColor(\''.$row['id'].'\'); hideFileLink(\''.$row['id'].'\');">
                            <span class="fas fa-eye-slash"></span>
                        </button>
                        <button id="btn-file-delete'.$row['id'].'" type="button" class="btn-danger" style="margin-left:5px; border-radius: 5px;" id="delete'.$i.'" onclick="setFileDivBgColor(\''.$row['id'].'\'); deleteFileLink(\''.$row['id'].'\');">
                            <span class="fas fa-trash"></span>
                        </button>
                        <button id="btn-file-restore'.$row['id'].'" type="button" class="btn-success" style="display: none; margin-left:5px; border-radius: 5px;" id="delete'.$i.'" onclick="setFileDivBgColor(\''.$row['id'].'\'); restoreFileLink(\''.$row['id'].'\');">
                            <span class="fas fa-undo"></span>
                        </button>';
                    }
                    echo '</div>
                    </li>';
            }
        }
        if($_SESSION["tipKorisnika"] == "profesor" || $_SESSION["tipKorisnika"] == "admin"){
            echo   '<li class="fa">
                        <input type="file" name="files'.$i.'[]" id="files'.$i.'" multiple>
                    </li>';
        }
                echo '<ul>
            </div>';
    }
    if($_SESSION["tipKorisnika"] == "student")
    {
        echo '<button onclick="kursOdjava()" class="btn-primary" style="border-radius: 5px; display: block; margin-left: auto; margin-right:auto; margin-top:50px;">Odjavi me sa kursa</button>';
    }
?>

<?php
    if($_SESSION["tipKorisnika"] == "profesor" || $_SESSION["tipKorisnika"] == "admin"){
?>
        </form>
<?php
    }
    if($_SESSION["tipKorisnika"] == "profesor")
    {
        echo '<div style="text-align: center; margin-top: 20px"> <a href="#addEmployeeModal" class="btn btn-primary" data-toggle="modal"><span>Prikazi studente sa predmeta</span></a></div>';
    }
    if($_SESSION["tipKorisnika"] == "profesor")
    {
        echo '<button onclick="kursKrajPredavanja()" class="btn-primary" style="border-radius: 5px; display: block; margin-left: auto; margin-right:auto; margin-top:50px;">Izbaci me iz liste predavača</button>';
    }
?>
<!--Kraj wraper-a-->
</div>

<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">

                        <div class="modal-header">						
							<h4 class="modal-title">Dodaj kurs</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>

                        <div class="modal-body">
                            <table class="table table-bordered table-striped table-sm ">
                            <thead>
                                <tr>
                                <th scope="col">Ime:</th>
                                <th scope="col">Prezime:</th>
                                <th scope="col">E-mail:</th>                                
                                <th scope="col">Godina studija:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        include './KonekcijaSaBazom.php';
                                        $tabela = new KonekcijaSaBazom();
                                        $tabela->prikazStudenata($_SESSION['kurs']);           
                                ?>
                            </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
							<input type="button" class="btn btn-success" data-dismiss="modal" value="Izlaz">
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

function showFileLink(file_link_id) {
    var currentFileLink = document.getElementById('file-link'+file_link_id);
    currentFileLink.style.opacity = "1.0";

    document.getElementById('btn-file-show'+file_link_id).style.display = "none";
    document.getElementById('btn-file-hide'+file_link_id).style.display = "";

    document.getElementById('checkboxShowId'+file_link_id).checked = true;
    document.getElementById('checkboxHideId'+file_link_id).checked = false;
}
function hideFileLink(file_link_id) {
    var currentFileLink = document.getElementById('file-link'+file_link_id);
    currentFileLink.style.opacity = "0.33";

    document.getElementById('btn-file-hide'+file_link_id).style.display = "none";
    document.getElementById('btn-file-show'+file_link_id).style.display = "";

    document.getElementById('checkboxShowId'+file_link_id).checked = false;
    document.getElementById('checkboxHideId'+file_link_id).checked = true;
}
function deleteFileLink(file_link_id) {
    var currentFileLink = document.getElementById('file-link'+file_link_id);
    currentFileLink.style.color = "red";
    currentFileLink.style.textDecoration = "line-through";

    document.getElementById('btn-file-delete'+file_link_id).style.display = "none";
    document.getElementById('btn-file-restore'+file_link_id).style.display = "";

    document.getElementById('checkboxDeleteId'+file_link_id).checked = true;
}
function restoreFileLink(file_link_id) {
    var currentFileLink = document.getElementById('file-link'+file_link_id);
    currentFileLink.style.color = "";
    currentFileLink.style.textDecoration = "";

    document.getElementById('btn-file-restore'+file_link_id).style.display = "none";
    document.getElementById('btn-file-delete'+file_link_id).style.display = "";

    document.getElementById('checkboxDeleteId'+file_link_id).checked = false;
}
function setFileDivBgColor(file_link_id) {
    var currentFileDiv = document.getElementById('file-div'+file_link_id);
    currentFileDiv.style.backgroundColor = "silver";
}
function kursOdjava() 
{
    if (window.confirm("Želite da se odjavite sa kursa? Jeste li sigurni?")) 
    {
        location.replace("proces.php?kurs_odjava_dugme=<?php echo($_SESSION["kurs"]) ?>");
    }
}
function kursKrajPredavanja() 
{
    if (window.confirm("Želite da prestanete da predajete na ovom kursu? Jeste li sigurni?")) 
    {
        location.replace("proces.php?kurs_kraj_predavanja_dugme=<?php echo($_SESSION["kurs"]) ?>");
    }
}

</script>
</body>
</html>