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

        $school_name = $data['school_name'];
        $address = $data['address'];
        $motor = $data['motor'];
      
        $query = "insert into school(school_name,address,motor) values('$school_name','$address', '$motor')";

        $DB = new Database();
        $DB->save($query);
    }
}