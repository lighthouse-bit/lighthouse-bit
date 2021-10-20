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

        $class = $data['class'];
        $staff = $data['staff'];
        $subject = $data['subject'];
    

        foreach($subject as $s){
            $query = "insert into table_approve(subject,class) values('$s','$class')";
            // $DB = new Database();
            // $DB->save($query);
            
            
        }
       foreach($staff as $lu){
                echo "$lu";
            }
    }
}