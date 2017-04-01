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
        $this->data['registered'] = isset($this->session->apikey);
        $this->render();
    }
    
    function rebootme(){
        if(isset($this->session->apikey)){
            $this->load->library("unirest");
            $url = 'https://umbrella.jlparry.com/work/rebootme?key=' . $this->session->apikey;       
            $response = $this->unirest->get($url, $headers = array());

            if($response->body == "Ok"){
                //TODO delete history and inventory in db
                
            }else{

            }
        }else{
            //showing error message 
        }
        redirect('manage');
    }
    
    function register(){
      if (isset($_POST['plant']) && isset($_POST['token'])) {
        $this->load->library("unirest");
        $url = 'https://umbrella.jlparry.com/work/registerme/'. $_POST['plant'] . '/' . $_POST['token'];       
        $response = $this->unirest->get($url, $headers = array());

           $data = explode(" ", $response->body);
            if($data[0] == "Ok"){
                $this->session->apikey = $data[1]; 
            }else{
                //show $response->body
            }
      }else {
          //showing error for requied inputs
      }
      redirect('manage');

    }
}

