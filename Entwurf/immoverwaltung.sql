-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Mai 2019 um 12:34
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
(10, '', '1234', '1234@1234.de', '1234');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `beschwerde`
--

CREATE TABLE `beschwerde` (
  `BeschwerdeID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL,
  `BenutzerID` int(11) NOT NULL,
  `Beschreibung` varchar(256) DEFAULT NULL
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
  `VerwID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `VermieterID` int(11) NOT NULL,
  `MieterID` int(11) NOT NULL,
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
  ADD KEY `BenutzerID` (`BenutzerID`);

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
  ADD KEY `Vermieter` (`VermieterID`),
  ADD KEY `Mieter` (`MieterID`),
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
  MODIFY `AdresseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `BenutzerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `EigentuemerID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ObjektID` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `FK_MV_MieterID` FOREIGN KEY (`MieterID`) REFERENCES `mieter` (`MieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_VermieterID` FOREIGN KEY (`VermieterID`) REFERENCES `vermieter` (`VermieterID`) ON DELETE CASCADE ON UPDATE CASCADE,
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
