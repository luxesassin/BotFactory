<?php

/* 
 * This class is designed to render the Parts page.
 */

class Parts extends Application{
    public function index(){
        $this->data['pagebody'] = 'parts';
        $this->data['parts'] = $this->factory->all('Parts');
        $this->render();
    }
}

