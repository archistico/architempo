CREATE TABLE `login` (
  `loginid` int(11) NOT NULL,
  `utentefk` int(11) NOT NULL,
  `datalogin` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `progressivo` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `accesso` BOOLEAN NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `login`
  ADD PRIMARY KEY (`loginid`);

ALTER TABLE `login`
  MODIFY `loginid` int(11) NOT NULL AUTO_INCREMENT;