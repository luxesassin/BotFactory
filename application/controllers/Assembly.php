<?php

/* 
 * This class is designed to render the Assembly page.
 */
 
class Assembly extends Application{
    public function index(){
        $this->data['pagebody'] = 'assembly';
        $this->data['parts'] = $this->factory->all('Parts');
        $this->render();
    }
}

