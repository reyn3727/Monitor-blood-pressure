CREATE TABLE `blood_pressure` (
  `bp_ind` int(10) NOT NULL DEFAULT '0',
  `sys` int(3) NOT NULL DEFAULT '0',
  `dia` int(3) NOT NULL DEFAULT '0',
  `pulse` int(3) NOT NULL DEFAULT '0',
  `arm` char(1) NOT NULL DEFAULT 'L',
  `comment` char(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 
