CREATE TABLE `fattura` (
  `fatturaid` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `data` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `progettofk` int(11) NOT NULL,
  `oggetto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importo` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `totale` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `tipologiafatturafk` int(11) NOT NULL,
  `pagato` boolean not null default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `fattura`
  ADD PRIMARY KEY (`fatturaid`);

ALTER TABLE `fattura`
  MODIFY `fatturaid` int(11) NOT NULL AUTO_INCREMENT;
