<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{pagetitle}</title>
    <link rel='stylesheet' type='text/css' href='/assets/css/custom.css'>
</head>
<body>

<div id="container">
	<h1>Welcome to {pagetitle}</h1>

	<div id="body">
        <h3>Inventory Outline</h3>
        <div class="rowstats">
            Number of Parts on hand: <span class ="rownum_1">{numParts}</span>    
        </div>
        <div class="rowstats">
            Number of Assembled Bots on hand: <span class ="rownum_2">{numBots}</span>    
        </div>
        <div class="rowstats">
            Spent Amount: <span class ="rownum_1">${spentAmount}</span>    
        </div>
        <div class="rowstats">
            Earned Amount: <span class ="rownum_2">${earnedAmount}</span>    
        </div>
        <div class="span4"><a href="."><img src="/pix/a.jpg" width="300" title=""/></a></div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>