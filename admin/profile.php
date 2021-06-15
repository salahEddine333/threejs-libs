<?php
session_start();
if(!isset($_SESSION["prv"])) {
    header("Location: ../logout.php");
    exit();
}

$do = isset($_GET["do"]) ? $_GET["do"] : "home";

include "../classes/users.class.php";

$filename = "../connect.php";

if($do == "home") {
    include "../init.php";

    $obj = new Users();
    $obj->prv = 0;
    $users = $obj->getAll($filename, true);

    ?>

    <section class="dashboard">
        <div class="container p-0">
            <div class="row">
                <div class="col-2 d-flex flex-column">
                    <a href="" class="side-item bg-white text-secondary shadow rounded side-active">User management</a>
                    <a href="" class="side-item bg-white text-secondary shadow rounded">function two</a>
                    <a href="" class="side-item bg-white text-secondary shadow rounded">function three</a>
                    <a href="" class="side-item bg-white text-secondary shadow rounded">function fore</a>
                    <a href="" class="side-item bg-white text-secondary shadow rounded">function five</a>
                </div>
                <div class="col sub-body">
                    
                <section>
                    <div id="userManagementBtn" class="btn-group mt-1 mb-2 bg-white shadow p-3 w-100 d-flex">
                        <button class="btn btn-outline-info btn-sm col-2">
                            <span>Add User</span>
                            <i class="fas fa-plus-circle"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm col-2">
                            <span>delete all</span>
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <table class="table">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>#ID</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>username</th>
                                <th>email</th>
                                <th>phone number</th>
                                <th>privileges</th>
                                <th>control</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white shadow">
                            <tr>
                            <?php
                            if(is_array($users)) {
                                foreach($users as $user) {
                                    if($user["prv"] == 1) {
                                        $prv = "chef.projet";
                                    } elseif($user["prv"] == 2) {
                                        $prv = "resp";
                                    } elseif($user["prv"] == 3) {
                                        $prv = "sous chef.projet";
                                    }
                                    $prvN = $user["prv"];
                                    echo "<td>" . $user["user_id"] . "</td>";
                                    echo "<td>" . $user["fname"] . "</td>";
                                    echo "<td>" . $user["lname"] . "</td>";
                                    echo "<td>" . $user["username"] . "</td>";
                                    echo "<td>" . $user["email"] . "</td>";
                                    echo "<td>" . $user["phoneNumber"] . "</td>";
                                    echo "<td data-prv='". $prvN ."'>" . $prv . "</td>";
                                    echo "<td>
                                            <i style='cursor:pointer;' class='fas fa-edit text-info mr-3'></i>
                                            <i style='cursor:pointer;' class='fas fa-trash text-danger'></i>
                                        </td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- start register part -->

                    <div id="user-management-form" class="container fade">
                        <div class="row">
                            <div class="jb-container d-flex flex-column col">
                                <div class="jumbotron bg-info text-white mb-1 position-relative">
                                    <div id="control-form-user-management" style="top:7px; right: 7px;" class="btn-group position-absolute">
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                    <h1>
                                        <span class="float-right">Add User</span>
                                        <i class="fas fa-user-plus float-left"></i>
                                    </h1>
                                </div>
                                <form id="register-form" class="shadow bg-white p-3 mb-5 mt-3">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">First name</label>
                                            <input type="text" name="fname" class="form-control form-control-sm req">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                        <div class="form-group col">
                                            <label for="">Last name</label>
                                            <input type="text" name="lname" class="form-control form-control-sm req">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">email</label>
                                            <input type="email" name="email" class="form-control form-control-sm req">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                        <div class="form-group col">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phoneNumber" class="form-control form-control-sm req">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">Username</label>
                                            <input type="text" name="username" class="form-control form-control-sm req">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                        <div class="form-group col">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control form-control-sm req">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group col d-flex">
                                            <label class="col" for="">Chef.projet</label>
                                            <input checked value="1" type="radio" name="prv" class="form-control form-control-sm col">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                        <div class="form-group col d-flex">
                                            <label class="col" for="">Responsable</label>
                                            <input value="2" type="radio" name="prv" class="form-control form-control-sm col">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                        <div class="form-group col d-flex">
                                            <label class="col" for="">sous chef de projet</label>
                                            <input value="3" type="radio" name="prv" class="form-control form-control-sm col">
                                            <span class="text-danger local-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-row mt-3 justify-content-center">
                                        <div class="btn-group col-2">
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <span>Save</span>
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p class="global-error fixed-bottom text-center fade"></p>
                    </div>

                    <!-- end register part -->

                </section>


                </div>
            </div>
        </div>
    </section>

    <?php

    include TPL . DS . "footer.php";

} elseif($do == "deletepk") {

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

        $obj = new Users();
        $obj->user_id = $user_id;

        if($obj->deleteWherePk($filename)) {
            echo 1;
        } else {
            echo -1;
        }

    }
} elseif($do == "deleteall") {

    $obj = new Users();
    $obj->prv = 0;

    if($obj->deleteAll($filename, true)) {
        echo 1;
    } else {
        echo -1;
    }
}