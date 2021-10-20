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

        $subject_title = $data['subject_title'];
      

        $query = "insert into subject(subject_title) values('$subject_title')";

        $DB = new Database();
        $DB->save($query);
    }
}