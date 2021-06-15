<?php
session_start();
if(!isset($_SESSION["prv"])) {
    header("Location: ../logout.php");
    exit();
}

$do = isset($_GET["do"]) ? $_GET["do"] : "home";

$filename = "../connect.php";

if($do == "home") {
    include "../init.php";

    if($_SESSION["prv"] == 1) {
        ?>
        
        <section>
            <div class="container">
                <div class="row">
                    
                </div>
            </div>
        </section>

        <?php
    }

    include TPL . DS . "footer.php";

};

