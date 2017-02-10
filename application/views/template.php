<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
        
    } 

if(isset($_GET['logout'])) {
    
    $_SESSION['username'] = '';
    header('Location:  ' . $_SERVER['PHP_SELF']);
}
if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $this->session->set_userdata('username', $_POST['username']);
        redirect('homepage');
    }else {
        //Invalid Login
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{pagetitle}</title>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    
    
    </script>
  </head>

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<nav class="navbar navbar-default navbar-inverse" role="navigation">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
                                           
						<li class="active">
							<a href="/">Home</a>
						</li>
                                                <li>
							<a href="/Assembly">Assembly</a>
						</li>
						<li>
							<a href="/Parts">Parts</a>
						</li>
						<li>
							<a href="/History">History</a>
						</li>
						<li>
							<a href="/About">About</a>
						</li>
						
                                                
                                                     
					</ul>
					
				</div>
				
			</nav>
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
				{content}
			</div>
		</div>
	</div>
</div>

    
  </body>
</html>