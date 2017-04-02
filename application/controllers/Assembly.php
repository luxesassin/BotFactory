<?php

/* 
 * This class is designed to render the Assembly page.
 */
 
class Assembly extends Application{
    public function index(){
        // get role from session
        $role = $this->session->userdata('userrole');
        if ($role != ROLE_OWNER) {
            redirect($_SERVER['HTTP_REFERER']); // back where we came from
        }
        $this->data['pagebody'] = 'assembly';
        //Retrieve all parts from DB
        $this->data['parts'] = $this->factory->all('Parts');
        //Retrieve all bots from DB
        $this->data['bots'] = $this->factory->all('Bots');
        $this->render();
    }
    
    //Called when post request of assembling parts
    public function assemble(){
        if(
                isset($_POST['headCA']) 
                && isset($_POST['bodyCA']) 
                && isset($_POST['footCA'])
                && isset($_POST['headID'])
                && isset($_POST['bodyID'])
                && isset($_POST['footID'])
          )
            {
                //Model name of bot
                $model = substr($_POST['headCA'], 0, 1);
                
                //Composition of bot
                $comp = $_POST['headCA'] . ',' . 
                        $_POST['bodyCA'] . ',' . 
                        $_POST['footCA'];
                
                //image file of bot
                $image = strtolower($model) . '.jpg';
                
                //Add bot to DB
                $this->factory->addBots($model, $comp, $image);
                
                //Add history to DB
                $this->factory->addHistory(3, 100, "Assembled a bot" );
                
                //Delete the assembled parts from DB
                $this->factory->remove("Parts", $_POST['headID']);
                $this->factory->remove("Parts", $_POST['bodyID']);
                $this->factory->remove("Parts", $_POST['footID']);
           
            }
        //Redirect to assembly page
        redirect('assembly');
    }
    
    
}

