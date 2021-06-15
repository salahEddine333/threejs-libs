<?php

class Users {
    public $user_id;
    public $fname;
    public $lname;
    public $username;
    public $password;
    public $email;
    public $phoneNumber;
    public $prv;

    public function setParams($fname, $lname, $username, $password, $email, $phoneNumber, $prv) {
        $this->fname = $fname;
        $this->lname = $lname; 
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->prv = $prv;
    }



    public function login($filename) {
        if(is_file($filename)) {
            include $filename;
            $url = explode("/", parse_url(trim($_SERVER["REQUEST_URI"], "/"), PHP_URL_PATH));
            $parentDir = $url[count($url) - 2];
            $prvCond = $parentDir == "admin" ? " = 0" : " > 0";
            $query = $db->prepare("SELECT user_id, username, prv FROM users WHERE username = ? AND password = ? AND prv $prvCond");
            $query->execute([
                $this->username,
                $this->password
            ]);
            while($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION["user_id"] = $data["user_id"];
                $_SESSION["username"] = $data["username"];
                $_SESSION["prv"] = $data["prv"];
                return true;
            }
            return false;
        }
    }

    public function getAll($filename, $condPrvStat = false) {
        if(is_file($filename)) {
            include $filename;
            $condPrvReq = $condPrvStat ? "AND prv != ?" : "";
            $query = $db->prepare("SELECT * FROM users WHERE 1 $condPrvReq");
            $executionArray = [];
            if($condPrvStat) {
                array_push($executionArray, $this->prv);
            }
            if($query->execute($executionArray)) {
                while($datas = $query->fetchAll(PDO::FETCH_ASSOC)) {
                    return $datas;
                }
                return false;
            }
            return false;
        }
    }

    private function insert($filename) {
        try {

            if(is_file($filename)) {
                include $filename;
                $query = $db->prepare("INSERT INTO users SET fname = ?, lname = ?, username = ?, password = ?, email = ?, phoneNumber = ?, prv = ?");
                $executionArray = [
                    $this->fname,
                    $this->lname,
                    $this->username,
                    $this->password,
                    $this->email,
                    $this->phoneNumber,
                    $this->prv
                ];
                $query->execute($executionArray);
                if($query->rowCount() > 0) {
                    return $db->lastInsertId();
                } else {
                    return false;
                }
                return false;
            }

        } catch (PDOException $e) {

            return $e->getMessage();

        }
    }

    private function update($filename, $passwordStat) {
        try {

            if(is_file($filename)) {

                include $filename;

                $passwordReq = $passwordStat ? ", password = ?" : "";

                $query = $db->prepare("UPDATE users SET fname = ?, lname = ?, username = ? , email = ?, phoneNumber = ?, prv = ? $passwordReq  WHERE user_id = ?");

                $executionArray = [
                    $this->fname,
                    $this->lname,
                    $this->username,
                    $this->email,
                    $this->phoneNumber,
                    $this->prv
                ];

                if($passwordStat) {

                    array_push($executionArray, $this->password);
                    
                }

                array_push($executionArray, $this->user_id);

                $query->execute($executionArray);

                if($query->rowCount() > 0) {

                    return true;

                } else {

                    return false;

                }

                return false;
            }

        } catch(PDOException $ex) {

            return $ex->getMessage();
            
        }
    }

    public function save($filename, $formStat , $passwordStat = false) {
        if($formStat == "update") {
            return $this->update($filename, $passwordStat);
        } elseif($formStat == "insert") {
            return $this->insert($filename);
        }
    }

    public function deleteWherePk($filename) {
        if(is_file($filename)) {
            include $filename;
            $query = $db->prepare("DELETE FROM users WHERE user_id = ?");
            $executionArray = [
                $this->user_id
            ];
            if($query->execute($executionArray)) {
                if($query->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
    }

    public function deleteAll($filename, $condPrvStat = false) {
        if(is_file($filename)) {
            include $filename;
            $condPrvReq = $condPrvStat ? "AND prv != ?" : "";
            $query = $db->prepare("DELETE FROM users WHERE 1 $condPrvReq");
            $executionArray = [];
            if($condPrvStat) {
                array_push($executionArray, $this->prv);
            }
            if($query->execute($executionArray)) {
                if($query->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
    }


}