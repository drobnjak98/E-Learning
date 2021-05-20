<?php
	Class KonekcijaSaBazom{
		private $conn;
		private $n;
		
		//Konstruktor
		function __construct() {
            $servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "portal";

			// Create connection
			$this->conn = new mysqli($servername, $username, $password, $dbname);
			$this->conn -> set_charset("utf8");
			// Check connection
			if ($this->conn->connect_error) {
				die("Connection failed: " . $this->conn->connect_error);
			}
        }
		function __destruct() {
			$this->conn->close();
		}

/* .......................funkcije za logovanje ..................................................... */

		//preuzimanje informacija o administratoru pri logovanju
		function LogovanjeAdmin($id) {
			$sql1 = "SELECT * FROM administrator WHERE email_admin LIKE '%".$id."%' ";
			$result1 = $this->conn->query($sql1);						
			return $result1;
		}
	
		//preuzimanje informacija o studentu pri logovanju
		function LogovanjeStudenta($id) {
			$sql1 = "SELECT  ime_student, prezime_student, sifra_student FROM student WHERE email_student LIKE '%".$id."%' ";
			$result1 = $this->conn->query($sql1);						
			return $result1;
		}
		//preuzivanje infomacija o profesoru pri logovanju
		function LogovanjeProfesora($id) {
			$sql1 = "SELECT * FROM nastavnik WHERE email_nastavnik LIKE '%".$id."%' ";
			$result1 = $this->conn->query($sql1);						
			return $result1;
		}
		//promena sifre studentu / profesora
		function PromenaSifre($id, $staraSifra, $novaSifra) {
			$sql1 = "SELECT * FROM student WHERE email_student LIKE '%".$id."%' ";
			$result1 = $this->conn->query($sql1);
			$N1 = $result1->num_rows;
			if($N1 > 0 ) {
				$row = $result1->fetch_assoc();
				if ($row['sifra_student'] == $staraSifra) {
					//ako je korisnicko ime i sifra je tacna, izvodi se promena sifre
					$sql = "UPDATE `student` SET `sifra_student` = '".$novaSifra."' WHERE `email_student` = '".$id."'";
					//$sql = "UPDATE `student` SET `sifra_student`= \'123\' WHERE `email_student`= \'d@d\'";
					if ($this->conn->query($sql) === TRUE) {
						return 0;
					} else {
						return 3;	
					}
				} else {
					//pogresna sifra
					return 1;
				}
			}  else {				
				//pretraziti dali se je ulogovao profesor
				$sql1 = "SELECT sifra_nastavnik FROM nastavnik WHERE email_nastavnik LIKE '%".$id."%' ";
				$result2 = $this->conn->query($sql1);
				$N2 = $result2->num_rows;
				if($N2 > 0 ) {
					$row = $result2->fetch_assoc();
					if ($row['sifra_nastavnik'] == $staraSifra) {
						//korisnicko ime i sifra je tacna, izvodi se promena sifre
						$sql = "UPDATE `nastavnik` SET `sifra_nastavnik` = '".$novaSifra."' WHERE `email_nastavnik` = '".$id."'";
						if ($this->conn->query($sql) === TRUE) {
							return 0;
						} else {
							return 3;	
						}
					} else {
						//pogresna sifra
						return 1;
					}
				} else {
					$sql1 = "SELECT sifra_admin FROM administrator WHERE email_admin LIKE '%".$id."%' ";
					$result3 = $this->conn->query($sql1);
					$N3 = $result3->num_rows;
					if($N3 > 0 ) {
						$row = $result3->fetch_assoc();
						if ($row['sifra_admin'] == $staraSifra) {
							//korisnicko ime i sifra je tacna, izvodi se promena sifre
							$sql = "UPDATE `administrator` SET `sifra_admin` = '".$novaSifra."' WHERE `email_admin` = '".$id."'";
							if ($this->conn->query($sql) === TRUE) {
								return 0;
							} else {
								return 3;	
							}
						} else {
							//pogresna sifra
							return 1;
						}
					}
					else{
					    //pogresno korisnicko ime ili nepostojecko
					    return 2;
					}
				}
			}
		}

/*........... .....................................................................................*/

/*/........ .......................funkcije za rad profila korisnika ........................... */

		// ispisivanje podataka o profilu profesora ili studenta
		function UcitajPodatke($id, $tipKorisnika) {
			$str = "";
			
			if($tipKorisnika == "student") {
				$sql = "SELECT * FROM student WHERE email_student = '".$id."' ";
				
				$result = $this->conn->query($sql);
				$N = $result->num_rows;
				$i = 0;
				if ($N > 0) {
					while($i < $N) {										
						$row = $result->fetch_assoc();					
			
						$str = "
						<div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Ime :</h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						  ". $row['ime_student'] . "
						</div>
					  </div>
					  <hr>
					  <div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Prezime: </h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						  " . $row['prezime_student'] . "
						</div>
					  </div>
					  <hr>
					  <div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Email : </h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						  " . $id . "
						</div>
					  </div>
					  <hr>
					  <div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Godina studija : </h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						 " . $row['godina'] . "
						</div>
					  </div>
						";
						echo $str;						
						$i++;
					}	
				}
			} else if($tipKorisnika == "profesor"){
				$sql = "SELECT * FROM nastavnik WHERE email_nastavnik = '".$id."' ";
				
				$result = $this->conn->query($sql);
				$N = $result->num_rows;
				$i = 0;
				if ($N > 0) {
					while($i < $N) {										
						$row = $result->fetch_assoc();					
						$str = "
						<div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Ime :</h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						  ". $row['ime_nastavnik'] . "
						</div>
					  </div>
					  <hr>
					  <div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Prezime: </h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						  " . $row['prezime_nastavnik'] . "
						</div>
					  </div>
					  <hr>
					  <div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Email : </h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						  " . $id . "
						</div>
					  </div>
					  <hr>
					  <div class=\"row\">
						<div class=\"col-sm-3\">
						  <h6 class=\"mb-0\">Status : </h6>
						</div>
						<div class=\"col-sm-9 text-secondary\">
						 ...
						</div>
					  </div>
						";	
						echo $str;						
						$i++;
					}	
				}
			}
				
		}

		
		// unosenje slike u bazi podataka
		function UnesiSliku($name, $id, $tip){
			if ($tip == "student") {
				$sql = "UPDATE `student` SET `fotografija`='" . $name . "' WHERE `email_student`='" . $id . "'";
			} else {
				$sql = "UPDATE `nastavnik` SET `fotografija`='" . $name . "' WHERE `email_nastavnik`='" . $id . "'";
			}
				
			if ($this->conn->query($sql) === TRUE) {
			  //echo "New record created successfully";
			} else {
				echo "<script> alert(\"Desila se greska, probajte opet!\"); </script>";
			}
		}

		// prikaz kurseva studenta na profilu
		function prikazKurseveNaProfilu($email, $tip) {
			if($tip == "student") {
				$sql = "SELECT * FROM prati INNER JOIN kurs ON prati.sifra_kursa=kurs.sifra_kursa WHERE prati.email_student='".$email."'";
			} else{
				$sql = "SELECT * FROM kurs WHERE email_nastavnik = '".$email."'";
			}
			$out = "";

			$result = $this->conn->query($sql);
			$N = $result->num_rows;
			if ($N > 0) {				
				while($row = $result->fetch_assoc()) {
					//$out .= "<li><a href=\"proces.php?pocetna_kurs=".$row['sifra_kursa']."\">".$row['naziv']."</a></li>";
					$out .= "
					<div class=\"row\">
                    	<div class=\"col-sm-9 \">
                      		- <a href=\"kurs.php?pocetna_kurs=".$row['sifra_kursa']."\">".$row['naziv']." </a>
                    	</div>	
                  	</div>";
				}
			}
			echo $out;
			
		}

		//preuzimanje profilne slike
		function uzmiProfilnuSliku($id, $tip) {
			$out = "";
			if($tip == "student") {
				$sql = "SELECT fotografija FROM student WHERE email_student = '" . $id . "'";
			} else {
				$sql = "SELECT fotografija FROM nastavnik WHERE email_nastavnik = '" . $id . "'";

			}
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()) {
				$out = $row['fotografija'];
			}
			return $out;
		}

