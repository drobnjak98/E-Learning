<?php
    session_start();
?>

<?php
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));

    if(isset($_POST['dodaj_kurs_sifra']))
    {
        
        $sifra=$_POST['sifra'];
        $email=$_SESSION['idKorisnika'];
        $result= $mysqli->query("SELECT * FROM student WHERE email_student='$email'") or die($mysqli->error);
        $row= $result->fetch_assoc();
        $godina=$row['godina'];
        $result= $mysqli->query("SELECT * FROM kurs WHERE sifra_kursa='$sifra'") or die($mysqli->error);
        $row= $result->fetch_assoc();
        if($row!=null)
        {
            $results= $mysqli->query("SELECT * FROM prati WHERE sifra_kursa='$sifra' AND email_student='$email'") or die($mysqli->error);
            $rows= $results->fetch_assoc();
            if($rows==null)
            {
                if($row['godina']==$godina)
                {
                    $mysqli->query("INSERT INTO prati (email_student,sifra_kursa) VALUES ('$email','$sifra')");
                }
                else
                {
                    $_SESSION['student_kurs_sifra_greska']="Kurs se ne sluša na ovoj godini";
                }
            }
            else
            {
                $_SESSION['student_kurs_sifra_greska']="Već slušate ovaj kurs";
            }
        }
        else
        {
            $_SESSION['student_kurs_sifra_greska']="Uneta šifra ne odgovara nijednom postojećem kursu";
        }
        header("location: pocetna_strana.php");
    } 
?>

<?php

    if(isset($_GET['pocetna_kurs']))
    {
        
        $_SESSION['kurs']=$_GET['pocetna_kurs'];
        header("location: kurs.php");
    } 
?>

<?php
    if(isset($_GET['odjava']))
    {
        session_unset();
        session_destroy();
        header("location: logIN.php");
    }
?>
<!-- u nastavku je deo za test -->
<!-- profesor -->
<?php
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));

    if(isset($_POST['kreiran_test']))
    {
        
        $status=$_POST['status'];
        if($status=="onemogucen")
        {
            $kurs=$_SESSION['kurs'];
            $test=$_SESSION['test']+1;
            $mysqli->query("INSERT INTO test (sifra_kursa,broj_testa,status) VALUES ('$kurs',$test,'kreiran')");
            $result= $mysqli->query("SELECT * FROM test WHERE sifra_kursa='$kurs' ORDER BY broj_testa DESC LIMIT 1") or die($mysqli->error);
            $row= $result->fetch_assoc();
            $_SESSION['test']=$row['broj_testa'];  
        }
        $_SESSION['odgovor']=2;
        $_SESSION['greska_pitanje']="";
        header("location: napravi_test.php");
    } 
?>

<?php
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));

    if(isset($_POST['omoguci_test']))
    {
        $kurs=$_SESSION['kurs'];
        $test=$_SESSION['test'];
        $mysqli->query("UPDATE test SET status='omogucen' WHERE sifra_kursa='$kurs' AND broj_testa='$test'");  
        header("location: kurs.php");
    } 
?>

<?php
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));

    if(isset($_POST['onemoguci_test']))
    {
        $kurs=$_SESSION['kurs'];
        $test=$_SESSION['test'];
        $mysqli->query("UPDATE test SET status='onemogucen' WHERE sifra_kursa='$kurs' AND broj_testa='$test'");
        header("location: kurs.php");
    } 
?>

<?php

    if(isset($_POST['podesi_broj_odgovora']))
    {
        $_SESSION['odgovor']=$_POST['quantity'];
        header("location: napravi_test.php");
    } 
?>

