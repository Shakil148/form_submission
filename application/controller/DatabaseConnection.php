<?php
require_once('config/config.php');

class DatabaseConnection extends Connection {
    private $connection;

    public function __construct(){
        $this->connection = $this->DatabaseConn();
    }

    public function allDataQuery($query) {
        $result = $this->connection->query($query);  
        
        if(!empty($result)){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $resultset[] = $row;
                }
                return $resultset;
            }
        }else{
            return false;
        }
    }

    public function searchQuery($query, $param_type, $param_value_array){
        $sql = $this->connection->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }

    public function DatabaseConn(){
        $connection = mysqli_connect($this->_host, $this->_user, $this->_password, $this->_database);
        return $connection;
    }

    public function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }

    public function insert($query, $param_type, $param_value_array) {
        $sql = $this->connection->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $insertId = $sql->insert_id;
        return $insertId;
    }
}