-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Mai 2019 um 10:18
-- Server-Version: 10.1.39-MariaDB
-- PHP-Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `immoverwaltung`
--
CREATE DATABASE IF NOT EXISTS `immoverwaltung` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `immoverwaltung`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE `adresse` (
  `AdresseID` int(11) NOT NULL,
  `Ort` varchar(64) NOT NULL,
  `PLZ` int(11) NOT NULL,
  `Strasse` varchar(64) NOT NULL,
  `Hausnummer` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`AdresseID`, `Ort`, `PLZ`, `Strasse`, `Hausnummer`) VALUES
(1, 'Siegen', 57076, 'Hubertusweg', '20'),
(2, 'Weidenau', 57076, 'Weidenauer Straße', '10');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `BenutzerID` int(11) NOT NULL,
  `Vorname` varchar(32) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Passwort` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`BenutzerID`, `Vorname`, `Name`, `Email`, `Passwort`) VALUES
(9, '', 'test', 'test@test.com', 'test'),
(10, '', '1234', '1234@1234.de', '1234'),
(11, '', '12345', '1234@gmx.de', '1234');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `beschwerde`
--

CREATE TABLE `beschwerde` (
  `BeschwerdeID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL,
  `BenutzerID` int(11) NOT NULL,
  `Beschreibung` varchar(256) DEFAULT NULL,
  `Foto` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Reparaturbeschwerdeeinrichtung';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datensammlung`
--

