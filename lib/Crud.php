<?php 
require_once('../config.php');

class Crud {

    public $connect;
    function __construct()
    {
        $this->connect = new mysqli(HOST,USER,PASS,DB_NAME);
        if($this->connect->connect_error){
            echo $this->connect->connect_error;
        }
    }
// * INSERT DATA
    function creator($table,$data){
        $msg=$error=$insert_id = false;
        if(is_array($data)){
            $insert = "INSERT INTO $table  SET ";
            foreach($data as $key=>$value){
                $insert.= "$key='$value',";
            }
            $insert = rtrim($insert,',');
            $save = $this->connect->query($insert);
            if($save){
                $msg='saved';
                $insert_id= $this->connect->insert_id;
            }else{
                $msg = 'cannot saved';
                $error = $this->connect->error;
            }
        }else{
            $msg="Data should be sent as array";
        }

        $return=array("msg"=>$msg,"error"=>$error,"insert_id"=>$insert_id);
        return $return;

    }

// * SELECT DATA
    function selector ($table, $data='*', $where=false,$orderby=false,$order="ASC",$limit=false,$offset=false) {
        $selectdata=$error=$msg=false;
        $numrows=0;
        
            $select = "SELECT $data FROM $table ";
            if($where && is_array($where)){
                $select.= "where "; //select * from auth where
                foreach($where as $key=>$value){
                    $select.= "$key='$value' and "; // get data and set query
                }
                $select=rtrim($select,"and "); // remove last , from query
            }
            if($orderby){
                $select.= " order by $orderby $order";
            }
            
            if($limit){
                $select.= " limit $limit , $offset";
            }
            $getdata=$this->connect->query($select); // execute query
            if($getdata){            
            if($getdata->num_rows > 0){
                
                // if($getdata->num_rows == 1){
                //     while($singleData = $getdata->fetch_assoc()){
                //         $data = $singleData;
                //     }
                // }else{
                    $data = array();
                    while($singleData = $getdata->fetch_assoc()){
                        $data[] = $singleData;
                    // }
                }
                $selectdata=$data;
                $numrows=$getdata->num_rows;
                $msg="data found";
            }else{
                $msg="No data found";
                $error=$this->connect->error;
                
            }
        
          
            
        }else {
            $error=$this->connect->error;
        }
        return array("msg"=>$msg,"error"=>$error,"selectdata"=>$selectdata,"numrows"=>$numrows);
    }

// SELECT Single Data
function select_single($singleSelect){
    // $singleSelect = "SELECT $data FROM $table $where";
    $selectdata=$error=$msg=false;
    $numrows=0;

    $getdata=$this->connect->query($singleSelect); // execute query
            if($getdata){            
            if($getdata->num_rows > 0){
                
                    while($singleData = $getdata->fetch_assoc()){
                        $data = $singleData;
                    }
                
                $selectdata=$data;
                $numrows=$getdata->num_rows;
                $msg="data found";
            }else{
                $msg="No data found";
                $error=$this->connect->error;
                
            }
        
            
        }else {
            $error=$this->connect->error;
        }
        
        return array("msg"=>$msg,"error"=>$error,"singledata"=>$selectdata,"numrows"=>$numrows);

}

// ! Find data
function find($singleSelect){
    $selectdata=$error=$msg=false;
    $numrows=0;

    $getdata=$this->connect->query($singleSelect); // execute query
            if($getdata){            
            if($getdata->num_rows > 0){
                
                    while($singleData = $getdata->fetch_assoc()){
                        $data[] = $singleData;
                    }
                
                $selectdata=$data;
                $numrows=$getdata->num_rows;
                $msg="data found";
            }else{
                $msg="No data found";
                $error=$this->connect->error;
                
            }
        }else {
            $error=$this->connect->error;
        }
        return array("msg"=>$msg,"error"=>$error,"singledata"=>$selectdata,"numrows"=>$numrows);
}

function custome_query($q) {
    $selectdata=$error=$msg=false;
    $numrows=0;
        
    $getdata=$this->connect->query($q); // execute query
    if($getdata){
        if($getdata->num_rows > 0){
            $data = array();
            while($singleData = $getdata->fetch_assoc()){
                $data[] = $singleData;
            }
            $selectdata=$data;
            $numrows=$getdata->num_rows;
            $msg="data found";
        }else{
            $msg="No data found";
            $error=$this->connect->error;
            
        }
        
    }else {
        $error=$this->connect->error;
    }
    
    return array("msg"=>$msg,"error"=>$error,"selectdata"=>$selectdata,"numrows"=>$numrows);
}





// * UPDATE DATA
    function updator($table, $data, $id){
        $affected_rows=0;
        if($data && is_array($data)){
            $update = "UPDATE $table  SET ";
            foreach($data as $key=>$value){
                $update.= "$key='$value',";
            }
            $update=rtrim($update,',');

            if($id){
                $update.=" where $id";
                // foreach($id as $col=>$val){
                //     $update.="$col = '$val' and ";
                // }
                // $update=rtrim($update,'and ');
            }
            $result=$this->connect->query($update);
            if($result){
                $affected_rows=$this->connect->affected_rows;
                $error=false;
                $msg= "Data saved";
            }else{
                $error=true;
                $msg= $this->connect->error;
            }
        }else{
            $error=true;
            $msg="Data must be array";
        }
        return array("error"=>$error,"updated"=>$msg,"affected_rows"=>$affected_rows);

    }


// * COUNTER
function counter($table,$data){
    $msg=$error = false;
    $count = "SELECT SUM($data) FROM $table ";
    $countdata=$this->connect->query($count); // execute query
    
    if($countdata){
            // $data = array();
            while($singleData = $countdata->fetch_row()){
                $data = $singleData;
            }
    $counted=$data;
    }else{
        $msg="No data found";
        $error=$this->connect->error;
    }
    return array("msg"=>$msg,"error"=>$error,"count"=>$counted);

}


// * DEACTIVE 
    function deactive($table,$data, $id){
        $msg=$error=$delete_id = false;
        $deactive = "UPDATE $table  SET $data,status=0 WHERE $id";
        if($deactive){
            $msg='deleted';
        }else{
            $msg = 'cannot delete';
            $error = $this->connect->error;
        }
        $return=array("msg"=>$msg,"error"=>$error,"insert_id"=>$delete_id);
        return $return;
    }

// * DELETE USER
    // function deletor($table, $data, $id){
    //     $deactive = "DELETE $table WHERE $id";
    // }


}


?>