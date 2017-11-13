CREATE TABLE `ruolo` (
  `ruoloid` int(11) NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `ruolo`
  ADD PRIMARY KEY (`ruoloid`);

ALTER TABLE `ruolo`
  MODIFY `ruoloid` int(11) NOT NULL AUTO_INCREMENT;
