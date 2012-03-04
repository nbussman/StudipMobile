

CREATE TABLE IF NOT EXISTS `dropbox_tokens` (
  `user_id` varchar(32) COLLATE latin1_german1_ci NOT NULL,
  `token` varchar(15) COLLATE latin1_german1_ci NOT NULL,
  `token_secret` varchar(15) COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

