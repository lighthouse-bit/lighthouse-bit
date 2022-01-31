<?php

class Signup{
    private $error = "";
    public function evaluate($data){
        foreach ($data as $key => $value) {
            # code...
            if(empty($value)){
                $this->error = $this->error . $key . " is empty!<br>";
            }

            if($key == "email"){
                if(!preg_match("/([\w-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                    $this->error = $this->error . " invalid email address!<br>";
                }
                
            }

            if($key == "firstname"){
                if(is_numeric($value) || strstr($value, " ")){
                    $this->error = $this->error . " invalid name  !<br>";
                }
                
            }

            if($key == "lastname"){
                if(is_numeric($value)  || strstr($value, " ")){
                    $this->error = $this->error . " invalid name  !<br>";
                }
                
            }


        }

        if($this->error == ""){

            //no error
            $this->create_user($data);
        }else{
            return $this->error;
        }

    }

    public function create_user($data){

        $firstname = ucfirst($data['firstname']);
        $lastname = ucfirst($data['lastname']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];
        //create these
        $url_address = strtolower($firstname) . "." . strtolower($lastname);
        $userid = $this->create_userid();

        $query = "insert into users (userid, firstname,lastname,gender,email,password,url_address) values('$userid', '$firstname','$lastname','$gender','$email','$password','$url_address')";
        $DB = new Database();
        $DB->save($query);
    }

 
    private function create_userid(){


        $length = rand(4,19);
        $number = "";
        for ($i=0; $i < $length; $i++) { 
            # code...
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }
        return $number;
    }
}