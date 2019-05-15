-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Mai 2019 um 16:46
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
  `idAdresse` int(11) NOT NULL,
  `AdresseOrt` varchar(64) NOT NULL,
  `AdressePLZ` int(11) NOT NULL,
  `AdresseStrasse` varchar(64) NOT NULL,
  `AdresseHausnummer` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `idBenutzer` int(11) NOT NULL,
  `BenutzerName` varchar(32) NOT NULL,
  `BenutzerEmail` varchar(64) NOT NULL,
  `BenutzerPasswort` varchar(45) NOT NULL,
  `BenutzerVorname` varchar(45) NOT NULL,
  `BenutzerGeburtstag` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datensammlung`
--

CREATE TABLE `datensammlung` (
  `idDatensammlung` int(11) NOT NULL,
  `DatensammlungBenutzerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigentuemer`
--

CREATE TABLE `eigentuemer` (
  `idEigentuemer` int(11) NOT NULL,
  `EigentuemerBenutzerID` int(11) NOT NULL,
  `EigentuemerObjektID` int(11) NOT NULL,
  `EigentuemerVeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigentuemerversammlung`
--

CREATE TABLE `eigentuemerversammlung` (
  `idEigentuemerversammlung` int(11) NOT NULL,
  `EigentuemerversammlungObjektID` int(11) NOT NULL,
  `EigentuemerversammlungDatum` date NOT NULL,
  `EigentuemerversammlungProtokollID` int(11) DEFAULT NULL,
  `EigentuemerversammlungPersonenID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigentuemerversammlungpersonen`
--

CREATE TABLE `eigentuemerversammlungpersonen` (
  `idEigentuemerversammlung` int(11) NOT NULL,
  `EigentuemerversammlungPersonenBenutzerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigentuemerversammlungprotokoll`
--

CREATE TABLE `eigentuemerversammlungprotokoll` (
  `idEigentuemerVersammlungProtokoll` int(11) NOT NULL,
  `EigentuemerVersammlungID` int(11) NOT NULL,
  `EigentuemerVersammlungProtokollDokument` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gruesse`
--