CREATE TABLE `datensammlung` (
  `DatensammlungID` int(11) NOT NULL,
  `BenutzerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigentuemer`
--

CREATE TABLE `eigentuemer` (
  `EigentuemerID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL,
  `AdresseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `eigentuemer`
--

INSERT INTO `eigentuemer` (`EigentuemerID`, `BenutzerID`, `ObjektID`, `VerwID`, `AdresseID`) VALUES
(1, 11, 1, NULL, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigen_vers`
--

CREATE TABLE `eigen_vers` (
  `VersammlungID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Protokoll_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Eigentuemerversammlung';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigen_vers_personen`
--

CREATE TABLE `eigen_vers_personen` (
  `VersammlungID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Eigentuemerversammlung Personen';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigen_vers_protokoll`
--

CREATE TABLE `eigen_vers_protokoll` (
  `Protokoll_ID` int(11) NOT NULL,
  `VersammlungID` int(11) NOT NULL,
  `Dokument` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Eigentuemerversammlung Protokoll';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gruesse`
--

CREATE TABLE `gruesse` (
  `GruesseID` int(11) NOT NULL,
  `EmpfaengerID` int(11) NOT NULL,
  `AbsenderID` int(11) NOT NULL,
  `Nachricht` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `handwerker`
--

CREATE TABLE `handwerker` (
  `HandwerkerID` int(11) NOT NULL,
  `Kategorie` varchar(64) DEFAULT NULL,
  `Name` varchar(64) DEFAULT NULL,
  `Kommentar` varchar(256) DEFAULT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hausobjekt`
--

CREATE TABLE `hausobjekt` (
  `ObjektID` int(11) NOT NULL,
  `Adresse` int(11) NOT NULL,
  `Kommentar` varchar(128) DEFAULT NULL,
  `Besitzer` int(11) DEFAULT NULL,
  `Typ` enum('Einfamilienhaus','Zweifamilienhaus','Doppelhaus','Reihenhaus','Mehrfamilienhaus','Wohnhochhaus','Villa','Schloss','Wohn- und Geschäftsgebäude','Geschäftsgebäude','andere','') DEFAULT NULL,
  `Lageplan` blob,
  `Bauplan` blob,
  `Versammlung` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `hausobjekt`
--

INSERT INTO `hausobjekt` (`ObjektID`, `Adresse`, `Kommentar`, `Besitzer`, `Typ`, `Lageplan`, `Bauplan`, `Versammlung`) VALUES
(1, 1, NULL, 10, 'Villa', NULL, NULL, 1),
(2, 2, 'Top Lage', 11, 'Schloss', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kautionskonto`
--

CREATE TABLE `kautionskonto` (
  `KautionsKontoID` int(11) NOT NULL,
  `Saldo` int(11) NOT NULL,
  `Zinsen` int(11) DEFAULT NULL,
  `MieterID` int(11) NOT NULL,
  `VermieterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kuendigung`
--

CREATE TABLE `kuendigung` (
  `KuendigungID` int(11) NOT NULL,
  `MietverhaeltnisID` int(11) NOT NULL,
  `Datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Kuendigungsbestätigung';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mieter`
--

CREATE TABLE `mieter` (
  `MieterID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mietverhaeltnis`
--

CREATE TABLE `mietverhaeltnis` (
  `MietverhaeltnisID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL,
  `Vermieter` int(11) NOT NULL,
  `Mieter` int(11) NOT NULL,
  `Beginn` date DEFAULT NULL,
  `Ende` date DEFAULT NULL,
  `ObjektID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mkzbescheinigung`
--

CREATE TABLE `mkzbescheinigung` (
  `MkzBescheinigungID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `KautionsKontoID` int(11) NOT NULL,
  `MieterID` int(11) NOT NULL,
  `VermieterID` int(11) NOT NULL,
  `VerwID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Mietkautionszinsbescheinigung';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nachrichten`
--

CREATE TABLE `nachrichten` (
  `NachrichtID` int(11) NOT NULL,
  `PostfachID` int(11) NOT NULL,
  `Text` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nkabrechnung`
--

CREATE TABLE `nkabrechnung` (
  `NkAbrechnungID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL,
  `MieterID` int(11) NOT NULL,
  `VermieterID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Nebenkostenabrechnung';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `postfach`
--

CREATE TABLE `postfach` (
  `PostfachID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rauchmelder`
--

CREATE TABLE `rauchmelder` (
  `RauchmelderID` int(11) NOT NULL,
  `ZimmerID` int(11) NOT NULL,
  `Verbaut` tinyint(4) NOT NULL,
  `Wartung` varchar(45) DEFAULT NULL,
  `Installiert` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vermieter`
--

CREATE TABLE `vermieter` (
  `VermieterID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verwalter`
--

CREATE TABLE `verwalter` (
  `VerwalterID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verwaltungseinheit`
--

CREATE TABLE `verwaltungseinheit` (
  `VerwID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `Kommentar` varchar(45) DEFAULT NULL,
  `Besitzer` int(11) DEFAULT NULL,
  `Wohnfläche` double DEFAULT NULL,
  `Typ` enum('Wohnung','Geschäft','Etage','Loft','Penthouse','Einliegerwohnung','Maisonettewohnung','Etagenwohnung','Souterrainwohnung') DEFAULT NULL,
  `Bauplan` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wirtschaftsplan`
--

CREATE TABLE `wirtschaftsplan` (
  `WirtschaftsplanID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `NkAbrechnungID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wohngeldkonto`
--

CREATE TABLE `wohngeldkonto` (
  `WohngeldKontoID` int(11) NOT NULL,
  `MieterID` int(11) NOT NULL,
  `VermieterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungen`
--

CREATE TABLE `zahlungen` (
  `ZahlungenID` int(11) NOT NULL,
  `ZahlungsKontoID` int(11) NOT NULL,
  `Betrag` double NOT NULL,
  `Text` varchar(128) DEFAULT NULL,
  `Datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungskonto`
--

CREATE TABLE `zahlungskonto` (
  `ZahlungsKontoID` int(11) NOT NULL,
  `Saldo` int(11) DEFAULT NULL,
  `MieterID` int(11) DEFAULT NULL,
  `VermieterID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zimmer`
--

CREATE TABLE `zimmer` (
  `ZimmerID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL,
  `Bezeichnung` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`AdresseID`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`BenutzerID`);

--
-- Indizes für die Tabelle `beschwerde`
--
ALTER TABLE `beschwerde`
  ADD PRIMARY KEY (`BeschwerdeID`),
  ADD UNIQUE KEY `Benutzer` (`BenutzerID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `Verw` (`VerwID`) USING BTREE;

--
-- Indizes für die Tabelle `datensammlung`
--
ALTER TABLE `datensammlung`
  ADD PRIMARY KEY (`DatensammlungID`),
  ADD KEY `Benutzer` (`BenutzerID`);

--
-- Indizes für die Tabelle `eigentuemer`
--
ALTER TABLE `eigentuemer`
  ADD PRIMARY KEY (`EigentuemerID`),
  ADD KEY `ObjektID` (`ObjektID`),
  ADD KEY `VerwID` (`VerwID`),
  ADD KEY `BenutzerID` (`BenutzerID`),
  ADD KEY `Adresse` (`AdresseID`) USING BTREE;

--
-- Indizes für die Tabelle `eigen_vers`
--
ALTER TABLE `eigen_vers`
  ADD PRIMARY KEY (`VersammlungID`),
  ADD KEY `ObjektID` (`ObjektID`),
  ADD KEY `Protokoll_ID` (`Protokoll_ID`);

--
-- Indizes für die Tabelle `eigen_vers_personen`
--
ALTER TABLE `eigen_vers_personen`
  ADD KEY `VersammlungID` (`VersammlungID`) USING BTREE,
  ADD KEY `BenutzerID` (`BenutzerID`);

--
-- Indizes für die Tabelle `eigen_vers_protokoll`
--
ALTER TABLE `eigen_vers_protokoll`
  ADD PRIMARY KEY (`Protokoll_ID`),
  ADD KEY `Versammlung` (`VersammlungID`);

--
-- Indizes für die Tabelle `gruesse`
--
ALTER TABLE `gruesse`
  ADD PRIMARY KEY (`GruesseID`),
  ADD KEY `EmpfaengerID` (`EmpfaengerID`) USING BTREE,
  ADD KEY `AbsenderID` (`AbsenderID`);

--
-- Indizes für die Tabelle `handwerker`
--
ALTER TABLE `handwerker`
  ADD PRIMARY KEY (`HandwerkerID`),
  ADD KEY `Objekt` (`ObjektID`) USING BTREE,
  ADD KEY `Verw` (`VerwID`) USING BTREE;

--
-- Indizes für die Tabelle `hausobjekt`
--
ALTER TABLE `hausobjekt`
  ADD PRIMARY KEY (`ObjektID`),
  ADD KEY `Adresse` (`Adresse`),
  ADD KEY `Besitzer` (`Besitzer`);

--
-- Indizes für die Tabelle `kautionskonto`
--
ALTER TABLE `kautionskonto`
  ADD PRIMARY KEY (`KautionsKontoID`),
  ADD KEY `Mieter` (`MieterID`),
  ADD KEY `Vermieter` (`VermieterID`);

--
-- Indizes für die Tabelle `kuendigung`
--
ALTER TABLE `kuendigung`
  ADD PRIMARY KEY (`KuendigungID`),
  ADD KEY `Mietverhältnis` (`MietverhaeltnisID`);

--
-- Indizes für die Tabelle `mieter`
--
ALTER TABLE `mieter`
  ADD PRIMARY KEY (`MieterID`),
  ADD KEY `Benutzer` (`BenutzerID`) USING BTREE,
  ADD KEY `Objekt` (`ObjektID`) USING BTREE,
  ADD KEY `Verw` (`VerwID`) USING BTREE;

--
-- Indizes für die Tabelle `mietverhaeltnis`
--
ALTER TABLE `mietverhaeltnis`
  ADD PRIMARY KEY (`MietverhaeltnisID`),
  ADD KEY `Verw` (`VerwID`),
  ADD KEY `Vermieter` (`Vermieter`),
  ADD KEY `Mieter` (`Mieter`),
  ADD KEY `Objekt` (`ObjektID`);

--
-- Indizes für die Tabelle `mkzbescheinigung`
--
ALTER TABLE `mkzbescheinigung`
  ADD PRIMARY KEY (`MkzBescheinigungID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `KautionsKonto` (`KautionsKontoID`),
  ADD KEY `Mieter` (`MieterID`),
  ADD KEY `Vermieter` (`VermieterID`) USING BTREE,
  ADD KEY `Verw` (`VerwID`);

--
-- Indizes für die Tabelle `nachrichten`
--
ALTER TABLE `nachrichten`
  ADD PRIMARY KEY (`NachrichtID`),
  ADD KEY `Postfach` (`PostfachID`);

--
-- Indizes für die Tabelle `nkabrechnung`
--
ALTER TABLE `nkabrechnung`
  ADD PRIMARY KEY (`NkAbrechnungID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `Mieter` (`MieterID`),
  ADD KEY `Verw` (`VerwID`) USING BTREE,
  ADD KEY `Vermieter` (`VermieterID`);

--
-- Indizes für die Tabelle `postfach`
--
ALTER TABLE `postfach`
  ADD PRIMARY KEY (`PostfachID`),
  ADD KEY `Benutzer` (`BenutzerID`);

--
-- Indizes für die Tabelle `rauchmelder`
--
ALTER TABLE `rauchmelder`
  ADD PRIMARY KEY (`RauchmelderID`),
  ADD KEY `Zimmer` (`ZimmerID`);

--
-- Indizes für die Tabelle `vermieter`
--
ALTER TABLE `vermieter`
  ADD PRIMARY KEY (`VermieterID`),
  ADD KEY `Benutzer` (`BenutzerID`),
  ADD KEY `Objekt` (`ObjektID`) USING BTREE,
  ADD KEY `Verw` (`VerwID`);

--
-- Indizes für die Tabelle `verwalter`
--
ALTER TABLE `verwalter`
  ADD PRIMARY KEY (`VerwalterID`),
  ADD KEY `Benutzer` (`BenutzerID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `Verw` (`VerwID`);

--
-- Indizes für die Tabelle `verwaltungseinheit`
--
ALTER TABLE `verwaltungseinheit`
  ADD PRIMARY KEY (`VerwID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `Besitzer` (`Besitzer`);

--
-- Indizes für die Tabelle `wirtschaftsplan`
--
ALTER TABLE `wirtschaftsplan`
  ADD PRIMARY KEY (`WirtschaftsplanID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `NKAbrechrechnung` (`NkAbrechnungID`);

--
-- Indizes für die Tabelle `wohngeldkonto`
--
ALTER TABLE `wohngeldkonto`
  ADD PRIMARY KEY (`WohngeldKontoID`),
  ADD KEY `Mieter` (`MieterID`),
  ADD KEY `Vermieter` (`VermieterID`);

--
-- Indizes für die Tabelle `zahlungen`
--
ALTER TABLE `zahlungen`
  ADD PRIMARY KEY (`ZahlungenID`),
  ADD UNIQUE KEY `ZahlungsKonto` (`ZahlungsKontoID`);

--
-- Indizes für die Tabelle `zahlungskonto`
--
ALTER TABLE `zahlungskonto`
  ADD PRIMARY KEY (`ZahlungsKontoID`),
  ADD KEY `Mieter` (`MieterID`),
  ADD KEY `Vermieter` (`VermieterID`);

--
-- Indizes für die Tabelle `zimmer`
--
ALTER TABLE `zimmer`
  ADD PRIMARY KEY (`ZimmerID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `Verw` (`VerwID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adresse`
--
ALTER TABLE `adresse`
  MODIFY `AdresseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `BenutzerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `beschwerde`
--
ALTER TABLE `beschwerde`
  MODIFY `BeschwerdeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `datensammlung`
--
ALTER TABLE `datensammlung`
  MODIFY `DatensammlungID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `eigentuemer`
--
ALTER TABLE `eigentuemer`
  MODIFY `EigentuemerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `eigen_vers`
--
ALTER TABLE `eigen_vers`
  MODIFY `VersammlungID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `eigen_vers_protokoll`
--
ALTER TABLE `eigen_vers_protokoll`
  MODIFY `Protokoll_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gruesse`
--
ALTER TABLE `gruesse`
  MODIFY `GruesseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `handwerker`
--
ALTER TABLE `handwerker`
  MODIFY `HandwerkerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `hausobjekt`
--
ALTER TABLE `hausobjekt`
  MODIFY `ObjektID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `kautionskonto`
--
ALTER TABLE `kautionskonto`
  MODIFY `KautionsKontoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kuendigung`
--
ALTER TABLE `kuendigung`
  MODIFY `KuendigungID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mieter`
--
ALTER TABLE `mieter`
  MODIFY `MieterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mietverhaeltnis`
--
ALTER TABLE `mietverhaeltnis`
  MODIFY `MietverhaeltnisID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `nachrichten`
--
ALTER TABLE `nachrichten`
  MODIFY `NachrichtID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `nkabrechnung`
--
ALTER TABLE `nkabrechnung`
  MODIFY `NkAbrechnungID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `postfach`
--
ALTER TABLE `postfach`
  MODIFY `PostfachID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `rauchmelder`
--
ALTER TABLE `rauchmelder`
  MODIFY `RauchmelderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vermieter`
--
ALTER TABLE `vermieter`
  MODIFY `VermieterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verwalter`
--
ALTER TABLE `verwalter`
  MODIFY `VerwalterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verwaltungseinheit`
--
ALTER TABLE `verwaltungseinheit`
  MODIFY `VerwID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wirtschaftsplan`
--
ALTER TABLE `wirtschaftsplan`
  MODIFY `WirtschaftsplanID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zahlungskonto`
--
ALTER TABLE `zahlungskonto`
  MODIFY `ZahlungsKontoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zimmer`
--
ALTER TABLE `zimmer`
  MODIFY `ZimmerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `beschwerde`
--
ALTER TABLE `beschwerde`
  ADD CONSTRAINT `FK_B_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_B_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_B_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `datensammlung`
--
ALTER TABLE `datensammlung`
  ADD CONSTRAINT `FK_D_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `eigentuemer`
--
ALTER TABLE `eigentuemer`
  ADD CONSTRAINT `FK_ET_AdresseID` FOREIGN KEY (`AdresseID`) REFERENCES `adresse` (`AdresseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ET_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ET_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ET_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `eigen_vers`
--
ALTER TABLE `eigen_vers`
  ADD CONSTRAINT `FK_ETV_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ETV_Protokoll_ID` FOREIGN KEY (`Protokoll_ID`) REFERENCES `eigen_vers_protokoll` (`Protokoll_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `eigen_vers_personen`
--
ALTER TABLE `eigen_vers_personen`
  ADD CONSTRAINT `FK_ETVP_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ETVP_VersammlungID` FOREIGN KEY (`VersammlungID`) REFERENCES `eigen_vers` (`VersammlungID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `eigen_vers_protokoll`
--
ALTER TABLE `eigen_vers_protokoll`
  ADD CONSTRAINT `FK_ETVPR_VersammlungID` FOREIGN KEY (`VersammlungID`) REFERENCES `eigen_vers` (`VersammlungID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `gruesse`
--
ALTER TABLE `gruesse`
  ADD CONSTRAINT `FK_G_AbsenderID` FOREIGN KEY (`AbsenderID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_G_EmpfeangerID` FOREIGN KEY (`EmpfaengerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `handwerker`
--
ALTER TABLE `handwerker`
  ADD CONSTRAINT `FK_HW_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HW_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `hausobjekt`
--
ALTER TABLE `hausobjekt`
  ADD CONSTRAINT `FK_HO_AdresseID` FOREIGN KEY (`Adresse`) REFERENCES `adresse` (`AdresseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HO_BesitzerID` FOREIGN KEY (`Besitzer`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `kautionskonto`
--
ALTER TABLE `kautionskonto`
  ADD CONSTRAINT `FK_KK_MieterID` FOREIGN KEY (`MieterID`) REFERENCES `mieter` (`MieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_KK_VermieterID` FOREIGN KEY (`VermieterID`) REFERENCES `vermieter` (`VermieterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `kuendigung`
--
ALTER TABLE `kuendigung`
  ADD CONSTRAINT `FK_KB_MietverhaeltnisID` FOREIGN KEY (`MietverhaeltnisID`) REFERENCES `mietverhaeltnis` (`MietverhaeltnisID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `mieter`
--
ALTER TABLE `mieter`
  ADD CONSTRAINT `FK_M_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_M_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_M_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `mietverhaeltnis`
--
ALTER TABLE `mietverhaeltnis`
  ADD CONSTRAINT `FK_MV_MieterID` FOREIGN KEY (`Mieter`) REFERENCES `mieter` (`MieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_VermieterID` FOREIGN KEY (`Vermieter`) REFERENCES `vermieter` (`VermieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `mkzbescheinigung`
--
ALTER TABLE `mkzbescheinigung`
  ADD CONSTRAINT `FK_MKZ_KautionsKontoID` FOREIGN KEY (`KautionsKontoID`) REFERENCES `kautionskonto` (`KautionsKontoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MKZ_MieterID` FOREIGN KEY (`MieterID`) REFERENCES `mieter` (`MieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MKZ_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MKZ_VermieterID` FOREIGN KEY (`VermieterID`) REFERENCES `vermieter` (`VermieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MKZ_VerwID` FOREIGN KEY (`VermieterID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `nachrichten`
--
ALTER TABLE `nachrichten`
  ADD CONSTRAINT `FK_NA_PostfachID` FOREIGN KEY (`PostfachID`) REFERENCES `postfach` (`PostfachID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `nkabrechnung`
--
ALTER TABLE `nkabrechnung`
  ADD CONSTRAINT `FK_NKA_MieterID` FOREIGN KEY (`MieterID`) REFERENCES `mieter` (`MieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NKA_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NKA_VermieterID` FOREIGN KEY (`VermieterID`) REFERENCES `vermieter` (`VermieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NKA_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `postfach`
--
ALTER TABLE `postfach`
  ADD CONSTRAINT `FK_P_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `rauchmelder`
--
ALTER TABLE `rauchmelder`
  ADD CONSTRAINT `FK_RM_ZimmerID` FOREIGN KEY (`ZimmerID`) REFERENCES `zimmer` (`ZimmerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `vermieter`
--
ALTER TABLE `vermieter`
  ADD CONSTRAINT `FK_VM_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VM_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VM_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `verwalter`
--
ALTER TABLE `verwalter`
  ADD CONSTRAINT `FK_VW_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VW_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VW_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `verwaltungseinheit`
--
ALTER TABLE `verwaltungseinheit`
  ADD CONSTRAINT `FK_Verw_Besitzer` FOREIGN KEY (`Besitzer`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Verw_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `wirtschaftsplan`
--
ALTER TABLE `wirtschaftsplan`
  ADD CONSTRAINT `FK_WP_NKAbrechnungID` FOREIGN KEY (`NkAbrechnungID`) REFERENCES `nkabrechnung` (`NkAbrechnungID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_WP_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `wohngeldkonto`
--
ALTER TABLE `wohngeldkonto`
  ADD CONSTRAINT `FK_WGK_MieterID` FOREIGN KEY (`MieterID`) REFERENCES `mieter` (`MieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_WGK_VermieterID` FOREIGN KEY (`VermieterID`) REFERENCES `vermieter` (`VermieterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zahlungen`
--
ALTER TABLE `zahlungen`
  ADD CONSTRAINT `FK_ZLG_ZahlungsKontoID` FOREIGN KEY (`ZahlungsKontoID`) REFERENCES `zahlungskonto` (`ZahlungsKontoID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zahlungskonto`
--
ALTER TABLE `zahlungskonto`
  ADD CONSTRAINT `FK_ZK_MieterID` FOREIGN KEY (`MieterID`) REFERENCES `mieter` (`MieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ZK_VermieterID` FOREIGN KEY (`VermieterID`) REFERENCES `vermieter` (`VermieterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zimmer`
--
ALTER TABLE `zimmer`
  ADD CONSTRAINT `FK_ZM_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ZM_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Datenbank: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Daten für Tabelle `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"immoverwaltung\",\"table\":\"Hausobjekt\"},{\"db\":\"immoverwaltung\",\"table\":\"mietverhaeltnis\"},{\"db\":\"immoverwaltung\",\"table\":\"mieter\"},{\"db\":\"immoverwaltung\",\"table\":\"nachrichten\"},{\"db\":\"immoverwaltung\",\"table\":\"benutzer\"},{\"db\":\"immoverwaltung\",\"table\":\"postfach\"},{\"db\":\"immoverwaltung\",\"table\":\"zahlungen\"},{\"db\":\"immoverwaltung\",\"table\":\"kautionskonto\"},{\"db\":\"immoverwaltung\",\"table\":\"datensammlung\"},{\"db\":\"immoverwaltung\",\"table\":\"hausobjekt\"}]');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

--
-- Daten für Tabelle `pma__relation`
--

INSERT INTO `pma__relation` (`master_db`, `master_table`, `master_field`, `foreign_db`, `foreign_table`, `foreign_field`) VALUES
('immoverwaltung', 'mieter', 'MieterID', 'immoverwaltung', 'benutzer', 'BenutzerID');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Daten für Tabelle `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('immoverwaltung', 'beschwerde', 'Beschreibung'),
('immoverwaltung', 'eigen_vers_protokoll', 'Dokument'),
('immoverwaltung', 'gruesse', 'Nachricht'),
('immoverwaltung', 'handwerker', 'Kategorie'),
('immoverwaltung', 'hausobjekt', 'Kommentar'),
('immoverwaltung', 'mieter', 'BenutzerID'),
('immoverwaltung', 'nachrichten', 'Text'),
('immoverwaltung', 'rauchmelder', 'Wartung'),
('immoverwaltung', 'verwaltungseinheit', 'Kommentar'),
('immoverwaltung', 'zahlungen', 'Text'),
('immoverwaltung', 'zimmer', 'Bezeichnung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Daten für Tabelle `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2019-05-22 08:13:25', '{\"lang\":\"de\",\"Console\\/Mode\":\"collapse\",\"ThemeDefault\":\"pmahomme\"}');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Daten für Tabelle `pma__users`
--

INSERT INTO `pma__users` (`username`, `usergroup`) VALUES
('admin', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indizes für die Tabelle `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indizes für die Tabelle `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indizes für die Tabelle `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indizes für die Tabelle `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indizes für die Tabelle `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indizes für die Tabelle `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indizes für die Tabelle `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indizes für die Tabelle `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indizes für die Tabelle `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indizes für die Tabelle `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indizes für die Tabelle `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indizes für die Tabelle `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indizes für die Tabelle `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indizes für die Tabelle `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indizes für die Tabelle `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indizes für die Tabelle `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indizes für die Tabelle `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
