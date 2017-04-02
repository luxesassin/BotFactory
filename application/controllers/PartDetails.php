<?php

/* 
 * This class is designed to render the Part details.
 */

class PartDetails extends Application{
    public function index(){
        $this->data['pagebody'] = 'PartDetails';

        // get $id
        $id = $this->uri->segment(2);

        // get Part details per $id
        $source = $this->factory->get('parts', $id);
        
        // set array
        $details = array();
        
        // loop through the record, store the result into the array
        foreach($source as $record) {
            $details[] = array(
                            'id' => $record->id, 
                            'model' => $record->model . $record->piece,
                            'plant' => $record->plant,
                            'stamp' => $record->stamp
                            );
        } 
        
        $this->data['part_details'] = $details;
        $this->render();
    }
}

