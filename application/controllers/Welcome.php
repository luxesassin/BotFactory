<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * This class is designed to render the Dashboard page.
 */
class Welcome extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function index()
    {
        $this->data['pagebody'] = 'welcome_message';
        $role = $this->session->userdata('userrole');

        // stock outline
        $this->data['numParts'] = $this->factory->getCount('Parts');
        $this->data['numBots'] = $this->factory->getCount('Bots');
        $this->data['spentAmount'] = $this->factory->getAmount('0');
        $this->data['earnedAmount'] = $this->factory->getAmount('1');
        
        // render the page
        $this->render(); 
    }

}
