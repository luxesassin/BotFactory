<?php

/* 
 * This class is designed to render the Parts page.
 */

class Parts extends Application{
    function __construct()
    {
        parent::__construct();
        
        // basic settings
        $this->data['title'] = 'Parts';
        $this->data['pagebody'] = 'Parts';
        $this->data['workparms'] = array();
        $this->data['workresult'] = '';

        // get rpc & plant
        $this->data['umbrella'] = $this->properties->get('rpc');
        $this->trader = $this->properties->get('plant');
        $this->apikey = $this->properties->get('apikey');
    }
    
    // index method, call polish() while loading
    function index(){
        $this->polish();
    }
    
    // polish method
    private function polish()
    {
        $this->data['balance'] = $this->properties->get('balance');
        
        // get data by group in parts table
        for( $i = 1; $i < 4; $i++) {
            $source = $this->factory->allByGroup('parts', $i);
            $stuff = array();
            
            foreach ($source as $part) {
                $stuff[] = ["id" => $part->id, "model" => $part->model . $part->piece, 
                            "image" => $part->model . $part->piece . ".jpg", "plant" => $part->plant];
            }
            
            $tmp = "parts_data".$i;
            $this->data[$tmp] = $stuff;
        }

        $this->render();
    }

    // build parts. send request to RPC.
    function buildpart()
    {
        $server = $this->data['umbrella'] . '/work/mybuilds';

        // we need our API key
        $apikey = $this->properties->get('apikey');
        $this->data['workparms'] = [['key' => 'key', 'value' => $apikey]];

        $result = file_get_contents($server . '?key=' . $apikey);
        $this->data['workresult'] = $result;

        // Handle the bought boxes response
        if (substr($result, 0, 4) != 'Oops')
        {
            $count = 0;
            $results = json_decode($result);
            
            // update bots table
            foreach ($results as $record) {
                $this->db->insert('parts', $record);
                $count++;
            }
            
            // current balance
            $old_balance = $this->data['balance'] = $this->properties->get('balance');
             
            // update balance
            $balance = file_get_contents($this->data['umbrella'] . '/info/balance/' . $this->trader);
            $this->properties->put('balance', $balance);
            
            // update history table
            $amount = $balance - $old_balance;
            $message = "Built " . $count . " bots";
            $this->factory->addHistory('0', $amount, $message);
        }

        $this->polish();
    }
    
    // buy box. send request to RPC.
    function buybox()
    {
        $server = $this->data['umbrella'] . '/work/buybox';

        // we need our API key
        $apikey = $this->properties->get('apikey');
        $this->data['workparms'] = [['key' => 'key', 'value' => $apikey]];

        $result = file_get_contents($server . '?key=' . $apikey);
        $this->data['workresult'] = $result;

        // Handle the bought boxes response
        if (substr($result, 0, 4) != 'Oops')
        {
            $count = 0;
            $results = json_decode($result);

            // update bots table
            foreach ($results as $record) {
                $this->db->insert('parts', $record);
                $count++;
            }
            
             // current balance
            $old_balance = $this->data['balance'] = $this->properties->get('balance');
            
            // update balance
            $balance = file_get_contents($this->data['umbrella'] . '/info/balance/' . $this->trader);
            $this->properties->put('balance', $balance);
            
            // update history table
            $amount = $balance - $old_balance;
            if ($amount < 0) $amount = -1 * $amount;
            $message = "Purchased " . $count . " bots";
            $this->factory->addHistory('0', $amount, $message);
        }

        $this->polish();
    }
}

