<?php

/* 
 * This class is designed to render the Manage page.
 */

class Manage extends Application
{
    public function index(){
        // get role from session
        $role = $this->session->userdata('userrole');
        if ($role != ROLE_OWNER) {
            redirect($_SERVER['HTTP_REFERER']); // back where we came from
        }
        
        $this->data['pagebody'] = 'manage';
        $this->render();
    }
}

