-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Mai 2019 um 21:18
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
  `BenutzerVorname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`idBenutzer`, `BenutzerName`, `BenutzerEmail`, `BenutzerPasswort`, `BenutzerVorname`) VALUES
(1, 'efsydf', 'dfsafas', '202cb962ac59075b964b07152d234b70', '');

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
  MODIFY `idBenutzer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
('root', '[{\"db\":\"immoverwaltung\",\"table\":\"benutzer\"},{\"db\":\"immoverwaltung\",\"table\":\"eigentuemer\"},{\"db\":\"immoverwaltung\",\"table\":\"Eigentuemer\"},{\"db\":\"immoverwaltung\",\"table\":\"datensammlung\"},{\"db\":\"immoverwaltung\",\"table\":\"adresse\"},{\"db\":\"immoverwaltung\",\"table\":\"Datensammlung\"}]');

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
('root', '2019-05-15 18:59:56', '{\"lang\":\"de\",\"Console\\/Mode\":\"collapse\",\"ThemeDefault\":\"pmahomme\"}');

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
--
-- Datenbank: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
