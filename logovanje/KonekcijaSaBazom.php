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
			// Check connection
			if ($this->conn->connect_error) {
				die("Connection failed: " . $this->conn->connect_error);
			}
        }
		function __destruct() {
			$this->conn->close();
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
					//pogresno korisnicko ime ili nepostojecko
					return 2;
				}
			}
		}

	}
?>