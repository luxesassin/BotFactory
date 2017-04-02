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
        
        // # items per page
        $this->itemsPerPage = $this->properties->get('page');

        // default sort id
        $this->sort = 1;
        $this->data['sort'] = "Transaction ID";
    }
    
    // index method, call page() while loading
    public function index()
    {
        //Get the value from the select control
        $sort = $this->input->post('sort');

        if($sort === NULL || is_null($sort)) $sort = 1;
        
        //Put the value in an array to pass to the view. 
        $this->sort = $sort;
        $this->data['sort'] = $this->factory->getItem($sort);
        
        $this->page(1);
    }
    
    // show single page of items specified
    private function showPage($records)
    {
        $this->data['histories'] = '';
        $this->data['histories'] = $records;

        $this->data['pagebody'] = 'History';
        $this->render();
    }
    
    // Extract & handle a page of items, defaulting to the beginning
    function page($num = 1)
    {
        // retrieve all data from history table per sorting
        $source = $this->factory->sortAll($this->sort);
        $records = array(); // start with an empty extract

        // use a foreach loop, because the record indices may not be sequential
        $index = 0; // where are we in the tasks list
        $count = 0; // how many items have we added to the extract
        $start = ($num - 1) * $this->itemsPerPage;
        
        foreach($source as $record) {
            if ($index++ >= $start) {
                $records[] = $record;
                $count++;
            }
            if ($count >= $this->itemsPerPage) break;
        }
        
        $this->data['pagination'] = $this->pagenav($num);
        $this->showPage($records);
    }
    
    // Build the pagination navbar
    private function pagenav($num) {
        $lastpage = ceil($this->factory->getCount('history') / $this->itemsPerPage);
        $parms = array(
            'first' => 1,
            'previous' => (max($num-1,1)),
            'next' => min($num+1,$lastpage),
            'last' => $lastpage
        );
        return $this->parser->parse('itemnav',$parms,true);
    }
}