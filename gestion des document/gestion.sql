
CREATE TABLE `adocumentfolder` (
`doc_id` varchar(50) NOT NULL,
`folder_id` int(11) NOT NULL,
`file_attached` varchar(150) default NULL,
`precision` varchar(250) default NULL,
PRIMARY KEY (`doc_id`,`folder_id`),
KEY `folder_id` (`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ecompanie` (
`comp_id` int(11) NOT NULL auto_increment,
`comp_nom` varchar(150) default NULL,
`comp_contact` varchar(250) default NULL,
`comp_contact_email` varchar(150) default NULL,
`comp_contact_tel` varchar(100) default NULL,
`comp_statut` binary(1) default '1',
PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
-- 
-- Contenu de la table `ecompanie`
-- 
INSERT INTO `ecompanie` VALUES (1, 'AC WebSolution', '00', 'contact@awaclid.com', '', 0x31);
-- --------------------------------------------------------
-- 
-- Structure de la table `edocument`
-- 
CREATE TABLE `edocument` (
`doc_id` varchar(50) NOT NULL default '',
`doc_title` varchar(250) NOT NULL,
`doc_detail` text,
`doc_keyword` varchar(250) default NULL,
`doc_owner` varchar(150) default NULL,
`doc_prepared_by` varchar(100) default NULL,
`doc_reviewed_by` varchar(100) default NULL,
`doc_approved_by` varchar(100) default NULL,
`doc_creat_date` date default NULL,
`doc_sign_date` date default NULL,
`doc_nbr_page` int(11) default NULL,
`doc_status` binary(1) default NULL,
`typdoc_id` int(11) default NULL,
PRIMARY KEY (`doc_id`),
KEY `doc_id` (`doc_id`),
KEY `typdoc_id` (`typdoc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- 
-- Contenu de la table `edocument`
-- 
-- --------------------------------------------------------
-- 
-- Structure de la table `edomaine`
-- 
CREATE TABLE `edomaine` (
`dom_id` int(11) NOT NULL auto_increment,
`dom_nom` varchar(50) default NULL,
`dom_description` text,
`dom_autorisation` varchar(250) default NULL,
`dom_niveau` varchar(25) default NULL,
`dom_statut` binary(1) default NULL,
PRIMARY KEY (`dom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
-- 
-- Contenu de la table `edomaine`
-- 
INSERT INTO `edomaine` VALUES (1, 'SA', 'Super Admin', '0111100001111111111111111', NULL, 0x31);
INSERT INTO `edomaine` VALUES (2, 'UserAdmin', 'UserAdmin', '0111100000000111110001000', NULL, 0x31);
-- --------------------------------------------------------
-- 
-- Structure de la table `eemploye`
-- 
CREATE TABLE `eemploye` (
`emp_id` int(11) NOT NULL auto_increment,
`emp_nom` varchar(100) default NULL,
`emp_prenom` varchar(100) default NULL,
`emp_titre` varchar(10) default NULL,
`emp_designation` varchar(250) default NULL,
`emp_email` varchar(150) default NULL,
`emp_tel` varchar(50) default NULL,
`emp_num_pass` varchar(25) default NULL,
`emp_attach_pass` varchar(150) default NULL,
`emp_groupe` varchar(25) default NULL,
`emp_statut` binary(1) default '1',
`nat_id` int(11) default NULL,
`comp_id` int(11) default NULL,
PRIMARY KEY (`emp_id`),
KEY `nat_id` (`nat_id`),
KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
-- 
-- Contenu de la table `eemploye`
-- 
INSERT INTO `eemploye` VALUES (1, 'Awa', 'Clid', 'Mr.', 'PM', 'awaclid@awaclid.com', '', '', '', 'IT', 0x31, 1, 1);
-- --------------------------------------------------------
-- 
-- Structure de la table `efolder`
-- 
CREATE TABLE `efolder` (
`folder_id` int(11) NOT NULL auto_increment,
`folder_name` varchar(50) NOT NULL,
`folder_descript` text,
`folder_status` binary(1) default '1',
PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
-- 
-- Contenu de la table `efolder`
-- 
INSERT INTO `efolder` VALUES (1, 'Licence', 'Toutes les licence', 0x31);
INSERT INTO `efolder` VALUES (2, 'Certificat', 'Tous les certifs', 0x31);
-- --------------------------------------------------------
-- 
-- Structure de la table `enationalite`
-- 
CREATE TABLE `enationalite` (
`nat_id` int(11) NOT NULL auto_increment,
`nat_design` varchar(150) default NULL,
`nat_country` varchar(150) default NULL,
`nat_statut` binary(1) default '1',
PRIMARY KEY (`nat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
-- 
-- Contenu de la table `enationalite`
-- 
INSERT INTO `enationalite` VALUES (1, 'Congolaise', 'Congo', 0x31);
-- --------------------------------------------------------
-- 
-- Structure de la table `etypdoc`
-- 
CREATE TABLE `etypdoc` (
`typdoc_id` int(11) NOT NULL auto_increment,
`typdoc_title` varchar(150) NOT NULL,
`typdoc_descript` text,
`typdoc_status` binary(1) default '1',
PRIMARY KEY (`typdoc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
-- 
-- Contenu de la table `etypdoc`
-- 
INSERT INTO `etypdoc` VALUES (1, 'Licence Windows', 'Licence Windows', 0x31);
INSERT INTO `etypdoc` VALUES (2, 'Certif Oracle', 'Certif Oracle', 0x31);
-- --------------------------------------------------------
-- 
-- Structure de la table `eutilisateur`
-- 
CREATE TABLE `eutilisateur` (
`util_id` varchar(100) NOT NULL,
`util_pwd` varchar(100) default NULL,
`util_statut` binary(1) default '1',
`dom_id` int(11) default NULL,
`emp_id` int(11) default NULL,
PRIMARY KEY (`util_id`),
KEY `dom_id` (`dom_id`),
KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- 
-- Contenu de la table `eutilisateur`
-- 
INSERT INTO `eutilisateur` VALUES ('admin', 'admin', 0x31, 1, 1);
INSERT INTO `eutilisateur` VALUES ('user', 'user', 0x31, 2, 1);
-- 
-- Contraintes pour les tables exportées
-- 
-- 
-- Contraintes pour la table `adocumentfolder`
-- 
ALTER TABLE `adocumentfolder`
ADD CONSTRAINT `adocumentfolder_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `edocument` (`doc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `adocumentfolder_ibfk_2` FOREIGN KEY (`folder_id`) REFERENCES `efolder` (`folder_id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- 
-- Contraintes pour la table `edocument`
-- 
ALTER TABLE `edocument`
ADD CONSTRAINT `edocument_ibfk_1` FOREIGN KEY (`typdoc_id`) REFERENCES `etypdoc` (`typdoc_id`) ON DELETE SET NULL ON UPDATE CASCADE;
-- 
-- Contraintes pour la table `eemploye`
-- 
ALTER TABLE `eemploye`
ADD CONSTRAINT `eemploye_ibfk_1` FOREIGN KEY (`nat_id`) REFERENCES `enationalite` (`nat_id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `eemploye_ibfk_2` FOREIGN KEY (`comp_id`) REFERENCES `ecompanie` (`comp_id`) ON DELETE SET NULL ON UPDATE CASCADE;
-- 
-- Contraintes pour la table `eutilisateur`
-- 
ALTER TABLE `eutilisateur`
ADD CONSTRAINT `eutilisateur_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `eemploye` (`emp_id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `eutilisateur_ibfk_3` FOREIGN KEY (`dom_id`) REFERENCES `edomaine` (`dom_id`) ON DELETE SET NULL ON UPDATE CASCADE; 
