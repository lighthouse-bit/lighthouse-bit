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

        $start = $data['start'];
        $end = $data['end'];
      

        $query = "insert into time_frame(start,end) values('$start', '$end')";

        $DB = new Database();
        $DB->save($query);
    }
}