<?php

/* 
 * This class is designed to render the About page.
 */

class About extends Application{
    public function index(){
        $this->data['pagebody'] = 'About';
        $this->render();
    }
}

