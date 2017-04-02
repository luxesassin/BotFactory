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
        $this->data['pagebody'] = 'Assembly';
        
        //Retrieve all parts from DB
        //$this->data['parts'] = $this->factory->all('parts');
        $source = $this->factory->all('parts');
        $stuff = array();
            
        foreach ($source as $part) {
            $stuff[] = ["id" => $part->id, "code" => $part->model . $part->piece, 
                        "image" => $part->model . $part->piece . ".jpg", "plant" => $part->plant];
        }
        $this->data['parts'] = $stuff;
        
        //Retrieve all bots from DB
        $this->data['bots'] = $this->factory->all('bots');
        
        $this->render();
    }
    
    //Called when post request of assembling parts
    public function assemble(){
        if(
            isset($_POST['headCode']) 
            && isset($_POST['bodyCode']) 
            && isset($_POST['footCode'])
            && isset($_POST['headID'])
            && isset($_POST['bodyID'])
            && isset($_POST['footID'])
          )
        {
            //Model name of bot
            $model = substr($_POST['headCode'], 0, 1);
            
            // bot pieces
            $pieces = $_POST['headID'] . ',' . 
                      $_POST['bodyID'] . ',' . 
                      $_POST['footID'];

            //Add bot to DB
            $this->factory->addBots($model, $pieces);
            
            //Add history to DB
            $this->factory->addHistory(3, 0, "Assembled a bot" );
            
            //Delete the assembled parts from DB
            $this->factory->remove("parts", $_POST['headID']);
            $this->factory->remove("parts", $_POST['bodyID']);
            $this->factory->remove("parts", $_POST['footID']);
        }

        //Redirect to assembly page
        redirect('assembly');
    }
}

