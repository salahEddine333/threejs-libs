<?php
session_start();
$do = isset($_GET["do"]) ? $_GET["do"] : "login";

$filename = "connect.php";

if($do == "login") {
    include "init.php";
?>
<section class="login">

    <div class="container">
        <div class="row pt-5">
            <div class="jb-container d-flex flex-column col-7 m-auto">
                <div class="jumbotron bg-info text-white mb-1">
                    <h1>
                        <span class="float-right">LOGIN</span>
                        <i class="fas fa-user float-left"></i>
                    </h1>
                </div>
                <form id="login-form" class="shadow bg-white p-3 mb-3">
                    <div class="form-group">
                        <label for="">Nom d'utilisateur</label>
                        <input type="text" name="username" class="form-control form-control-sm">
                        <span class="text-danger local-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Mot de passe</label>
                        <input type="password" name="password" class="form-control form-control-sm">
                        <span class="text-danger local-error"></span>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-info btn-sm">
                            <span>login</span>
                            <i class="far fa-check-circle"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <p class="global-error fixed-bottom text-center fade"></p>
    </div>

</section>
<?php
    include TPL . DS . "footer.php";
} elseif($do == "check") {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include "classes/users.class.php";
        $username = isset($_POST["username"]) ? $_POST["username"] : null;
        $password = isset($_POST["password"]) ? $_POST["password"] : null;
        $hashPass = sha1($password);

        $obj = new Users();
        $obj->username = $username;
        $obj->password = $hashPass;

        if($obj->login($filename)) {
            echo 1;
        } else {
            echo -1;
        }

    }
}