/*................................................................................................. */

/*........................... rad sa bazom studenata .............................................*/

		//ubacivanje novog studenta u bazi studenata
		// ovo treba se izmeni
		function Insert($id, $ime, $prezime, $indeks, $studije, $sifra){
			$N1 = 0;
			
			//provera dali postoji student sa datim indeksom
			if ($id != ""){
				$sql1 = "SELECT * FROM student WHERE email_student LIKE '%".$id."%' ";
				
				$result1 = $this->conn->query($sql1);
				$N1 = $result1->num_rows;				
			}			
			
			if ($N1 > 0) {
				 echo "<script language=\"javascript\">alert('Student sa unesenim podacima vec postoji.');</script>";
			} else {
				$sql = " INSERT INTO `student`(`email_student`, `ime_student`, `prezime_student`, `indeks`, `godina`, `sifra_student`, `upis`, `fotografija`)
					VALUES ('".$id."', '".$ime."', '".$prezime."', '".(int)$indeks."', '".(int)$studije."', '".$sifra."', '2017', '')";
				
				if ($this->conn->query($sql) === TRUE) {
				  //echo "New record created successfully";
				} else {
					echo "<script>
						alert(\"Error: " . $sql . "<br>" . $this->conn->error."!\");
					</script>";
				}
			}
		}

		// prikaz informacija o studentima u tabeli		
		//  prikazuje 5 studenta
		function insertStudentsIntoTable($pojamPretrage, $tempPage) {
			$sql = "SELECT * FROM student";
			if ($pojamPretrage != "") {
				$sql = $sql." WHERE ime_student LIKE '%".$pojamPretrage."%' OR prezime_student LIKE '%".$pojamPretrage."%' OR email_student LIKE '%".$pojamPretrage."%' ";
			}
			
			// koje studente ce prikazati
			$start = ($tempPage - 1) * 5;
			$end = $start + 5;
			
			$result = $this->conn->query($sql);
			$this->n = $result->num_rows;
			$i = 0;
			if ($this->n > 0) {
				while($i < $this->n) {
					if($i == $end) break;
					
					$row = $result->fetch_assoc();
					
					if($i >= $start) {			
						echo "<tr>						
							<td>" . $row['email_student'] . "</td>
							<td>" . $row['ime_student'] . "</td><td> " . $row['prezime_student'] . "</td>
							<td>" . $row['indeks'] . "</td>
							<td>". $row['sifra_student'] ." </td>
							<td>" . $row['godina'] . "</td>
							<td>
								<a href=\"izmena.php?id=".$row['email_student']."&ime=".$row['ime_student']."&prezime=".$row['prezime_student'].
								"&indeks=".$row['indeks']."&studije=".$row['godina']."&sifra=".$row['sifra_student']."\" class=\"edit\" ><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>
								<a href=\"brisanje.php?id=".$row['email_student']."\" class=\"delete\" ><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>
							</td>
						</tr>";
					}
					
					$i++;
				}	
			}	
		}

		// prikaz trenutne stranice u tabeli
		function doPagination($tempPage) {						
			if($this->n < 5){
				$numberOfPages = 1;
				$shown = $this->n;
			} else {
				$numberOfPages = ($this->n / 5) + 1;
				$shown = 5;
			}			
			
			$str = "<div class=\"hint-text\">Prikazano <b>".$shown."</b> od mogućih <b>".$this->n."</b> ulaza</div>".
					"<ul class=\"pagination\">";
						
			// ovde se dodaje link PRETHODNI
			if ($tempPage == 1) {			
				$str = $str ."	<li class=\"page-item disabled\"><a>Prethodni</a></li>";
			} else {
				$next = $tempPage - 1;
				$str = $str ."	<li class=\"page-item disabled\"><a href=\"RadSaBazomStudenata.php?tempPage=".$next."\">Prethodni</a></li>";
			}
			
			//ovde se dodaju linkovi tipa brojevi
			for ($j = 0; $j < 5; $j++) {
				$brojZaPrikazati = $tempPage + $j;
				if ($tempPage == $brojZaPrikazati) {
					$str = $str . "<li class=\"page-item\"><a class=\"page-link\">".$tempPage."</a></li>";
				} else if ($brojZaPrikazati < $numberOfPages){
					$str = $str . "<li class=\"page-item\"><a href=\"RadSaBazomStudenata.php?tempPage=".$brojZaPrikazati."\" class=\"page-link\">".$brojZaPrikazati."</a></li>";
				}
			}
			
			//ovde se dodaje link tipa SLEDECI
			if ($tempPage == ($numberOfPages % 10)	){
				$str = $str .  "<li class=\"page-item\"><a class=\"page-link\">Sledeći</a></li>";
			} else {
				$next = $tempPage + 1;
				$str = $str . "<li class=\"page-item\"><a href=\"RadSaBazomStudenata.php?tempPage=".$next."\" class=\"page-link\">Sledeći</a></li>";
			}		
			$str = $str . "  </ul>";
			echo $str;
		}

		//brisanje studenta iz baze studenata
		function Delete($id) {
			$sql = "DELETE FROM `student` WHERE `email_student`='".$id."'";
			if ($this->conn->query($sql) === TRUE) {
				return true;
			} else {
				return false;
			}
		}

		//promena informacije o studentu
		function Update($ID, $ime, $prezime, $email, $studije, $sifra, $indeks) {
			$sql = "UPDATE `student` SET `ime_student`='".$ime."',`prezime_student`='".$prezime."',`godina`=".$studije.",`sifra_student`='".$sifra."', `indeks`=".$indeks." WHERE `email_student`='".$ID."'";
			if ($this->conn->query($sql) === TRUE) {
				return true;
			} else {
				return false;
			}
		}

		/*..................................................................................... */

	}
?>