<?php

/* 
 * This class is designed to render the Parts page.
 */

class Parts extends Application{
    public function index(){
        $this->data['pagebody'] = 'parts';
		$source = $this->factory->all('parts'); // get all data in Parts table in the db.
		$partArr = array(); // empty array.
		foreach ($source as $record) {
			$partArr[] = array ('image' => $record->image, 'partname' => $record->ca, 'line' => $record->builtAt );
		} 
        $this->data['parts'] = $partArr;
        $this->data['title'] = 'test';
		$this->render();
		
    }
}

