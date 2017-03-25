<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * This class is designed to render the History page.
 */
class History extends Application
{
    function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->data['pagebody'] = 'history';

        // build the list of authors, to pass on to our view
        $source = $this->factory->all('History');
        $this->data['histories'] = $source;

        $this->render();
    }
}