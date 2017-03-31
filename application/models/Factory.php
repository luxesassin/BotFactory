<?php

/**
 * This is a "CMS" model for Factory, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 * @author Durian
 */
class Factory extends CI_Model {
    // bots table
	var $bots = array(
		array('id' => 'B00001', 'model' => 'A', 'composition' => 'A10001,A20001,A30001',
              'image' => 'a.jpg', 'isValid' => '1'),
        array('id' => 'B00002', 'model' => 'B', 'composition' => 'B10001,B20001,B30001',
              'image' => 'b.jpg', 'isValid' => '1'),
        array('id' => 'B00003', 'model' => 'C', 'composition' => 'C10001,C20001,C30001',
              'image' => 'c.jpg', 'isValid' => '1'),
        array('id' => 'B00004', 'model' => 'M', 'composition' => 'M10001,M20001,M30001',
              'image' => 'm.jpg', 'isValid' => '1'),
        array('id' => 'B00005', 'model' => 'R', 'composition' => 'R10001,R20001,R30001',
              'image' => 'r.jpg', 'isValid' => '1'),
        array('id' => 'B00006', 'model' => 'W', 'composition' => 'W10001,W20001,W30001',
              'image' => 'w.jpg', 'isValid' => '1')
	);

    // parts table
    var $parts = array(
		array('id' => 'A10001', 'code' => 'A1', 'ca' => 'CA5670', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'a1.jpeg', 'isValid' => '1'),
        array('id' => 'A20001', 'code' => 'A2', 'ca' => 'CA5671', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'a2.jpeg', 'isValid' => '1'),
        array('id' => 'A30001', 'code' => 'A3', 'ca' => 'CA5672', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'a3.jpeg', 'isValid' => '1'),
        array('id' => 'B10001', 'code' => 'B1', 'ca' => 'CA8880', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'b1.jpeg', 'isValid' => '1'),
        array('id' => 'B20001', 'code' => 'B2', 'ca' => 'CA8881', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'b2.jpeg', 'isValid' => '1'),
        array('id' => 'B30001', 'code' => 'B3', 'ca' => 'CA8882', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'b3.jpeg', 'isValid' => '1'),
        array('id' => 'C10001', 'code' => 'C1', 'ca' => 'CA8883', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'c1.jpeg', 'isValid' => '1'),
        array('id' => 'C20001', 'code' => 'C2', 'ca' => 'CA8886', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'c2.jpeg', 'isValid' => '1'),
        array('id' => 'C30001', 'code' => 'C3', 'ca' => 'CA8889', 'builtAt' => 'BotFactory',
              'builtDate' => '2017-02-09 10:02:01', 'image' => 'c3.jpeg', 'isValid' => '1')
	);
    
    // history table
    var $history = array(
		array('id' => '1', 'transId' => 'T1700076', 'transDate' => '2017-02-01 10:02:01', 'type' => '0', 
              'amount' => '100', 'detail' => 'Purchased 10 boxes of parts', 'isValid' => '1'),
        array('id' => '2', 'transId' => 'T1700155', 'transDate' => '2017-02-03 10:02:05', 'type' => '0', 
              'amount' => '200', 'detail' => 'Purchased 20 boxes of parts', 'isValid' => '1'),
        array('id' => '3', 'transId' => 'T1700246', 'transDate' => '2017-02-04 10:02:01', 'type' => '1', 
              'amount' => '150', 'detail' => 'Shipments of 8 bots', 'isValid' => '1'),
        array('id' => '4', 'transId' => 'T1700351', 'transDate' => '2017-02-05 10:02:01', 'type' => '1', 
              'amount' => '80', 'detail' => 'Shipments of 5 bots', 'isValid' => '1'),
        array('id' => '5', 'transId' => 'T1700357', 'transDate' => '2017-02-07 10:02:01', 'type' => '1', 
              'amount' => '130', 'detail' => 'Shipments of 7 bots', 'isValid' => '1'),
        array('id' => '6', 'transId' => 'T1700456', 'transDate' => '2017-02-09 10:02:01', 'type' => '2', 
              'amount' => '40', 'detail' => 'Returned 8 parts', 'isValid' => '1')
	);
    
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	// retrieve a single quote
	public function get($table, $which)
	{
		// iterate over the data until we find the one we want
        foreach ($this->$table as $record)
            if ($record['id'] == $which)
                return $record;
		return null;
	}

	// retrieve all of the quotes
	public function all($table)
	{
        return $this->$table;
	}
    
    // retrieve # of rows in the table specified
    public function getCount($table)
    {
        $count = 0;
        // iterate over the data until we find the one we want
		foreach ($this->$table as $record)
			if ($record['isValid'] != '0')
				$count++;
		return $count;
    }

    // get spent or earned amount. type 0 - spent, 1 - earned
    public function getAmount($type)
    {
        $amount = 0;
        $temp = '';
        
        // iterate over the data until we find the one we want
		foreach ($this->history as $record) {
			if ($record['isValid'] != '0') {
                $temp = $record['type'];
                if (($type == '0' && $temp == $type) ||
                    ($type == '1' && ($temp == '1' || $temp == '2'))) {
                    $amount += $record['amount'];
                }
            }
        }
        
		return $amount;
    }
    
}
