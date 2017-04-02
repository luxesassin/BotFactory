<?php

/* 
 * This class is designed to render the Register page.
 */

class Register extends Application
{
    // index method
    public function index(){
        $this->data['pagebody'] = 'Register';
        $this->render();
    }
}

