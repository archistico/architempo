CREATE TABLE `progetto` (
  `progettoid` int(11) NOT NULL,
  `clientefk` int(11) NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipologiafk` int(11) NOT NULL,
  `compenso` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `acconto` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `pagato` boolean not null default 0,
  `completato` boolean not null default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `progetto`
  ADD PRIMARY KEY (`progettoid`);

ALTER TABLE `progetto`
  MODIFY `progettoid` int(11) NOT NULL AUTO_INCREMENT;
