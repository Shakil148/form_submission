<?php
require_once('application/controller/DatabaseConnection.php');
class Buyer {
    private $dbHandle;

    public function __construct(){
        $this->dbHandle = new DatabaseConnection();
    }

    public function index(){
        $sql = "SELECT * FROM buyer_reciept ORDER BY id";
        $result = $this->dbHandle->allDataQuery($sql);
        return $result;
    }

    public function search($data){
        $query = "SELECT * FROM buyer_reciept WHERE entry_at >= ? AND entry_at <= ? AND entry_by = ?";
        $paramType = "ssi";
        $paramValue = array(
            $data['from_date'],
            $data['to_date'],
            $data['entry_by']
        );
        
        $result = $this->dbHandle->searchQuery($query, $paramType, $paramValue);
        return $result;
    }

    public function create($data){
        $query = "INSERT INTO buyer_reciept (amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, city, phone, hash_key, entry_at, entry_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "isssssssissi";
        $salt = '$' . $data['buyer_email'] . '=$' . $data['amount'] . '$' . $data['city'];
        $data['items'] = implode(",",$data['items']);
        $paramValue = array(
            $data['amount'],
            $data['buyer'],
            $data['receipt_id'],
            $data['items'],
            $data['buyer_email'],
            $_SERVER['REMOTE_ADDR'],
            $data['note'],
            $data['city'],
            $data['phone'],
            crypt($data['receipt_id'], $salt),
            date('Y-m-d'),
            $data['entry_by'],
        );
        
        $insertId = $this->dbHandle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
}