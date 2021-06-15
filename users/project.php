<?php
session_start();
if(!isset($_SESSION["prv"]) || $_SESSION["prv"] != 1) {
    header("Location: ../logout.php");
    exit();
}

$do = isset($_GET["do"]) ? $_GET["do"] : "home";

$filename = "../connect.php";

include "../classes/project.class.php";


if($do == "home") {
    include "../init.php";

        ?>
        
        <section>
            <div class="container">
                <div class="row">
                    
                </div>
            </div>
        </section>

        <?php

    include TPL . DS . "footer.php";

} elseif($do == "add") {
    include "../init.php";

    $projectobj = new Projects();

    $intitis = $projectobj->getIntit($filename);

    ?>
    
    <div class="container">
        <div class="row pt-5 justify-content-center">
            <div class="jb-container d-flex flex-column col-md">
                <div class="jumbotron bg-info text-white mb-1">
                    <h1>
                        <span class="float-right">add project</span>
                        <i class="fas fa-project-diagram float-left"></i>
                    </h1>
                </div>
                <form id="add-prj-form" class="shadow bg-white p-3 mb-3">

                    <div class="partOne">

                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="">contrat id</label>
                                <input type="text" name="contrat_id" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">Numéro ap</label>
                                <input type="text" name="num_ap" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">Objet de contract</label>
                                <input type="text" name="obj_contract" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">Lieu</label>
                                <input type="text" name="lieu" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="">Constructeur</label>
                                <input type="text" name="constructeur" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">Conc</label>
                                <input type="text" name="conc" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">Intitu</label>
                                <select name="intit_id" id="intit_id" class="custom-select custom-select-sm">
                                    <?php
                                    if(is_array($intitis)) {
                                        foreach($intitis as $int) {
                                            ?>
                                            <option value="<?=$int["id"];?>"><?=$int["intit"];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="text-danger local-error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="">date approvation</label>
                                <input type="date" name="date_approvation" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">date mise ev</label>
                                <input type="date" name="date_mise_ev" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">date drp</label>
                                <input type="date" name="date_drp" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">date drd</label>
                                <input type="date" name="date_drd" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="">delai realisation</label>
                                <input type="text" name="delai_realisation" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">montant or tva devise</label>
                                <input type="text" name="montant_or_tva_devise" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">montant_o_tva_da</label>
                                <input type="text" name="montant_o_tva_da" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">montant_tota</label>
                                <input type="text" name="montant_tota" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                        </div>
                        
                        <div class="btn-group">
                            <button id="continue" type="button" class="btn btn-info btn-sm">
                                <span>continue</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                    </div>

                    <div class="partTwo d-none">
                    
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="">nom_phase id</label>
                                <input type="text" name="nom_phase" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">date_debut</label>
                                <input type="date" name="date_debut" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="">duree</label>
                                <input type="number" name="duree" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">taux_av_r</label>
                                <input type="text" name="taux_av_r" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                            <div class="form-group col-md">
                                <label for="">taux_p</label>
                                <input type="text" name="taux_p" class="form-control form-control-sm req">
                                <span class="text-danger local-error"></span>
                            </div>
                        </div>
                    
                        <div class="btn-group">
                            <button type="submit" class="btn btn-info btn-sm">
                                <span>Ajouter</span>
                                <i class="fas fa-plus-circle"></i>
                            </button>
                            <button id="closePr" type="button" class="btn btn-danger btn-sm">
                                <span>Annuler</span>
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
        <p class="global-error fixed-bottom text-center fade"></p>
    </div>

    <?php
    include TPL . DS . "footer.php";

} elseif($do == "insert") {
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $pr_id = null;
        $prObj = new Projects();

        if(isset($_GET["type"]) && $_GET["type"] == "one") {
            $contrat_id = isset($_POST["contrat_id"]) ? $_POST["contrat_id"] : null;
            $num_ap = isset($_POST["num_ap"]) ? $_POST["num_ap"] : null;
            $obj_contract = isset($_POST["obj_contract"]) ? $_POST["obj_contract"] : null;
            $lieu = isset($_POST["lieu"]) ? $_POST["lieu"] : null;
            $constructeur = isset($_POST["constructeur"]) ? $_POST["constructeur"] : null;
            $conc = isset($_POST["conc"]) ? $_POST["conc"] : null;
            $intit_id = isset($_POST["intit_id"]) ? $_POST["intit_id"] : null;
            $date_approvation = isset($_POST["date_approvation"]) ? $_POST["date_approvation"] : null;
            $date_mise_ev = isset($_POST["date_mise_ev"]) ? $_POST["date_mise_ev"] : null;
            $date_drp = isset($_POST["date_drp"]) ? $_POST["date_drp"] : null;
            $date_drd = isset($_POST["date_drd"]) ? $_POST["date_drd"] : null;
            $delai_realisation = isset($_POST["delai_realisation"]) ? $_POST["delai_realisation"] : null;
            $montant_or_tva_devise = isset($_POST["montant_or_tva_devise"]) ? $_POST["montant_or_tva_devise"] : null;
            $montant_o_tva_da = isset($_POST["montant_o_tva_da"]) ? $_POST["montant_o_tva_da"] : null;
            $montant_tota = isset($_POST["montant_tota"]) ? $_POST["montant_tota"] : null;

            $prObj->setCtrProps($contrat_id, $num_ap, $obj_contract, $lieu, $constructeur, $conc, $date_approvation, $date_mise_ev, $date_drp, $date_drd, $delai_realisation, $montant_or_tva_devise, $montant_o_tva_da, $montant_tota);

            $prObj->id = $intit_id;

            echo $prObj->insertProject($filename);
        }

        $phObj = new Phases();

        $pr_id = isset($_POST["pr_id"]) ? $_POST["pr_id"] : null;
        $nom_phase = isset($_POST["nom_phase"]) ? $_POST["nom_phase"] : null;
        $date_debut = isset($_POST["date_debut"]) ? $_POST["date_debut"] : null;
        $duree = isset($_POST["duree"]) ? $_POST["duree"] : null;
        $taux_av_r = isset($_POST["taux_av_r"]) ? $_POST["taux_av_r"] : null;
        $taux_p = isset($_POST["taux_p"]) ? $_POST["taux_p"] : null;

        $phObj->setPropPhase($nom_phase, $date_debut, $duree, $taux_av_r, $taux_p);
        $phObj->projet_id = $pr_id;   

        echo $phObj->insertPhase($filename);

        // echo $contrat_id . "\n";
        // echo $num_ap . "\n";
        // echo $obj_contract . "\n";
        // echo $lieu . "\n";
        // echo $constructeur . "\n";
        // echo $conc . "\n";
        // echo $intit_id . "\n";
        // echo $date_approvation . "\n";
        // echo $date_mise_ev . "\n";
        // echo $date_drp . "\n";
        // echo $date_drd . "\n";
        // echo $delai_realisation . "\n";
        // echo $montant_or_tva_devise . "\n";
        // echo $montant_o_tva_da . "\n";
        // echo $montant_tota . "\n";

    }
}

