CREATE TABLE `tipologia` (
  `tipologiaid` int(11) NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`tipologiaid`);

ALTER TABLE `tipologia`
  MODIFY `tipologiaid` int(11) NOT NULL AUTO_INCREMENT;
