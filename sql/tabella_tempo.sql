CREATE TABLE `tempo` (
  `tempoid` int(11) NOT NULL,
  `progettofk` int(11) NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `utentefk` int(11) NOT NULL,
  `datainizio` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `datafine` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `tempo`
  ADD PRIMARY KEY (`tempoid`);

ALTER TABLE `tempo`
  MODIFY `tempoid` int(11) NOT NULL AUTO_INCREMENT;