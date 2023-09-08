<?php

    class Account{

        private $con;
        private $errorArray=array();

        public function __construct($con){
            $this->con=$con;
        }

        public function register($fn,$ln,$un,$em,$em2,$pa,$pa2){
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateusername($un);
            $this->validateEmails($em,$em2);
            $this->validatePasswords($pa,$pa2);

            if(empty($this->errorArray)){
                return $this->insertUserDetails($fn,$ln,$un,$em,$pa);
            }

            return false;

        }

        public function login($un,$pa){
            $pa=hash("sha512",$pa);

            $query=$this->con->prepare('SELECT * FROM users WHERE username=:un AND password=:pa');
            $query->bindValue(":un",$un);
            $query->bindValue(":pa",$pa);

            $query->execute();
            if($query->rowCount()==1){
                return true;
            }
            array_push($this->errorArray,Constants::$loginFailed);
            return false;
        }

        private function insertUserDetails($fn,$ln,$un,$em,$pa){
            $pa=hash("sha512",$pa);

            $query=$this->con->prepare("INSERT INTO users (firstName,lastName,username,email,password)
                                        VALUES(:fn,:ln,:un,:em,:pa)");
            $query->bindValue(":fn",$fn);
            $query->bindValue(":ln",$ln);
            $query->bindValue(":un",$un);
            $query->bindValue(":em",$em);
            $query->bindValue(":pa",$pa);

            return $query->execute();

        }

        private function validateFirstName($fn){
            if(strlen($fn)<4 || strlen($fn)>20){
                array_push($this->errorArray, Constants::$firstNameCharacters);
            }
        }

        
        private function validateLastName($ln){
            if(strlen($ln)<4 || strlen($ln)>20){
                array_push($this->errorArray, Constants::$lastNameCharacters);
            }
        }

        
        private function validateusername($un){
            if(strlen($un)<4 || strlen($un)>20){
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }

            $query=$this->con->prepare("SELECT * FROM users WHERE username=:un");
            $query->bindValue(":un",$un);
            $query->execute();

            if($query->rowCount()!=0){
                array_push($this->errorArray,Constants::$usernameTaken);
            }
        }

        private function validateEmails($em,$em2){
            if($em!=$em2){
                array_push($this->errorArray,Constants::$emailsDontMatch);
                return;

            }

            if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray,Constants::$emailInvalid);
                return;
            }

            $query=$this->con->prepare("SELECT * FROM users WHERE email=:em");
            $query->bindValue(":em",$em);
            $query->execute();
            if($query->rowCount()!=0){
                array_push($this->errorArray,Constants::$emailTaken);

            }
        }

        private function validatePasswords($pa,$pa2){
            if($pa!=$pa2){
                array_push($this->errorArray,Constants::$passwordsDontMatch);
                return;
            }

            if(strlen($pa)<8 || strlen($pa)>20){
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }

        public function getError($error){
            if(in_array($error,$this->errorArray)){
                return "<span class='errorMsg'>$error</span>";
            }
        }
    }


?>