CREATE TABLE `gruesse` (
  `idGruesse` int(11) NOT NULL,
  `GruesseEmpfaengerID` int(11) NOT NULL,
  `GruesseAbsenderID` int(11) NOT NULL,
  `GruesseNachricht` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `handwerker`
--

CREATE TABLE `handwerker` (
  `idHandwerker` int(11) NOT NULL,
  `HandwerkerKategorie` varchar(45) DEFAULT NULL,
  `HandwerkerName` varchar(45) DEFAULT NULL,
  `HandwerkerKommentar` varchar(256) DEFAULT NULL,
  `HandwerkerVeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hausobjekt`
--

CREATE TABLE `hausobjekt` (
  `idHausobjekt` int(11) NOT NULL,
  `HausobjektAdresseID` int(11) NOT NULL,
  `HausobjektKommentar` varchar(128) DEFAULT NULL,
  `HausobjektBesitzerID` int(11) DEFAULT NULL,
  `HausobjektTypID` int(11) NOT NULL,
  `HausobjektLageplan` blob,
  `HausobjektBauplan` blob,
  `HausobjektVersammlung` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hausobjekttyp`
--

CREATE TABLE `hausobjekttyp` (
  `idHausobjektTyp` int(11) NOT NULL,
  `HausobjektTyp` varchar(64) NOT NULL,
  `HausobjektTypHausobjektID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kautionskonto`
--

CREATE TABLE `kautionskonto` (
  `idKautionskonto` int(11) NOT NULL,
  `KautionskontoSaldo` int(11) NOT NULL,
  `KautionskontoZinsen` int(11) DEFAULT NULL,
  `KautionskontoMieterID` int(11) NOT NULL,
  `KautionskontoVermieterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kuendigungsbestaetigung`
--

CREATE TABLE `kuendigungsbestaetigung` (
  `idKuendigungsbestaetigung` int(11) NOT NULL,
  `KuendigungsbestaetigungMietverhaeltnisID` int(11) NOT NULL,
  `KuendigungsbestaetigungDatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mieter`
--

CREATE TABLE `mieter` (
  `idMieter` int(11) NOT NULL,
  `MieterBenutzerID` int(11) NOT NULL,
  `MieterObjektID` int(11) NOT NULL,
  `MieterVerwaltungseinheitID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mietkautionszinsbescheinigung`
--

CREATE TABLE `mietkautionszinsbescheinigung` (
  `idMietkautionszinsbescheinigung` int(11) NOT NULL,
  `MietkautionszinsbescheinigungObjektID` int(11) NOT NULL,
  `MietkautionszinsbescheinigungKautionskontoID` int(11) NOT NULL,
  `MietkautionszinsbescheinigungMieterID` int(11) NOT NULL,
  `MietkautionszinsbescheinigungVermieterID` int(11) NOT NULL,
  `MietkautionszinsbescheinigungVeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mietverhaeltnis`
--

CREATE TABLE `mietverhaeltnis` (
  `idMietverhaeltnis` int(11) NOT NULL,
  `MietverhaeltnisVerwaltungseinheit` int(11) DEFAULT NULL,
  `MietverhaeltnisVermieterID` int(11) NOT NULL,
  `MietverhaeltnisMieterID` int(11) NOT NULL,
  `MietverhaeltnisBeginn` date DEFAULT NULL,
  `MietverhaeltnisEnde` date DEFAULT NULL,
  `MietverhaeltnisHausObjektID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nebenkostenabrechnung`
--

CREATE TABLE `nebenkostenabrechnung` (
  `idNebenkostenabrechnung` int(11) NOT NULL,
  `NebenkostenabrechnungObjekt` int(11) NOT NULL,
  `NebenkostenabrechnungVerwaltungseinheit` int(11) DEFAULT NULL,
  `NebenkostenabrechnungMieter` int(11) NOT NULL,
  `NebenkostenabrechnungVermieter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `postfach`
--

CREATE TABLE `postfach` (
  `idPostfach` int(11) NOT NULL,
  `PostfachBenutzerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rauchmelder`
--

CREATE TABLE `rauchmelder` (
  `idRauchmelder` int(11) NOT NULL,
  `RauchmelderZimmerID` int(11) NOT NULL,
  `RauchmelderVerbaut` tinyint(4) NOT NULL,
  `RauchmelderWartung` varchar(45) DEFAULT NULL,
  `RauchmelderInstalliert` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reparaturbeschwerdeeinrichtung`
--

CREATE TABLE `reparaturbeschwerdeeinrichtung` (
  `idReparaturBeschwerdeeinrichtung` int(11) NOT NULL,
  `ReparaturBeschwerdeeinrichtungVeID` int(11) NOT NULL,
  `ReparaturBeschwerdeeinrichtungBenutzerID` int(11) NOT NULL,
  `ReparaturBeschwerdeeinrichtungBeschreibung` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vermieter`
--

CREATE TABLE `vermieter` (
  `idVermieter` int(11) NOT NULL,
  `VermieterBenutzerID` int(11) NOT NULL,
  `VermieterObjektID` int(11) NOT NULL,
  `VermieterVerwaltungseinheitID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verwalter`
--

CREATE TABLE `verwalter` (
  `idVerwalter` int(11) NOT NULL,
  `VerwalterBenutzerID` int(11) NOT NULL,
  `VerwalterObjektID` int(11) NOT NULL,
  `VerwalterVerwaltungseinheitID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verwaltungseinheit`
--

CREATE TABLE `verwaltungseinheit` (
  `idVerwaltungseinheit` int(11) NOT NULL,
  `VerwaltungseinheitObjektID` int(11) DEFAULT NULL,
  `VerwaltungseinheitKommentar` varchar(45) DEFAULT NULL,
  `VerwaltungseinheitBesitzerID` int(11) DEFAULT NULL,
  `VerwaltungseinheitWohnfläche` int(11) DEFAULT NULL,
  `VerwaltungseinheitTyp` int(11) DEFAULT NULL,
  `VerwaltungseinheitBauplan` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verwaltungseinheittyp`
--

CREATE TABLE `verwaltungseinheittyp` (
  `idVerwaltungseinheitTyp` int(11) NOT NULL,
  `Verwaltungseinheit` int(11) DEFAULT NULL,
  `VerwaltungseinheitTyp` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wirtschaftsplan`
--

CREATE TABLE `wirtschaftsplan` (
  `idWirtschaftsplan` int(11) NOT NULL,
  `WirtschaftsplanObjekt` int(11) NOT NULL,
  `WirtschaftsplanNKAbrechnung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wohngeldkonto`
--

CREATE TABLE `wohngeldkonto` (
  `idWohngeldkonto` int(11) NOT NULL,
  `WohngeldkontoMieterID` int(11) NOT NULL,
  `WohngeldkontoVermieterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungen`
--

CREATE TABLE `zahlungen` (
  `idZahlungen` int(11) NOT NULL,
  `ZahlungenKontoID` int(11) NOT NULL,
  `ZahlungenBetrag` double NOT NULL,
  `ZahlungenText` varchar(128) DEFAULT NULL,
  `ZahlungenDatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungskonto`
--

CREATE TABLE `zahlungskonto` (
  `idZahlungsKonto` int(11) NOT NULL,
  `ZahlungsKontoSaldo` int(11) DEFAULT NULL,
  `ZahlungsKontoMieter` int(11) DEFAULT NULL,
  `ZahlungsKontoVermieter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zimmer`
--

CREATE TABLE `zimmer` (
  `idZimmer` int(11) NOT NULL,
  `ZimmerVerwaltungseinheit` int(11) DEFAULT NULL,
  `ZimmerName` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zuordnungobjekt`
--

CREATE TABLE `zuordnungobjekt` (
  `idZuordnungObjekt` int(11) NOT NULL,
  `ZuordnungObjektBenutzer` int(11) DEFAULT NULL,
  `ZuordnungObjektHausobjekt` int(11) DEFAULT NULL,
  `ZuordnungObjektRolle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zuordnungve`
--

CREATE TABLE `zuordnungve` (
  `idZuordnungVe` int(11) NOT NULL,
  `ZuordnungVeVerwaltungseinheit` int(11) DEFAULT NULL,
  `ZuordnungVeBenutzer` int(11) DEFAULT NULL,
  `ZuordnungVeRolle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`idAdresse`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`idBenutzer`);

--
-- Indizes für die Tabelle `datensammlung`
--
ALTER TABLE `datensammlung`
  ADD PRIMARY KEY (`idDatensammlung`);

--
-- Indizes für die Tabelle `eigentuemer`
--
ALTER TABLE `eigentuemer`
  ADD PRIMARY KEY (`idEigentuemer`);

--
-- Indizes für die Tabelle `eigentuemerversammlung`
--
ALTER TABLE `eigentuemerversammlung`
  ADD PRIMARY KEY (`idEigentuemerversammlung`);

--
-- Indizes für die Tabelle `eigentuemerversammlungpersonen`
--
ALTER TABLE `eigentuemerversammlungpersonen`
  ADD PRIMARY KEY (`idEigentuemerversammlung`);

--
-- Indizes für die Tabelle `eigentuemerversammlungprotokoll`
--
ALTER TABLE `eigentuemerversammlungprotokoll`
  ADD PRIMARY KEY (`idEigentuemerVersammlungProtokoll`);

--
-- Indizes für die Tabelle `gruesse`
--
ALTER TABLE `gruesse`
  ADD PRIMARY KEY (`idGruesse`);

--
-- Indizes für die Tabelle `handwerker`
--
ALTER TABLE `handwerker`
  ADD PRIMARY KEY (`idHandwerker`);

--
-- Indizes für die Tabelle `hausobjekt`
--
ALTER TABLE `hausobjekt`
  ADD PRIMARY KEY (`idHausobjekt`);

--
-- Indizes für die Tabelle `hausobjekttyp`
--
ALTER TABLE `hausobjekttyp`
  ADD PRIMARY KEY (`idHausobjektTyp`);

--
-- Indizes für die Tabelle `kautionskonto`
--
ALTER TABLE `kautionskonto`
  ADD PRIMARY KEY (`idKautionskonto`);

--
-- Indizes für die Tabelle `kuendigungsbestaetigung`
--
ALTER TABLE `kuendigungsbestaetigung`
  ADD PRIMARY KEY (`idKuendigungsbestaetigung`);

--
-- Indizes für die Tabelle `mieter`
--
ALTER TABLE `mieter`
  ADD PRIMARY KEY (`idMieter`);

--
-- Indizes für die Tabelle `mietkautionszinsbescheinigung`
--
ALTER TABLE `mietkautionszinsbescheinigung`
  ADD PRIMARY KEY (`idMietkautionszinsbescheinigung`);

--
-- Indizes für die Tabelle `mietverhaeltnis`
--
ALTER TABLE `mietverhaeltnis`
  ADD PRIMARY KEY (`idMietverhaeltnis`);

--
-- Indizes für die Tabelle `nebenkostenabrechnung`
--
ALTER TABLE `nebenkostenabrechnung`
  ADD PRIMARY KEY (`idNebenkostenabrechnung`);

--
-- Indizes für die Tabelle `postfach`
--
ALTER TABLE `postfach`
  ADD PRIMARY KEY (`idPostfach`);

--
-- Indizes für die Tabelle `rauchmelder`
--
ALTER TABLE `rauchmelder`
  ADD PRIMARY KEY (`idRauchmelder`);

--
-- Indizes für die Tabelle `reparaturbeschwerdeeinrichtung`
--
ALTER TABLE `reparaturbeschwerdeeinrichtung`
  ADD PRIMARY KEY (`idReparaturBeschwerdeeinrichtung`);

--
-- Indizes für die Tabelle `vermieter`
--
ALTER TABLE `vermieter`
  ADD PRIMARY KEY (`idVermieter`);

--
-- Indizes für die Tabelle `verwalter`
--
ALTER TABLE `verwalter`
  ADD PRIMARY KEY (`idVerwalter`);

--
-- Indizes für die Tabelle `verwaltungseinheit`
--
ALTER TABLE `verwaltungseinheit`
  ADD PRIMARY KEY (`idVerwaltungseinheit`);

--
-- Indizes für die Tabelle `verwaltungseinheittyp`
--
ALTER TABLE `verwaltungseinheittyp`
  ADD PRIMARY KEY (`idVerwaltungseinheitTyp`);

--
-- Indizes für die Tabelle `wirtschaftsplan`
--
ALTER TABLE `wirtschaftsplan`
  ADD PRIMARY KEY (`idWirtschaftsplan`);

--
-- Indizes für die Tabelle `wohngeldkonto`
--
ALTER TABLE `wohngeldkonto`
  ADD PRIMARY KEY (`idWohngeldkonto`);

--
-- Indizes für die Tabelle `zahlungen`
--
ALTER TABLE `zahlungen`
  ADD PRIMARY KEY (`idZahlungen`);

--
-- Indizes für die Tabelle `zahlungskonto`
--
ALTER TABLE `zahlungskonto`
  ADD PRIMARY KEY (`idZahlungsKonto`);

--
-- Indizes für die Tabelle `zimmer`
--
ALTER TABLE `zimmer`
  ADD PRIMARY KEY (`idZimmer`);

--
-- Indizes für die Tabelle `zuordnungobjekt`
--
ALTER TABLE `zuordnungobjekt`
  ADD PRIMARY KEY (`idZuordnungObjekt`);

--
-- Indizes für die Tabelle `zuordnungve`
--
ALTER TABLE `zuordnungve`
  ADD PRIMARY KEY (`idZuordnungVe`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adresse`
--
ALTER TABLE `adresse`
  MODIFY `idAdresse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `idBenutzer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `datensammlung`
--
ALTER TABLE `datensammlung`
  MODIFY `idDatensammlung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `eigentuemer`
--
ALTER TABLE `eigentuemer`
  MODIFY `idEigentuemer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `eigentuemerversammlung`
--
ALTER TABLE `eigentuemerversammlung`
  MODIFY `idEigentuemerversammlung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `eigentuemerversammlungprotokoll`
--
ALTER TABLE `eigentuemerversammlungprotokoll`
  MODIFY `idEigentuemerVersammlungProtokoll` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gruesse`
--
ALTER TABLE `gruesse`
  MODIFY `idGruesse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `handwerker`
--
ALTER TABLE `handwerker`
  MODIFY `idHandwerker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `hausobjekt`
--
ALTER TABLE `hausobjekt`
  MODIFY `idHausobjekt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `hausobjekttyp`
--
ALTER TABLE `hausobjekttyp`
  MODIFY `idHausobjektTyp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kautionskonto`
--
ALTER TABLE `kautionskonto`
  MODIFY `idKautionskonto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kuendigungsbestaetigung`
--
ALTER TABLE `kuendigungsbestaetigung`
  MODIFY `idKuendigungsbestaetigung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mieter`
--
ALTER TABLE `mieter`
  MODIFY `idMieter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mietverhaeltnis`
--
ALTER TABLE `mietverhaeltnis`
  MODIFY `idMietverhaeltnis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `nebenkostenabrechnung`
--
ALTER TABLE `nebenkostenabrechnung`
  MODIFY `idNebenkostenabrechnung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `postfach`
--
ALTER TABLE `postfach`
  MODIFY `idPostfach` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `rauchmelder`
--
ALTER TABLE `rauchmelder`
  MODIFY `idRauchmelder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `reparaturbeschwerdeeinrichtung`
--
ALTER TABLE `reparaturbeschwerdeeinrichtung`
  MODIFY `idReparaturBeschwerdeeinrichtung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vermieter`
--
ALTER TABLE `vermieter`
  MODIFY `idVermieter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verwalter`
--
ALTER TABLE `verwalter`
  MODIFY `idVerwalter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verwaltungseinheit`
--
ALTER TABLE `verwaltungseinheit`
  MODIFY `idVerwaltungseinheit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verwaltungseinheittyp`
--
ALTER TABLE `verwaltungseinheittyp`
  MODIFY `idVerwaltungseinheitTyp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wirtschaftsplan`
--
ALTER TABLE `wirtschaftsplan`
  MODIFY `idWirtschaftsplan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zahlungskonto`
--
ALTER TABLE `zahlungskonto`
  MODIFY `idZahlungsKonto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zimmer`
--
ALTER TABLE `zimmer`
  MODIFY `idZimmer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zuordnungobjekt`
--
ALTER TABLE `zuordnungobjekt`
  MODIFY `idZuordnungObjekt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zuordnungve`
--
ALTER TABLE `zuordnungve`
  MODIFY `idZuordnungVe` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
