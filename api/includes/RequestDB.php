<?php
class QueryBuilder{
    
    private $db;
    public $select=[];
    public $where=[];
    public $whereString='WHERE';
    public function __construct($db){
        $this->db=$db;
    }
    public function setWhere($whereStr){
        $this->whereString=$whereStr;
    }
    public function whereBuilder($genre='', $comp=''){
        if(isset($genre) && isset($comp)){
            $this->whereString .= "genre= {$genre} and company_creator = {$comp}";
        }
        if(isset($genre)){
            $this->whereString .= "genre= {$genre} ";
        }
        if(isset($comp)){
            $this->whereString .= "company_creator= {$genre} ";
        }
    }
    public function GetWhere(){
        return $this->whereString;
    }
    public function SetUrl($data){
        $QS = http_build_query(array_merge($_GET, isset($data["genre"])? ['genre' => $data["genre"]]: "", isset($data["company"])? ['company' => $data["company"]]: "" ));
        header('Location: ' . htmlspecialchars($_SERVER['PHP_SELF'].'?'. $QS));
    }

    // public function select($fields){
    //     array_push($this->select, $fields);
    //     return $this;
    // }
    // public function where($field, $condition, $value){
    //     array_push($this->where,[
    //         "field"=>$field,
    //         "condition"=>$condition,
    //         "value"=>$value,
    //     ]);
    //     return $this;
    // }
    // public function sql(){
    //     echo '<pre>';
    //     var_dump($this->select);
    //     echo '</pre>';
    //     echo '<pre>';
    //     var_dump($this->where);
    //     echo '</pre>';
        
    // }
    public function list(){
        //return $this->db->SetQuery()
    }
    

}





class RequestDB{
    private $url, $userName, $userPass, $DBName,$sqlReq, $link;
    
    function __construct($url,$name, $pass, $DBName )
    {
        $this->sqlReq= 'SELECT * FROM filmstable';
        $this->url= $url;
        $this->userName= $name;
        $this->userPass= $pass;
        $this->DBName= $DBName;
        
    }
    function SetQuery($req){
        $this->sqlReq= $req;
        return $this;
    }
    function GetQuery(){
        return $this->sqlReq;
    }


    function Connection(){
        $this->link = mysqli_connect($this->url, $this->userName, $this->userPass, $this->DBName);           
        if($this->link== false){
            echo "Errot, Can`t connect to the DB";
            return false;
        }
        else return true;
    }
    function find($table, $column, $operator, $value){
        $this->SetQuery("SELECT * from {$table} WHERE {$column}{$operator}{$value}");
        return $this->Request();
    }
    function Request(){
        $result= mysqli_query($this->link, $this->sqlReq);
        if($result== false){
            echo "Bad request";
            return false; 
        }
        else{
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $rows;
        }
    }
    function Delete(){
        $result= mysqli_query($this->link, $this->sqlReq);
        if($result== false){
            echo "Bad request";
            return false; 
        }
        else{
            return true;
        }
    }
    function Edit(){
        $result= mysqli_query($this->link, $this->sqlReq);
        if($result== false){
            echo "Bad request";
            return false; 
        }
        else{
            return true;
        }
    }
    function Create(){
        $result= mysqli_query($this->link, $this->sqlReq);
        if($result== false){
            echo "Bad request";
            return false; 
        }
        else{
            return true;
        }
    }


}


// $link = mysqli_connect("localhost", "root", "", "films");
// $sql= 'SELECT * FROM filmstable';   
// if($link== false){
//     echo "Errot, Can`t connect to the DB";

// }
// else{
    
//     $result= mysqli_query($link, $sql);
//     if($result== false){
//         echo 'error request' . mysqli_error($link);
//     }
//     else{
//         echo "good request";
//         var_dump($result);
//     }
// }

// ?>