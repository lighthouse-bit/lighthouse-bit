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

        $class_name = $data['class_name'];
      
        $query = "insert into class(class_name) values('$class_name')";

        $DB = new Database();
        $DB->save($query);
    }
}