<?php

    if(isset($_POST['dodaj_pitanje']))
    {
        $tekstpitanja=$_POST['tekst'];
        $poeni=(double) $_POST['quantityf'];
        $brodgovor=(int) $_SESSION['odgovor'];
        $popunjeno=TRUE;
        $cekirano=FALSE;
        for($i=1; $i<$brodgovor+1; $i++ ):
            if(strlen($_POST['odgovor' .$i. ''])==0)
            {
                $popunjeno=FALSE;
            }
        endfor;
        for($i=1; $i<$brodgovor+1; $i++ ):
            if(isset($_POST['tacno' .$i. '']))
            {
                $cekirano=TRUE;
            }
        endfor;
        if($popunjeno==FALSE || strlen($tekstpitanja)==0)
        {
            $_SESSION['greska_pitanje']="Popuniti polja za pitanja i odgovore.";
        }
        else
        {
            if($cekirano==FALSE)
            {
                $_SESSION['greska_pitanje']="Izabrati bar jedan odgovor kao tačan.";
            }
            else
            {
                $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
                $mysqli -> set_charset("utf8");
                $kurs=$_SESSION['kurs'];
                $test=$_SESSION['test'];
                $mysqli->query("INSERT INTO pitanje (sifra_kursa,broj_testa,tekst_pitanja,poeni) VALUES ('$kurs',$test,'$tekstpitanja',$poeni)");
                $result= $mysqli->query("SELECT * FROM pitanje WHERE sifra_kursa='$kurs' AND broj_testa=$test ORDER BY broj_pitanja DESC LIMIT 1") or die($mysqli->error);
                $row= $result->fetch_assoc();
                $pitanje_unos=$row['broj_pitanja'];
                for($i=1; $i<$brodgovor+1; $i++ ):
                    $tekstodgovora=$_POST['odgovor' .$i. ''];
                    if($_POST['tacno' .$i. '']=="tacno")
                    {
                        $mysqli->query("INSERT INTO odgovor (sifra_kursa,broj_testa,broj_pitanja,tekst_odgovora,tacan) VALUES ('$kurs',$test, $pitanje_unos,'$tekstodgovora',TRUE)");
                    }
                    else
                    {
                        $mysqli->query("INSERT INTO odgovor (sifra_kursa,broj_testa,broj_pitanja,tekst_odgovora,tacan) VALUES ('$kurs',$test, $pitanje_unos,'$tekstodgovora',FALSE)");
                    }
                endfor;
            }
        }
        $_SESSION['odgovor']=2;
        header("location: napravi_test.php");
    } 
?>

<?php

    if(isset($_POST['izmeni_pitanje']))
    {
        $kurs=$_SESSION['kurs'];
        $test=$_SESSION['test'];
        $pitanje=$_POST['pitanjebr'];
        $tekstpitanja=$_POST['tekst_uneseno'];
        $poeni=$_POST['quantityf_uneseno'];
        $brodgovor=$_POST['brodgovor_uneseno'];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli -> set_charset("utf8");
        $result= $mysqli->query("SELECT MIN(broj_odgovora) AS minodg FROM odgovor WHERE sifra_kursa='$kurs' AND broj_testa=$test AND broj_pitanja=$pitanje") or die($mysqli->error);
        $row= $result->fetch_assoc();
        $odgovormin=$row['minodg'];
        $popunjeno=TRUE;
        $cekirano=FALSE;
        for($i=0; $i < $brodgovor ; $i++ ):
            $odgx=(int) $odgovormin+ (int) $i;
            if(strlen($_POST['odgovor_uneseno' .$odgx. ''])==0)
            {
                $popunjeno=FALSE;
            }
            if(isset($_POST['tacno_uneseno' .$odgx. '']))
            {
                $cekirano=TRUE;
            }
        endfor;
        if($popunjeno==FALSE || strlen($tekstpitanja)==0)
        {
            $_SESSION['greska_pitanje']="Popuniti polja za pitanja i odgovore.";
        }
        else
        {
            if($cekirano==FALSE)
            {
                $_SESSION['greska_pitanje']="Izabrati bar jedan odgovor kao tačan.";
            }
            else
            {
                $result= $mysqli->query("SELECT MIN(broj_odgovora) AS minodg FROM odgovor WHERE sifra_kursa='$kurs' AND broj_testa=$test AND broj_pitanja=$pitanje") or die($mysqli->error);
                $row= $result->fetch_assoc();
                $odgovormin=$row['minodg'];
                $mysqli->query("UPDATE pitanje SET tekst_pitanja='$tekstpitanja', poeni=$poeni WHERE sifra_kursa='$kurs' AND broj_testa=$test AND broj_pitanja=$pitanje");
                for($i=0; $i<$brodgovor; $i++ ):
                    $odgx=(int) $odgovormin+ (int) $i;
                    $tekstodgovora=$_POST['odgovor_uneseno' .$odgx. ''];
                    if(isset($_POST['tacno_uneseno' .$odgx. '']))
                    {
                        $mysqli->query("UPDATE odgovor SET tekst_odgovora='$tekstodgovora', tacan=TRUE WHERE sifra_kursa='$kurs' AND broj_testa=$test AND broj_pitanja=$pitanje AND broj_odgovora=$odgx");
                    }
                    else
                    {
                        $mysqli->query("UPDATE odgovor SET tekst_odgovora='$tekstodgovora', tacan=FALSE WHERE sifra_kursa='$kurs' AND broj_testa=$test AND broj_pitanja=$pitanje AND broj_odgovora=$odgx");
                    }
                endfor;
            }
        }
        header("location: napravi_test.php");
    } 
