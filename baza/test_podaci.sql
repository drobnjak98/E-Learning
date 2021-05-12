-- ovo su neki test podaci koje sam koristio

--
-- Dumping data for table `nastavnik`
--

INSERT INTO `nastavnik` (`email_nastavnik`, `sifra_nastavnik`, `fotografija`, `ime_nastavnik`, `prezime_nastavnik`) VALUES
('v@i', '1', 'download.png', 'Velibor', 'Isailović');

-- -------------------------------------------------------

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`email_student`, `sifra_student`, `indeks`, `upis`, `fotografija`, `ime_student`, `prezime_student`, `godina`) VALUES
('d@d', '1', 601, 2017, 'profil.jpg', 'Dimitrije', 'Drobnjak', 4),
('j.jovanovic@gmail.com', '1', 604, 2017, '', 'Jovan', 'Jovanović', 4),
('p.petrovic@gmail.com', '1', 602, 2017, '', 'Petar', 'Petrović', 4);

-- --------------------------------------------------------

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`sifra_kursa`, `email_nastavnik`, `naziv`, `godina`) VALUES
('a1', 'v@i', 'Softverski inzinjering', 4),
('primer', 'v@i', 'Softverski inženjering 2', 4);