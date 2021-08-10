CREATE TABLE IF NOT EXISTS `portal`.`predaje` (
  `email_nastavnik` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  `sifra_kursa` CHAR(6) CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci' NOT NULL,
  PRIMARY KEY (`email_nastavnik`, `sifra_kursa`),
  INDEX `fk_nastavnik_has_kurs_kurs1_idx` (`sifra_kursa` ASC) ,
  INDEX `fk_nastavnik_has_kurs_nastavnik1_idx` (`email_nastavnik` ASC) ,
  CONSTRAINT `fk_nastavnik_has_kurs_nastavnik1`
    FOREIGN KEY (`email_nastavnik`)
    REFERENCES `portal`.`nastavnik` (`email_nastavnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_nastavnik_has_kurs_kurs1`
    FOREIGN KEY (`sifra_kursa`)
    REFERENCES `portal`.`kurs` (`sifra_kursa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;