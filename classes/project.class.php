<?php

class Contracts {
    public $contrat_id;
    public $num_ap;
    public $obj_contract;
    public $lieu;
    public $constructeur;
    public $conc;
    public $date_approvation;
    public $date_mise_ev;
    public $date_drp;
    public $date_drd;
    public $delai_realisation;
    public $montant_or_tva_devise;
    public $montant_o_tva_da;
    public $montant_tota;

    protected function setContratProps($contrat_id, $num_ap, $obj_contract, $lieu, $constructeur, $conc, $date_approvation, $date_mise_ev, $date_drp, $date_drd, $delai_realisation, $montant_or_tva_devise, $montant_o_tva_da, $montant_tota) {
        $this->contrat_id = $contrat_id;
        $this->num_ap = $num_ap;
        $this->obj_contract = $obj_contract;
        $this->lieu = $lieu;
        $this->constructeur = $constructeur;
        $this->conc = $conc;
        $this->date_approvation = $date_approvation;
        $this->date_mise_ev = $date_mise_ev;
        $this->date_drp = $date_drp;
        $this->date_drd = $date_drd;
        $this->delai_realisation = $delai_realisation;
        $this->montant_or_tva_devise = $montant_or_tva_devise;
        $this->montant_o_tva_da = $montant_o_tva_da;
        $this->montant_tota = $montant_tota;
    }

    protected function insert($filename) {
        if(is_file($filename)) {
            include $filename;

            try {
                $query = $db->prepare("INSERT INTO contrats SET contrat_id = ?, num_ap = ?, obj_contract = ?, lieu = ?, constructeur = ?, conc = ?, date_approvation = ?, date_mise_ev = ?, date_drp = ?, date_drd = ?, delai_realisation = ?, montant_or_tva_devise = ?, montant_o_tva_da = ?, montant_total = ?");

                $query->execute([
                    $this->contrat_id,
                    $this->num_ap,
                    $this->obj_contract,
                    $this->lieu,
                    $this->constructeur,
                    $this->conc,
                    $this->date_approvation,
                    $this->date_mise_ev,
                    $this->date_drp,
                    $this->date_drd,
                    $this->delai_realisation,
                    $this->montant_or_tva_devise,
                    $this->montant_o_tva_da,
                    $this->montant_tota
                ]);

                if($query->rowCount() > 0) {
                    return $this->contrat_id;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                return $e->getMessage();
            }
        }
    }

    protected function delete($filename) {
        if(is_file($filename)) {
            include $filename;

            $query = $db->prepare("DELETE FROM contrats WHERE contrat_id = ?");

            $query->execute([
                $this->contrat_id
            ]);

            if($query->rowCount() > 0) {
                // return $db->la;
            }

        }
    }


}

trait ProjectIntit {
    public $id;
    protected $intit;

    protected function getAll($filename) {
        if(is_file($filename)) {
            include $filename;

            $query = $db->prepare("SELECT * FROM project_intit");

            $query->execute();

            if($query->rowCount() > 0) {
                $datas = $query->fetchAll(PDO::FETCH_ASSOC);
                return $datas;
            }

        }
    }

}

class Projects extends Contracts {
    use ProjectIntit;

    public $projet_id;

    public function getIntit($filename) {
        return $this->getAll($filename);
    }

    public function setCtrProps($contrat_id, $num_ap, $obj_contract, $lieu, $constructeur, $conc, $date_approvation, $date_mise_ev, $date_drp, $date_drd, $delai_realisation, $montant_or_tva_devise, $montant_o_tva_da, $montant_tota) {

        $this->setContratProps($contrat_id, $num_ap, $obj_contract, $lieu, $constructeur, $conc, $date_approvation, $date_mise_ev, $date_drp, $date_drd, $delai_realisation, $montant_or_tva_devise, $montant_o_tva_da, $montant_tota);
    }

    public function insertProject($filename) {
        if(is_file($filename)) {
            include $filename;

            $contrat_id = $this->insert($filename);
            if($contrat_id) {
                try {
                    $query = $db->prepare("INSERT INTO projects SET intit_id = ?, contrat_id = ?");
    
                    $query->execute([
                        $this->id,
                        $contrat_id
                    ]);
    
                    if($query->rowCount() > 0) {
                        return $db->lastInsertId();
                    } else {
                        return false;
                    }
                    
                } catch(PDOException $e) {
                    return $e->getMessage();
                }
            }

        }
    }

}

class Phases extends Projects {

    public $id;
    public $nom_phase;
    public $date_debut;
    public $duree;
    public $taux_av_r;
    public $taux_p;

    public function setPropPhase($nom_phase, $date_debut, $duree, $taux_av_r, $taux_p) {
        $this->nom_phase = $nom_phase;
        $this->date_debut = $date_debut;
        $this->duree = $duree;
        $this->taux_av_r = $taux_av_r;
        $this->taux_p = $taux_p;
    }

    public function insertPhase($filename) {
        if(is_file($filename)) {
            include $filename;

            try {
                $query = $db->prepare("INSERT INTO phases SET nom_phase = ?,date_debut = ?,duree = ?,taux_av_r = ?, taux_p = ?, pr_id = ?");

                $query->execute([
                    $this->nom_phase,
                    $this->date_debut,
                    $this->duree,
                    $this->taux_av_r,
                    $this->taux_p,
                    $this->projet_id
                ]);

                if($query->rowCount() > 0) {
                    return $db->lastInsertId();
                } else {
                    return false;
                }
                
            } catch(PDOException $e) {
                return $e->getMessage();
            }
        }
    }

}