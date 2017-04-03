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
        $this->data['itemsperpage'] = $this->properties->get('page');
        $this->render();
    }
    
    // update method. update RPC url & items per page.
    function update() {
        if (isset($_POST['url']) && isset($_POST['items'])) {
            $this->properties->put('rpc', $_POST['url']);
            $this->properties->put('page', $_POST['items']);
        }
        $this->polish();
    }
}

