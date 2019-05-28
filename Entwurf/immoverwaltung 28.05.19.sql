-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Mai 2019 um 14:01
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
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `BenutzerID` int(11) NOT NULL,
  `Vorname` varchar(32) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Passwort` varchar(45) NOT NULL,
  `Strasse` varchar(64) DEFAULT NULL,
  `Hausnr` varchar(6) DEFAULT NULL,
  `PLZ` varchar(6) DEFAULT NULL,
  `Ort` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`BenutzerID`, `Vorname`, `Name`, `Email`, `Passwort`, `Strasse`, `Hausnr`, `PLZ`, `Ort`) VALUES
(9, 'Hans', 'Manz', 'test@test.com', '1234', 'Hans-Strasse', '222', '55555', 'Hansestadt'),
(10, 'Peter', 'Zwegat', '1234@1234.de', '1234', 'Butzemannweg', '420', '42042', 'Butzstadt'),
(11, 'Manfred', 'Fraufred', '1234@gmx.de', '1234', 'Hans-Peter-Str.', '205', '13337', 'Leethausen'),
(12, 'Dieter', 'Bohlen', 'dieter@bohlen.de', '1234', 'Bohlingbahn', '20', '98765', 'Berlin');

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
  `VerwID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `eigentuemer`
--

INSERT INTO `eigentuemer` (`EigentuemerID`, `BenutzerID`, `ObjektID`, `VerwID`) VALUES
(1, 11, 1, NULL);

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
-- Tabellenstruktur für Tabelle `ev_abstimmungsergebnis`
--

