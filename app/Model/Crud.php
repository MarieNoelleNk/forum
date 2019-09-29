<?php

namespace App\Model;

use Carbon\Carbon;

class Crud extends Manager
{
    protected $database;

    public function __construct()
    {
        $this->database= $this->dbConnect();
    }

    public function insert($table, $data)
    {
        if(!empty($data) && is_array($data)){

            if(!array_key_exists('created', $data)) {

                $data['created'] = Carbon::now();
                $implodeColumns = implode(',', array_keys($data));
                $implodePlaceholder = implode(', :', array_keys($data));
            }
        }

        $query = "INSERT INTO " . $table . " (" . $implodeColumns . ") VALUES (:" . $implodePlaceholder . ")";

        $request = $this->database->prepare($query);
            foreach ($data as $key => $value) {
                if (is_string($value)){
                    $value = htmlspecialchars($value);
                }
                if (array_key_exists('m_password',$data)){
                    $data['m_password']= sha1($value);
                }
                $request->bindValue(':' . $key, $value);

            }

        $insert = $request->execute();
            return $insert;

    }

    public function selectAll($table)
    {
        $query= "SELECT * FROM ".$table;
        $request = $this->database->query($query);
        return $request;
    }

    public function selectForPagination($table,$current_page,$limit){

        $start = ($current_page -1)*$limit;

        $request = "SELECT * FROM ".$table." WHERE status = 2 LIMIT :start,:limit";

        $result = $this->database->prepare($request);
        $result->bindValue(":limit",$limit, \PDO::PARAM_INT);
        $result->bindValue(":start",$start, \PDO::PARAM_INT);
        $result->execute();
        return $result;

    }

    public function selectOneElement($table, $key){

        $request = 'SELECT * FROM '.$table.' WHERE '.$key.' = ?';

        $query = $this->database->prepare($request);

        return $query;

    }

    public function update($table, $fields,$key_id, $id){

        $st = "";
        $counter = 1;
        $total_fields = count($fields);
        foreach ($fields as $key => $value){
            if ($counter === $total_fields){
                $set = $key." = :".$key;
                $st = $st.$set;
            } else{
                $set =  $key." = :".$key.", ";
                $st = $st.$set;
                $counter++;
            }
        }

        $request = "UPDATE ".$table." SET ".$st;
        $request .= " WHERE ".$key_id." = ".$id;

        $query = $this->database->prepare($request);
        foreach ($fields as $key => $value){
            $query->bindValue(':'.$key,$value);
        }
        $query->execute();

        return $query;
    }

    public function delete($table, $key, $id){

        $request = "DELETE FROM ".$table." WHERE ".$key." = ?";

        $query = $this->database->prepare($request);

        $query->execute(array($id));

        $delete = $query->rowCount();

        return $delete;

    }


}