?>

<?php

    if(isset($_POST['obrisi_pitanje']))
    {
        $pitanje=$_POST['pitanjebr'];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli->query("DELETE FROM pitanje WHERE broj_pitanja=$pitanje");  
        header("location: napravi_test.php");
    } 
?>

<?php

    if(isset($_POST['sacuvaj_test']))
    {
        $kurs=$_SESSION['kurs'];
        $test=$_SESSION['test'];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $result= $mysqli->query("SELECT * FROM pitanje WHERE sifra_kursa='$kurs' AND broj_testa=$test") or die($mysqli->error);
        $poeni_test= (double) 0.0;
        while($row = $result->fetch_assoc()):
            $poeni_test+= (double) $row['poeni'];
        endwhile;
        $mysqli->query("UPDATE test SET poeni_svi=$poeni_test WHERE sifra_kursa='$kurs' AND broj_testa=$test");
        header("location: kurs.php");
    } 
?>
<!-- student test -->
<?php

    if(isset($_POST['pokreni_test']))
    {
        $kurs=$_SESSION['kurs'];
        $test=$_SESSION['test'];
        $student=$_SESSION['idKorisnika'];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli->query("INSERT INTO radio (email_student,broj_testa,sifra_kursa) VALUES ('$student',$test,'$kurs')");
        $_SESSION['uradjen']="ne";
        header("location: radi_test.php");
    } 
?>

<?php

    if(isset($_POST['predaj_test']))
    {
        $kurs=$_SESSION['kurs'];
        $test=$_SESSION['test'];
        $email=$_SESSION['idKorisnika'];
        $pitanja_student="_";
        $odgovori_student="_";
        $ostvareni_bodovi=(double) 0.0;
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $result= $mysqli->query("SELECT * FROM pitanje WHERE sifra_kursa='$kurs' AND broj_testa=$test") or die($mysqli->error);
        while($row = $result->fetch_assoc()):
            $pitanje=$row['broj_pitanja'];
            $tacan_odgovor=TRUE;
            $resultodg= $mysqli->query("SELECT * FROM odgovor WHERE sifra_kursa='$kurs' AND broj_testa=$test AND broj_pitanja=$pitanje") or die($mysqli->error);
            while($rowodg = $resultodg->fetch_assoc()):
                $odgovor=$rowodg['broj_odgovora'];
                if(isset($_POST['odgovor' .$odgovor. '']))
                {
                    $cek=1;
                    $odgovori_student=$odgovori_student.$odgovor."_";
                }
                else
                {
                    $cek=0;
                }
                if($cek!=$rowodg['tacan'])
                {
                    $tacan_odgovor=FALSE;
                }
            endwhile;
            if($tacan_odgovor==TRUE)
            {
                $ostvareni_bodovi+= (double) $row['poeni'];
                $pitanja_student=$pitanja_student.$pitanje."_";
            }
        endwhile;
        $mysqli->query("UPDATE radio SET bodovi=$ostvareni_bodovi WHERE email_student='$email' AND sifra_kursa='$kurs' AND broj_testa=$test");
        $_SESSION['uradjen']="da";
        $_SESSION['pitanja_student']=$pitanja_student;
        $_SESSION['odgovori_student']=$odgovori_student;
        header("location: radi_test.php");
    } 
?>

<?php

    if(isset($_POST['nazad_na_kurs']))
    {
        $_SESSION['uradjen']="ne";
        header("location: kurs.php");
    } 
?>
<!-- odjava studenta sa kursa -->
<?php
    if(isset($_GET['kurs_odjava_dugme']))
    {
        $kurs=$_GET['kurs_odjava_dugme'];
        $email=$_SESSION["idKorisnika"];
        $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));
        $mysqli->query("DELETE FROM prati WHERE email_student='$email' AND sifra_kursa='$kurs'");  
        header("location: pocetna_strana.php");
    } 
?>