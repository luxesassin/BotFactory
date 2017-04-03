<?php

/* 
 * This class is designed to render the Assembly page.
 */
 
class Assembly extends Application{
    function __construct()
    {
        parent::__construct();
        
        // basic settings
        $this->data['title'] = 'Assembly';
        $this->data['pagebody'] = 'Assembly';
        $this->data['workparms'] = array();
        $this->data['workresult'] = '';

        // get rpc & plant
        $this->data['umbrella'] = $this->properties->get('rpc');
        $this->trader = $this->properties->get('plant');
        $this->apikey = $this->properties->get('apikey');
        $this->plant = "umbrella";
        $this->data['message'] = '';
    }
    
    // index method, call polish() while loading
    function index(){
        $this->polish();
    }
    
    // polish method
    function polish()
    {
        // get role from session
        $role = $this->session->userdata('userrole');
        if ($role != ROLE_OWNER) {
            redirect($_SERVER['HTTP_REFERER']); // back where we came from
        }

        // get data in bots
        $this->data['bots_data'] = $this->factory->all('bots');
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
    
    // handle assemble and recycle
    function handle() 
    {
        // check if its a valid choice
        $valid = 0;

        // handle assemble parts
        if (isset($_POST['assemble'])) {
            if (isset($_POST['cb1']) && isset($_POST['cb2']) && isset($_POST['cb3'])) {
                // get IDs
                $ids1 = explode(',',implode(',',$_REQUEST['cb1']));
                $ids2 = explode(',',implode(',',$_REQUEST['cb2']));
                $ids3 = explode(',',implode(',',$_REQUEST['cb3']));
                
                if (count($ids1) == 1 && count($ids2) == 1 && count($ids3) == 1) {
                    $valid = 1;
                    $pieces = $ids1[0] . "," . $ids2[0] . "," . $ids3[0];
                    
                    // update bots and parts tables
                    $model = $this->factory->getModel($ids1[0]);
                    $this->factory->addBots($model, $pieces);
                    $this->factory->remove('parts', $ids1[0]);
                    $this->factory->remove('parts', $ids2[0]);
                    $this->factory->remove('parts', $ids3[0]);
                    
                    // update history
                    $message = "Built 1 bot";
                    $this->data['message'] = $message;
                    $this->factory->addHistory(3, 0, $message);
                }
            }

        } else if (isset($_POST['recycle']) && isset($_POST['cb'])) { // handle recycle bots
            // get IDs
            $ids = explode(',',implode(',',$_REQUEST['cb']));
            
            // only one picked
            if (count($ids) == 1) {
                $valid = 1;
                $server = $this->data['umbrella'] . '/work/recycle';

                // get pieces in bots table given $id
                $pieces = explode(',',$this->factory->getPieces($ids[0]));

                // we need our API key
                $apikey = $this->properties->get('apikey');
                $this->data['workparms'] = [
                    ['key' => 'key', 'value' => $apikey],
                    ['key' => 'part1', 'value' => $pieces[0]],
                    ['key' => 'part2', 'value' => $pieces[1]],
                    ['key' => 'part3', 'value' => $pieces[2]],
                ];

                $result = file_get_contents($server . '/' . $pieces[0] . '/' . $pieces[1]
                                            . '/' . $pieces[2] . '?key=' . $apikey);
                $this->data['workresult'] = $result;

                // Handle the recycle at our end
                if (substr($result, 0, 2) == 'Ok')
                {
                    // we're in, update bots table
                    $this->factory->remove('bots', $ids[0]);

                    // current balance
                    $old_balance = $this->data['balance'] = $this->properties->get('balance');

                    $balance = file_get_contents($this->data['umbrella'] . '/info/balance/' . $this->trader);
                    $this->properties->put('balance', $balance);

                    // update history table
                    $amount = $balance - $old_balance;
                    $message = "Recycled 1 bot, id: ".$ids[0];
                    $this->data['message'] = $message;
                    $this->factory->addHistory(1, $amount, $message);
                }
            } 
            
        }
        
        if ($valid == 0)
            $this->data['message'] = "You may mess up the choice, please try again!";
        
        $this->polish();
    }
}













