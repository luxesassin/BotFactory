<?php

/**
 * Factory class implements database CRUD operations.
 *
 * @author Durian
 */
class Factory extends CI_Model {
    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // retrieve a single quote
    public function get($table, $which)
    {
        $query = $this->db->select('*')
                      ->where("id = '$which'")
                      ->get($table);
        return $query->result();
    }
    
    // set a record as inactive
    public function remove($table, $which)
    {
        $this->db->trans_start();
        $this->db->where('id', $which);
        $this->db->delete($table); 
        $this->db->trans_complete();
    }
    
    // retrieve all of the quotes
    public function all($table)
    {
        $query = $this->db->get($table);
        return $query->result();
    }
    
    // retrieve specified number of the quotes (records per page)
    public function partial($table, $numOfPage)
    {
        $query = $this->db->get($table, $numOfPage);
        return $query->result();
    }
    
    // retrieve # of rows in the table specified
    public function getCount($table)
    {
        return $this->db->count_all($table);
    }

    // get spent or earned amount from History. 
    // type 0 - spent, 1 - earned
    public function getAmount($type)
    {
        $query = $this->db->select_sum('amount', 'totalAmount')
                      ->where("('$type' = '0' AND type = '$type') 
                              OR ('$type' = 1 AND type != '0')")
                      ->get('History');
        $result = $query->result();
        return $result[0]->totalAmount;
    }

    // add Bots. $model: A, B, C, $comp: parts CAs, $image: png file
    public function addBots($model, $comp, $image)
    {
        $this->db->trans_start();
        $data = array( 
            'model' => $model, 
            'composition' => $comp, 
            'image' => $image);
        $this->db->insert('Bots', $data);
        $this->db->trans_complete();
    }
    
    // add Parts. $code: A, B, C, $ca: A10001, $image: png file
    public function addParts($code, $ca, $builtAt, $image)
    {
        $this->db->trans_start();
        $data = array( 
            'code' => $code, 
            'ca' => $ca, 
            'builtAt' => $builtAt, 
            'builtDate' => date('Y-m-d H:i:s'), 
            'image' => $image);
        $this->db->insert('Parts', $data);
        $this->db->trans_complete();
    
        
    }
    
    /* 
     * add Transaction. 
     * $type: 0-purchase, 1-shipment, 2-return
     * $amount: amount of the transaction
     * $detail: details of the transaction
     */
    public function addHistory($type, $amount, $detail)
    {
        $this->db->trans_start();
        $data = array( 
            'transDate' => date('Y-m-d H:i:s'), 
            'type' => $type, 
            'amount' => $amount, 
            'detail' => $detail 
        );
        $this->db->insert("History", $data);
        $id = $this->db->insert_id();
        $data = array( 
            'transId' => makeTransId($id)
        );
        
        $this->db->where('id', $id);
        $this->db->update('History', $data);
        $this->db->trans_complete();
    }
}

// make new transaction ID
function makeTransId($id)
{
    $transId = $id + 1700000;
    return "T".$transId;
}
