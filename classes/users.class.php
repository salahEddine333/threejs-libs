<?php

class Users {
    public $user_id;
    public $fname;
    public $lname;
    public $username;
    public $password;



    public function login($filename) {
        if(is_file($filename)) {
            include $filename;
            $query = $db->prepare("SELECT user_id, username, prv FROM users WHERE username = ? AND password = ?");
            $query->execute([
                $this->username,
                $this->password
            ]);
            while($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION["user_id"] = $data["user_id"];
                $_SESSION["username"] = $data["username"];
                if($data["prv"] == 1) {
                    $_SESSION["prv"] == "cfp";
                } elseif($data["prv"] == 2) {
                    $_SESSION["prv"] == "rsp";
                } elseif($data["prv"] == 3) {
                    $_SESSION["prv"] == "crd";
                } elseif($data["prv"] == 4) {
                    $_SESSION["prv"] == "cf";
                }
                return true;
            }
            return false;
        }
    }


}