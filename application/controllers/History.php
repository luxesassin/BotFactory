<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application
{
    function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
		/*$this->data['pagebody'] = 'history';
        
        $source = $this->history->all();
        $history = array();
        
        foreach($source as $record)
        {
            $history[] = array( 'id' => $record['id'], 
                                'transId' => $record['transId'],
                                'transDate' => $record['transDate'], 
                                'type' => $record['type'],
                                'amount' => $record['amount'],
                                'detail' => $record['detail'],
                                'isValid' => $record['isValid']);
        }
        $this->data['histories'] = $history;
        $this->render();*/

        $this->data['pagebody'] = 'history';

		// build the list of authors, to pass on to our view
		$source = $this->factory->history;
		$this->data['histories'] = $source;

		$this->render();
    }
}