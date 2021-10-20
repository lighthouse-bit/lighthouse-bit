<?php

class Signup
{
    public function evaluate($data)
    {

        foreach($data as $key => $value){

        }
        $this->create($data);
    }

    public function create($data)
    {

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];

        $query = "insert into staff(firstname,lastname) values('$firstname','$lastname')";

        $DB = new Database();
        $DB->save($query);
    }
}