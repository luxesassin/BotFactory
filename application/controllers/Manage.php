<?php

/* 
 * This class is designed to render the Manage page.
 */

class Manage extends Application
{
    function __construct()
    {
        parent::__construct();
        
        // basic settings
        $this->data['title'] = 'Manage';
        $this->data['pagebody'] = 'Manage';
        $this->data['workparms'] = array();
        $this->data['workresult'] = '';

        // get rpc & plant
        $this->data['umbrella'] = $this->properties->get('rpc');
        $this->trader = $this->properties->get('plant');
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

        $this->data['bots'] = $this->factory->all('bots');
        $this->render();
    }
    
    // register on RPC
    function registerme()
    {
        // obtain input from the login page
        if (isset($_POST['plant']) && isset($_POST['token'])) {
            $server = $this->data['umbrella'] . '/work/registerme';

            $result = file_get_contents($server . '/' . $_POST['plant']. '/' . $_POST['token']);
            $this->data['workresult'] = $result;

            // Handle the registration response
            if (substr($result, 0, 2) == 'Ok')
            {
                // we're in
                $key = substr($result, 3);
                $this->data['message'] = "[Register: succeeded. key = ". $key . "]";
                $this->properties->put('apikey', $key);
                $balance = file_get_contents($this->data['umbrella'] . '/info/balance/' . $_POST['plant']);
                $this->properties->put('balance', $balance);
            } else {
                // failed!
                $this->data['message'] = "[Register: failed]";
                $this->properties->put('balance', 0);
                $this->properties->remove('apikey');
            }
            
            $this->factory->clear('parts');
            $this->factory->clear('bots');
            $this->factory->clear('history');
            $this->polish();
        }
    }
    
    // reboot to clear off bots, parts & history.
    function rebootme()
    {
        $server = $this->data['umbrella'] . '/work/rebootme';

        // we need our API key
        $apikey = $this->properties->get('apikey');
        $this->data['workparms'] = [['key' => 'key', 'value' => $apikey]];

        $result = file_get_contents($server . '?key=' . $apikey);
        $this->data['workresult'] = $result;

        // Handle the registration response
        if (substr($result, 0, 2) == 'Ok')
        {
            // we're in
            $this->data['message'] = "[Reboot: succeeded]";
            $this->factory->clear('parts');
            $this->factory->clear('bots');
            $this->factory->clear('history');
            $balance = file_get_contents($this->data['umbrella'] . '/info/balance/' . $this->trader);
            $this->properties->put('balance', $balance);
        } else {
            $this->data['message'] = "[Reboot: failed]";
        }

        $this->polish();
    }
    
    // send request to RPC to buy bots
    function sellbot()
    {
        // check if its a valid choice
        $valid = 0;
        
        if(isset($_POST['cb'])) {
            // get IDs
            $ids = explode(',',implode(',',$_REQUEST['cb']));

            // only one picked
            if (count($ids) == 1) {
                $valid = 1;
                $server = $this->data['umbrella'] . '/work/buymybot';

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

                // Handle the purchase at our end
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
                    $message = "Shipped 1 bot, id: ".$ids[0];
                    $this->data['message'] = $message;
                    $this->factory->addHistory(1, $amount, $message);
                }
            } 
        }

        if ($valid == 0)
            $this->data['message'] = "Please pick a bot for sale!";
        
        $this->polish();
    }
}

