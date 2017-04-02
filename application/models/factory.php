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
        if ($table == 'parts') {
            $this->db->delete($table, array('id' => $which)); 
        } else {
            $this->isValid = '0';
            $this->db->update($table, $this, array('id' => $which));
        }
        $this->db->trans_complete();
    }
    
    // clear off a table specified
    public function clear($table)
    {
        if ($table == 'parts') {
            $this->db->empty_table($table); 
        } else {
            $this->db->update($table, array('isValid' => '0')); 
        }
    }
    
    // retrieve all of the quotes
    public function all($table)
    {
        $this->db->from($table);
        if ($table != 'parts')
            $this->db->where("isValid = '1'");
        if ($table != 'history')
            $this->db->order_by("model asc, id asc");
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // retrieve data from history table per sortId
    public function sortAll($sortId)
    {
        $col = getColumn($sortId);
        $this->db->from('history');
        $this->db->where("isValid = '1'");
        $this->db->order_by($col);
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // retrieve all by group, applicable for parts
    public function allByGroup($table, $group)
    {
        $this->db->from($table);
        $this->db->where("piece = '$group'");
        $this->db->order_by("model asc, id asc");
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // retrieve specified number of the quotes (records per page)
    public function partial($table, $numOfPage)
    {
        if ($table != 'parts')
            $this->db->where("isValid = '1'");
        $query = $this->db->get($table, $numOfPage); 
        return $query->result();
    }
    
    // retrieve # of rows in the table specified
    public function getCount($table)
    {
        if ($table == 'parts')
            return $this->db->count_all($table);
        else 
            return $this->db->count_all_results($table, array('isValid' =>'1'));
    }

    // get spent or earned amount from History. 
    // type 0 - spent, 1 - earned
    public function getAmount($type)
    {
        $query = $this->db->select_sum('amount', 'totalAmount')
                      ->where("(('$type' = '0' AND type = '$type') 
                              OR ('$type' = 1 AND type != '0'))
                              AND isValid = '1'")
                      ->get('history');
        $result = $query->result();
        return $result[0]->totalAmount;
    }
    
    // retrieve model in parts table given $id
    public function getModel($id)
    {
        $query = $this->db->select('model')
                      ->where("id = '$id'")
                      ->get('parts');
        $result = $query->result();
        return $result[0]->model;
    }
    
    // retrieve pieces in bots table given $id
    public function getPieces($id)
    {
        $query = $this->db->select('pieces')
                      ->where("id = '$id'")
                      ->get('bots');
        $result = $query->result();
        return $result[0]->pieces;
    }
    
    // retrieve sort item per $id
    public function getItem($id)
    {
        $query = $this->db->select('value')
                      ->where("id = '$id'")
                      ->get('sorts');
        $result = $query->result();
        return $result[0]->value;
    }
    
    // add Bots. $model: a, b, c, $pieces: parts CAs
    public function addBots($model, $pieces)
    {
        $this->db->trans_start();
        $data = array( 
            'model' => $model, 
            'pieces' => $pieces);
        $this->db->insert('bots', $data);
        $this->db->trans_complete();
    }

    /* 
     * add Transaction. 
     * $type: 0-purchase, 1-sell/shipment, 2-return, 3-assemble
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
        $this->db->insert("history", $data);
        $id = $this->db->insert_id();
        $data = array( 
            'transId' => makeTransId($id)
        );
        
        $this->db->where('id', $id);
        $this->db->update('history', $data);
        $this->db->trans_complete();
    }
}

// make new transaction ID
function makeTransId($id)
{
    $transId = $id + 1700000;
    return "T".$transId;
}

// convert sortId to column name of history table
function getColumn($sortId)
{
    $col = "transId";
    if ($sortId == 2) $col = "transDate";
    else if ($sortId == 3) $col = "type";
    else if ($sortId == 4) $col = "amount";
    return $col;
}
