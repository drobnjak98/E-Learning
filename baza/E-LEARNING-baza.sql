-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema portal
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema portal
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `portal` DEFAULT CHARACTER SET utf8 ;
USE `portal` ;

-- -----------------------------------------------------
-- Table `portal`.`administrator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`administrator` (
  `email_admin` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `sifra_admin` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `ime_admin` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  PRIMARY KEY (`email_admin`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal`.`nastavnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`nastavnik` (
  `email_nastavnik` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `sifra_nastavnik` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `forografija` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL DEFAULT '',
  `ime_nastavnik` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  `prezime_nastavnik` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  PRIMARY KEY (`email_nastavnik`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `portal`.`kurs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`kurs` (
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `naziv` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  `godina` INT NOT NULL,
  PRIMARY KEY (`sifra_kursa`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `portal`.`objava`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`objava` (
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `nedelja` INT NOT NULL,
  `ID` INT NOT NULL AUTO_INCREMENT,
  `src` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `tip_objave` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  PRIMARY KEY (`ID`, `sifra_kursa`, `nedelja`),
  INDEX `objava_fk_idx` (`sifra_kursa` ASC) ,
  CONSTRAINT `objava_fk`
    FOREIGN KEY (`sifra_kursa`)
    REFERENCES `portal`.`kurs` (`sifra_kursa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`student` (
  `email_student` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `sifra_student` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `indeks` INT NOT NULL,
  `upis` INT NOT NULL,
  `fotografija` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL DEFAULT '',
  `ime_student` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  `prezime_student` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  `godina` INT NOT NULL,
  PRIMARY KEY (`email_student`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal`.`test`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`test` (
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `broj_testa` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `poeni_svi` DOUBLE NOT NULL DEFAULT 0.0,
  PRIMARY KEY (`broj_testa`, `sifra_kursa`),
  INDEX `kurs_fk_idx` (`sifra_kursa` ASC),
  CONSTRAINT `kurs_fk`
    FOREIGN KEY (`sifra_kursa`)
    REFERENCES `portal`.`kurs` (`sifra_kursa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal`.`pitanje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`pitanje` (
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `broj_testa` INT NOT NULL,
  `broj_pitanja` INT NOT NULL AUTO_INCREMENT,
  `tekst_pitanja` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  `poeni` DOUBLE NOT NULL,
  PRIMARY KEY (`broj_pitanja`, `sifra_kursa`, `broj_testa`),
  INDEX `test_fk_idx` (`sifra_kursa` ASC, `broj_testa` ASC) ,
  CONSTRAINT `test_fk`
    FOREIGN KEY (`sifra_kursa` , `broj_testa`)
    REFERENCES `portal`.`test` (`sifra_kursa` , `broj_testa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal`.`odgovor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`odgovor` (
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `broj_testa` INT NOT NULL,
  `broj_pitanja` INT NOT NULL,
  `broj_odgovora` INT NOT NULL AUTO_INCREMENT,
  `tekst_odgovora` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_croatian_ci' NOT NULL,
  `tacan` TINYINT NOT NULL,
  PRIMARY KEY (`broj_odgovora`, `broj_pitanja`, `broj_testa`, `sifra_kursa`),
  INDEX `pitanje_fk_idx` (`sifra_kursa` ASC, `broj_testa` ASC, `broj_pitanja` ASC) ,
  CONSTRAINT `pitanje_fk`
    FOREIGN KEY (`sifra_kursa` , `broj_testa` , `broj_pitanja`)
    REFERENCES `portal`.`pitanje` (`sifra_kursa` , `broj_testa` , `broj_pitanja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal`.`prati`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`prati` (
  `email_student` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  PRIMARY KEY (`email_student`, `sifra_kursa`),
  INDEX `fk_student_has_kurs_kurs1_idx` (`sifra_kursa` ASC) ,
  INDEX `fk_student_has_kurs_student1_idx` (`email_student` ASC) ,
  CONSTRAINT `fk_student_has_kurs_student1`
    FOREIGN KEY (`email_student`)
    REFERENCES `portal`.`student` (`email_student`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_kurs_kurs1`
    FOREIGN KEY (`sifra_kursa`)
    REFERENCES `portal`.`kurs` (`sifra_kursa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal`.`radio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal`.`radio` (
  `email_student` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `broj_testa` INT NOT NULL,
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `bodovi` DOUBLE NOT NULL DEFAULT -1.0,
  PRIMARY KEY (`email_student`, `broj_testa`, `sifra_kursa`),
  INDEX `fk_student_has_test_test1_idx` (`broj_testa` ASC, `sifra_kursa` ASC) ,
  INDEX `fk_student_has_test_student1_idx` (`email_student` ASC),
  CONSTRAINT `fk_student_has_test_student1`
    FOREIGN KEY (`email_student`)
    REFERENCES `portal`.`student` (`email_student`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_test_test1`
    FOREIGN KEY (`broj_testa` , `sifra_kursa`)
    REFERENCES `portal`.`test` (`broj_testa` , `sifra_kursa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `fajl`
--

CREATE TABLE `fajl` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `lokacija` varchar(255) NOT NULL,
  `tip_fajla` varchar(50) NOT NULL,
  `sifra_kursa` char(6) NOT NULL,
  `id_sekcije` int(11) NOT NULL,
  `redni_broj` int(11) NOT NULL,
  `vidljivost` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `fajl`
--
ALTER TABLE `fajl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fajl`
--
ALTER TABLE `fajl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
