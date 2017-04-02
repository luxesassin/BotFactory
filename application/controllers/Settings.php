<?php

/* 
 * This class is designed to render the Settings page.
 */

class Settings extends Application
{
    // index method, call polish() while loading
    public function index(){
        $this->polish();
    }
    
    // polish method
    function polish() {
        $this->data['pagebody'] = 'Settings';
        $this->data['umbrella'] = $this->properties->get('rpc');
        $this->render();
    }
    
    // update method. update RPC url.
    function update() {
        if (isset($_POST['url'])) {
            $this->properties->put('rpc', $_POST['url']);
        }
        $this->polish();
    }
}

