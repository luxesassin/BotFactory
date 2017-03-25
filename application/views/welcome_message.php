<div id="container">
    <h1>{pagetitle}</h1>

    <div id="body">
        <p class="chart_align"></p>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back yok-box">
                    <span class="icon-box bg-color-pink set-icon">
                        <i class="glyphicon glyphicon-briefcase"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">{numBots}</p>
                        <p class="text-muted">assembled robots</p>
                    </div>
                 </div>
             </div>
             <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back yok-box">
                    <span class="icon-box bg-color-sky set-icon">
                        <i class="glyphicon glyphicon-briefcase"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">{numParts}</p>
                        <p class="text-muted">parts in stock</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back yok-box">
                    <span class="icon-box bg-color-green set-icon">
                        <i class="glyphicon glyphicon-thumbs-down"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">${spentAmount}</p>
                        <p class="text-muted">$ spent</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back yok-box">
                    <span class="icon-box bg-color-amber set-icon">
                        <i class="glyphicon glyphicon-thumbs-up"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">${earnedAmount}</p>
                        <p class="text-muted">$ earned</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body text-center">
             <div id="sales-chart"></div>
        </div>
        <script>
            var earned = '<?php echo $earnedAmount;?>';
            var spent = '<?php echo $spentAmount;?>';
            var colors_array= ["#00DE5E", "#FFCC00"];
            
            function salesChart(earned, spent){
                Morris.Donut({
                  element: 'sales-chart',
                  colors: colors_array,
                  data: [
                    {label: "$ spent", value: earned},
                    {label: "$ earned", value: spent}
                  ]
                });
            }

            window.onload = function() {
                salesChart(spent, earned);
            };

        </script>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>