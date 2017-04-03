<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * This class is designed to render the History page.
 */
class History extends Application
{
    private $items_per_page = 20;
    private $pageNum = 1;

    function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->page(1);
    }

    // Extract & handle a page of items, defaulting to the beginning
    function page($num = 1)
    {
        $this->pageNum = $num;

        $records = $this->factory->all('History'); // get all the history
        $arrHistory = array(); // start with an empty extract
        // use a foreach loop, because the record indices may not be sequential
        $index = 0; // where are we in the tasks list
        $count = 0; // how many items have we added to the extract
        $start = ($num - 1) * $this->items_per_page;
        foreach($records as $history)
        {
            if ($index++ >= $start)
            {
                $arrHistory[] = $history;
                $count++;
            }
            if ($count >= $this->items_per_page)
                break;
        }
        $this->data['pagination'] = $this->pagenav($num);
        $this->show_page($arrHistory);
    }

    // Show a single page of history items
    private function show_page($source)
    {
        $this->data['pagebody'] = 'history';

        // build the list of history, to pass on to our view
        $this->data['histories'] = $source;

        $this->render();
    }

    // Build the pagination navbar
    private function pagenav($num)
    {
        $records = $this->factory->all('History');
        $totalHistory = 0;
        foreach($records as $history)
            $totalHistory++;
        $lastpage = ceil($totalHistory / $this->items_per_page);
        $parms = array(
            'first' => 1,
            'previous' => (max($num-1,1)),
            'next' => min($num+1,$lastpage),
            'last' => $lastpage
        );

        return $this->parser->parse('itemnav',$parms,true);
    }

    // Set the number of records per page.
    public function recordsPerPage($num = 20)
    {
        $this->items_per_page = $num;
        //redirect($_SERVER['HTTP_REFERER']); // back where we came from

        $this->page($this->pageNum);
    }

    public function orderByDateTime($num = 1)
    {
        $this->pageNum = $num;

        $records = $this->factory->all('History'); // get all the history
        usort($records, "cmpByDateTime");
        $arrHistory = array(); // start with an empty extract
        // use a foreach loop, because the record indices may not be sequential
        $index = 0; // where are we in the tasks list
        $count = 0; // how many items have we added to the extract
        $start = ($num - 1) * $this->items_per_page;
        foreach($records as $history)
        {
            if ($index++ >= $start)
            {
                $arrHistory[] = $history;
                $count++;
            }
            if ($count >= $this->items_per_page)
                break;
        }
        $this->data['pagination'] = $this->pagenav($num);
        $this->show_page($arrHistory);
    }

    public function orderByrobotmodel($num = 1)
    {
    $this->pageNum = $num;

        $records = $this->factory->all('History'); // get all the history
        usort($records, "cmpByRobotModel");
        $arrHistory = array(); // start with an empty extract
        // use a foreach loop, because the record indices may not be sequential
        $index = 0; // where are we in the tasks list
        $count = 0; // how many items have we added to the extract
        $start = ($num - 1) * $this->items_per_page;
        foreach($records as $history)
        {
            if ($index++ >= $start)
            {
                $arrHistory[] = $history;
                $count++;
            }
            if ($count >= $this->items_per_page)
                break;
        }
        $this->data['pagination'] = $this->pagenav($num);
        $this->show_page($arrHistory);   
    }
}

function cmpByDateTime($a, $b)
{
    if ($a->transDate < $b->transDate)
        return -1;
    elseif ($a->transDate > $b->transDate)
        return 1;
    else
        return 0;
}

function cmpByRobotModel($a, $b)
{
    if ($a->transId < $b->transId)
        return -1;
    elseif ($a->transId > $b->transId)
        return 1;
    else
        return 0;
}