CREATE TABLE `ev_abstimmungsergebnis` (
  `BeschluesseID` int(11) NOT NULL,
  `Stimmen` varchar(128) NOT NULL,
  `Ergebnis` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ev_beschluesse`
--

CREATE TABLE `ev_beschluesse` (
  `BeschluesseID` int(11) NOT NULL,
  `Text` varchar(512) NOT NULL,
  `Abst_Typ` varchar(128) NOT NULL,
  `Regel` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ev_beschlussfaehigkeit`
--

CREATE TABLE `ev_beschlussfaehigkeit` (
  `BeschlussfkID` int(11) NOT NULL,
  `Kommentar` varchar(128) NOT NULL,
  `Anwesend` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ev_personen`
--

CREATE TABLE `ev_personen` (
  `VersammlungID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Eigentuemerversammlung Personen';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ev_protokoll`
--

CREATE TABLE `ev_protokoll` (
  `Protokoll_ID` int(11) NOT NULL,
  `VersammlungID` int(11) NOT NULL,
  `Dokument` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Eigentuemerversammlung Protokoll';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ev_protokoll_baustein`
--

CREATE TABLE `ev_protokoll_baustein` (
  `BausteinID` int(11) NOT NULL,
  `Text` varchar(1024) NOT NULL,
  `Nr` int(11) NOT NULL,
  `Ueberschrift` varchar(128) NOT NULL,
  `Protokoll_ID` int(11) NOT NULL,
  `BeschlussfkID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ev_protokoll_header`
--

CREATE TABLE `ev_protokoll_header` (
  `HeaderID` int(11) NOT NULL,
  `VerwalterID` int(11) NOT NULL,
  `Ort` varchar(64) NOT NULL,
  `Jahr` int(4) NOT NULL,
  `Startzeit` datetime NOT NULL,
  `Endzeit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `Name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `handwerkerverwaltung`
--

CREATE TABLE `handwerkerverwaltung` (
  `HandwerkerID` int(11) NOT NULL,
  `KategorieID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) NOT NULL,
  `Aufgabenbeschreibung` varchar(128) NOT NULL,
  `Kommentar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `handwerker_kategorie`
--

CREATE TABLE `handwerker_kategorie` (
  `KategorieID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hausobjekt`
--

CREATE TABLE `hausobjekt` (
  `ObjektID` int(11) NOT NULL,
  `Kommentar` varchar(128) DEFAULT NULL,
  `Besitzer` int(11) DEFAULT NULL,
  `Typ` enum('Einfamilienhaus','Zweifamilienhaus','Doppelhaus','Reihenhaus','Mehrfamilienhaus','Wohnhochhaus','Villa','Schloss','Wohn- und Geschäftsgebäude','Geschäftsgebäude','andere','') DEFAULT NULL,
  `Lageplan` blob,
  `Bauplan` blob,
  `Versammlung` tinyint(4) DEFAULT NULL,
  `Strasse` varchar(64) NOT NULL,
  `Hausnr` varchar(5) NOT NULL,
  `PLZ` varchar(5) NOT NULL,
  `Ort` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `hausobjekt`
--

INSERT INTO `hausobjekt` (`ObjektID`, `Kommentar`, `Besitzer`, `Typ`, `Lageplan`, `Bauplan`, `Versammlung`, `Strasse`, `Hausnr`, `PLZ`, `Ort`) VALUES
(1, 'Noble Gegend', 10, 'Villa', NULL, NULL, 1, '', '', '', ''),
(2, 'Top Lage', 11, 'Schloss', NULL, NULL, 1, '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kautionskonto`
--

CREATE TABLE `kautionskonto` (
  `KautionsKontoID` int(11) NOT NULL,
  `Saldo` int(11) NOT NULL,
  `Zinsen` int(11) DEFAULT NULL,
  `MietverhaeltnisID` int(11) NOT NULL
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

--
-- Daten für Tabelle `mietverhaeltnis`
--

INSERT INTO `mietverhaeltnis` (`MietverhaeltnisID`, `VerwID`, `Vermieter`, `Mieter`, `Beginn`, `Ende`, `ObjektID`) VALUES
(2, NULL, 11, 12, '2019-05-01', '2020-06-01', 2),
(3, NULL, 11, 9, '2019-05-01', '2019-12-31', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mkzbescheinigung`
--

CREATE TABLE `mkzbescheinigung` (
  `MkzBescheinigungID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `KautionsKontoID` int(11) NOT NULL,
  `MietverhaeltnisID` int(11) NOT NULL,
  `VerwID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Mietkautionszinsbescheinigung';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nachrichten`
--

CREATE TABLE `nachrichten` (
  `NachrichtID` int(11) NOT NULL,
  `SenderID` int(11) NOT NULL,
  `EmpfaengerID` int(11) NOT NULL,
  `Text` varchar(256) NOT NULL,
  `Datei` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nkabrechnung`
--

CREATE TABLE `nkabrechnung` (
  `NkAbrechnungID` int(11) NOT NULL,
  `ObjektID` int(11) NOT NULL,
  `VerwID` int(11) DEFAULT NULL,
  `MietverhaeltnisID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Nebenkostenabrechnung';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `postfach`
--

CREATE TABLE `postfach` (
  `PostfachID` int(11) NOT NULL,
  `BenutzerID` int(11) NOT NULL,
  `NachrichtID` int(11) NOT NULL
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

--
-- Daten für Tabelle `verwaltungseinheit`
--

INSERT INTO `verwaltungseinheit` (`VerwID`, `ObjektID`, `Kommentar`, `Besitzer`, `Wohnfläche`, `Typ`, `Bauplan`) VALUES
(1, 2, 'Kerkerwohnung', 11, 100, 'Wohnung', NULL),
(2, 1, 'Gartenhütte', 9, 10, 'Wohnung', NULL);

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
  `MietverhaeltnisID` int(11) NOT NULL
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
  `MietverhaeltnisID` int(11) NOT NULL,
  `Saldo` int(11) DEFAULT NULL
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
-- Indizes für die Tabelle `ev_abstimmungsergebnis`
--
ALTER TABLE `ev_abstimmungsergebnis`
  ADD KEY `Beschluesse` (`BeschluesseID`);

--
-- Indizes für die Tabelle `ev_beschluesse`
--
ALTER TABLE `ev_beschluesse`
  ADD PRIMARY KEY (`BeschluesseID`);

--
-- Indizes für die Tabelle `ev_beschlussfaehigkeit`
--
ALTER TABLE `ev_beschlussfaehigkeit`
  ADD PRIMARY KEY (`BeschlussfkID`);

--
-- Indizes für die Tabelle `ev_personen`
--
ALTER TABLE `ev_personen`
  ADD KEY `VersammlungID` (`VersammlungID`) USING BTREE,
  ADD KEY `BenutzerID` (`BenutzerID`);

--
-- Indizes für die Tabelle `ev_protokoll`
--
ALTER TABLE `ev_protokoll`
  ADD PRIMARY KEY (`Protokoll_ID`),
  ADD KEY `Versammlung` (`VersammlungID`);

--
-- Indizes für die Tabelle `ev_protokoll_baustein`
--
ALTER TABLE `ev_protokoll_baustein`
  ADD PRIMARY KEY (`BausteinID`),
  ADD KEY `Beschlussfk` (`BeschlussfkID`),
  ADD KEY `Protokoll` (`Protokoll_ID`) USING BTREE;

--
-- Indizes für die Tabelle `ev_protokoll_header`
--
ALTER TABLE `ev_protokoll_header`
  ADD PRIMARY KEY (`HeaderID`),
  ADD KEY `Verwalter` (`VerwalterID`);

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
  ADD PRIMARY KEY (`HandwerkerID`);

--
-- Indizes für die Tabelle `handwerkerverwaltung`
--
ALTER TABLE `handwerkerverwaltung`
  ADD KEY `Handwerker` (`HandwerkerID`),
  ADD KEY `Kategorie` (`KategorieID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `Verw` (`VerwID`);

--
-- Indizes für die Tabelle `handwerker_kategorie`
--
ALTER TABLE `handwerker_kategorie`
  ADD PRIMARY KEY (`KategorieID`) USING BTREE;

--
-- Indizes für die Tabelle `hausobjekt`
--
ALTER TABLE `hausobjekt`
  ADD PRIMARY KEY (`ObjektID`),
  ADD KEY `Besitzer` (`Besitzer`);

--
-- Indizes für die Tabelle `kautionskonto`
--
ALTER TABLE `kautionskonto`
  ADD PRIMARY KEY (`KautionsKontoID`),
  ADD KEY `Mietverhaeltnis` (`MietverhaeltnisID`) USING BTREE;

--
-- Indizes für die Tabelle `kuendigung`
--
ALTER TABLE `kuendigung`
  ADD PRIMARY KEY (`KuendigungID`),
  ADD KEY `Mietverhältnis` (`MietverhaeltnisID`);

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
  ADD KEY `Verw` (`VerwID`),
  ADD KEY `Mietverhaeltnis` (`MietverhaeltnisID`) USING BTREE;

--
-- Indizes für die Tabelle `nachrichten`
--
ALTER TABLE `nachrichten`
  ADD PRIMARY KEY (`NachrichtID`),
  ADD KEY `Sender` (`SenderID`),
  ADD KEY `Empfaenger` (`EmpfaengerID`);

--
-- Indizes für die Tabelle `nkabrechnung`
--
ALTER TABLE `nkabrechnung`
  ADD PRIMARY KEY (`NkAbrechnungID`),
  ADD KEY `Objekt` (`ObjektID`),
  ADD KEY `Verw` (`VerwID`) USING BTREE,
  ADD KEY `Mietverhaeltnis` (`MietverhaeltnisID`);

--
-- Indizes für die Tabelle `postfach`
--
ALTER TABLE `postfach`
  ADD PRIMARY KEY (`PostfachID`),
  ADD KEY `Benutzer` (`BenutzerID`),
  ADD KEY `Nachricht` (`NachrichtID`) USING BTREE;

--
-- Indizes für die Tabelle `rauchmelder`
--
ALTER TABLE `rauchmelder`
  ADD PRIMARY KEY (`RauchmelderID`),
  ADD KEY `Zimmer` (`ZimmerID`);

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
  ADD KEY `Mietverhaeltnis` (`MietverhaeltnisID`);

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
  ADD KEY `Mietverhaeltnis` (`MietverhaeltnisID`);

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
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `BenutzerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT für Tabelle `ev_beschluesse`
--
ALTER TABLE `ev_beschluesse`
  MODIFY `BeschluesseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `ev_beschlussfaehigkeit`
--
ALTER TABLE `ev_beschlussfaehigkeit`
  MODIFY `BeschlussfkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `ev_protokoll`
--
ALTER TABLE `ev_protokoll`
  MODIFY `Protokoll_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `ev_protokoll_baustein`
--
ALTER TABLE `ev_protokoll_baustein`
  MODIFY `BausteinID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `ev_protokoll_header`
--
ALTER TABLE `ev_protokoll_header`
  MODIFY `HeaderID` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT für Tabelle `handwerker_kategorie`
--
ALTER TABLE `handwerker_kategorie`
  MODIFY `KategorieID` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT für Tabelle `mietverhaeltnis`
--
ALTER TABLE `mietverhaeltnis`
  MODIFY `MietverhaeltnisID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT für Tabelle `verwalter`
--
ALTER TABLE `verwalter`
  MODIFY `VerwalterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verwaltungseinheit`
--
ALTER TABLE `verwaltungseinheit`
  MODIFY `VerwID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `FK_ETV_Protokoll_ID` FOREIGN KEY (`Protokoll_ID`) REFERENCES `ev_protokoll` (`Protokoll_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `ev_abstimmungsergebnis`
--
ALTER TABLE `ev_abstimmungsergebnis`
  ADD CONSTRAINT `FK_EV_AB_BeschluesseID` FOREIGN KEY (`BeschluesseID`) REFERENCES `ev_beschluesse` (`BeschluesseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `ev_personen`
--
ALTER TABLE `ev_personen`
  ADD CONSTRAINT `FK_ETVP_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ETVP_VersammlungID` FOREIGN KEY (`VersammlungID`) REFERENCES `eigen_vers` (`VersammlungID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `ev_protokoll`
--
ALTER TABLE `ev_protokoll`
  ADD CONSTRAINT `FK_ETVPR_VersammlungID` FOREIGN KEY (`VersammlungID`) REFERENCES `eigen_vers` (`VersammlungID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `ev_protokoll_baustein`
--
ALTER TABLE `ev_protokoll_baustein`
  ADD CONSTRAINT `FK_EV_P_BA_BeschlussfkID` FOREIGN KEY (`BeschlussfkID`) REFERENCES `ev_beschlussfaehigkeit` (`BeschlussfkID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EV_P_BA_Protokoll_ID` FOREIGN KEY (`Protokoll_ID`) REFERENCES `ev_protokoll` (`Protokoll_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `ev_protokoll_header`
--
ALTER TABLE `ev_protokoll_header`
  ADD CONSTRAINT `EV_P_H_VerwalterID` FOREIGN KEY (`VerwalterID`) REFERENCES `verwalter` (`VerwalterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `gruesse`
--
ALTER TABLE `gruesse`
  ADD CONSTRAINT `FK_G_AbsenderID` FOREIGN KEY (`AbsenderID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_G_EmpfeangerID` FOREIGN KEY (`EmpfaengerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `handwerkerverwaltung`
--
ALTER TABLE `handwerkerverwaltung`
  ADD CONSTRAINT `FK_HWV_HandwerkerID` FOREIGN KEY (`HandwerkerID`) REFERENCES `handwerker` (`HandwerkerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HWV_KategorieID` FOREIGN KEY (`KategorieID`) REFERENCES `handwerker_kategorie` (`KategorieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HWV_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HWV_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `hausobjekt`
--
ALTER TABLE `hausobjekt`
  ADD CONSTRAINT `FK_HO_BesitzerID` FOREIGN KEY (`Besitzer`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `kautionskonto`
--
ALTER TABLE `kautionskonto`
  ADD CONSTRAINT `FK_KK_MietverhaeltnisID` FOREIGN KEY (`MietverhaeltnisID`) REFERENCES `mietverhaeltnis` (`MietverhaeltnisID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `kuendigung`
--
ALTER TABLE `kuendigung`
  ADD CONSTRAINT `FK_KB_MietverhaeltnisID` FOREIGN KEY (`MietverhaeltnisID`) REFERENCES `mietverhaeltnis` (`MietverhaeltnisID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `mietverhaeltnis`
--
ALTER TABLE `mietverhaeltnis`
  ADD CONSTRAINT `FK_MV_MieterID` FOREIGN KEY (`Mieter`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_VermieterID` FOREIGN KEY (`Vermieter`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MV_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `mkzbescheinigung`
--
ALTER TABLE `mkzbescheinigung`
  ADD CONSTRAINT `FK_MKZ_KautionsKontoID` FOREIGN KEY (`KautionsKontoID`) REFERENCES `kautionskonto` (`KautionsKontoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MKZ_MietverhaeltnisID` FOREIGN KEY (`MietverhaeltnisID`) REFERENCES `mietverhaeltnis` (`MietverhaeltnisID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MKZ_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MKZ_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `nachrichten`
--
ALTER TABLE `nachrichten`
  ADD CONSTRAINT `FK_NA_EmpfaengerID` FOREIGN KEY (`EmpfaengerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NA_SenderID` FOREIGN KEY (`SenderID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `nkabrechnung`
--
ALTER TABLE `nkabrechnung`
  ADD CONSTRAINT `FK_NKA_MietverhaeltnisID` FOREIGN KEY (`MietverhaeltnisID`) REFERENCES `mietverhaeltnis` (`MietverhaeltnisID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NKA_ObjektID` FOREIGN KEY (`ObjektID`) REFERENCES `hausobjekt` (`ObjektID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NKA_VerwID` FOREIGN KEY (`VerwID`) REFERENCES `verwaltungseinheit` (`VerwID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `postfach`
--
ALTER TABLE `postfach`
  ADD CONSTRAINT `FK_P_BenutzerID` FOREIGN KEY (`BenutzerID`) REFERENCES `benutzer` (`BenutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_P_NachrichtID` FOREIGN KEY (`NachrichtID`) REFERENCES `nachrichten` (`NachrichtID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `rauchmelder`
--
ALTER TABLE `rauchmelder`
  ADD CONSTRAINT `FK_RM_ZimmerID` FOREIGN KEY (`ZimmerID`) REFERENCES `zimmer` (`ZimmerID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_WGK_MietverhaeltnisID` FOREIGN KEY (`MietverhaeltnisID`) REFERENCES `mietverhaeltnis` (`MietverhaeltnisID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zahlungen`
--
ALTER TABLE `zahlungen`
  ADD CONSTRAINT `FK_ZLG_ZahlungsKontoID` FOREIGN KEY (`ZahlungsKontoID`) REFERENCES `zahlungskonto` (`ZahlungsKontoID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zahlungskonto`
--
ALTER TABLE `zahlungskonto`
  ADD CONSTRAINT `FK_ZK_MietverhaeltnisID` FOREIGN KEY (`MietverhaeltnisID`) REFERENCES `mietverhaeltnis` (`MietverhaeltnisID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
