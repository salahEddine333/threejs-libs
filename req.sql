CREATE TABLE project_types (
    id tinyint(1) unsigned PRIMARY KEY AUTO_INCREMENT,
    type varchar(155) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE project_const (
    id tinyint(1) unsigned PRIMARY KEY AUTO_INCREMENT,
    const varchar(155) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE projects (
    id INT unsigned PRIMARY KEY AUTO_INCREMENT,
    intit_id tinyint unsigned,
    contrat_id varchar(255) NOT NULL,
    FOREIGN KEY(intit_id) REFERENCES project_intit(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(contrat_id) REFERENCES contrats(contrat_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE contrats (
    contrat_id varchar(255) NOT NULL,
    num_ap int NOT NULL,
    obj_contract varchar(255) NOT NULL,
    lieu varchar(255),
    constructeur varchar(255),
    conc varchar(255),
    date_approvation date,
    date_mise_ev date,
    date_drp date,
    date_drd date,
    delai_realisation tinyint,
    montant_or_tva_devise float,
    montant_o_tva_da float,
    montant_total float
) ENGINE = InnoDB;

ALTER TABLE contrats ADD PRIMARY KEY(contrat_id);

CREATE TABLE project_intit (
    id tinyint unsigned PRIMARY KEY AUTO_INCREMENT,
    intit varchar(7) NOT NULL UNIQUE
) ENGINE = InnoDB;

INSERT INTO project_intit SET intit = "TG";
INSERT INTO project_intit SET intit = "CC";
INSERT INTO project_intit SET intit = "TC";
INSERT INTO project_intit SET intit = "DIESEL";
INSERT INTO project_intit SET intit = "TV";
INSERT INTO project_intit SET intit = "EOLIEN";


CREATE TABLE phases (
    id int PRIMARY KEY AUTO_INCREMENT,
    nom_phase varchar(15),
    date_debut date,
    duree smallint,
    taux_av_r float,
    taux_p float,
    pr_id int(10) unsigned NOT NULL,
    FOREIGN KEY(pr_id) REFERENCES projects(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;







