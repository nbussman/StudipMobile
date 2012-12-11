CREATE TABLE IF NOT EXISTS `dropbox_tokens` (
  `user_id` varchar(32) COLLATE latin1_german1_ci NOT NULL,
  `token` varchar(15) COLLATE latin1_german1_ci NOT NULL,
  `token_secret` varchar(15) COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `locations` (
  `resource_id` varchar(32) COLLATE latin1_german1_ci DEFAULT NULL,
  `latitude` varchar(32) COLLATE latin1_german1_ci DEFAULT NULL,
  `longitude` varchar(32) COLLATE latin1_german1_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
