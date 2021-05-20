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
    $mysqli = new mysqli('localhost', 'root', '', 'portal') or die(mysqli_error($mysqli));

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