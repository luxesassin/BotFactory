<h1>Assembly Page</h1>
<button onclick="buildIt()">Build it</button>
<button onclick="">Return to head office</button>
<h3>Select Parts</h3>
<div class="row">
    {parts}
    <div class="col-sm-4">
        <input type="checkbox" name="partCheckbox" value="{image}">
        <img width="80%" height="80%" src="/pix/{image}"/>
    </div>
    {/parts}
</div>

<br>
<h3>Built bot<h3>
<div class="row">
    <div class="col">
        <img id="head" src=""/>
    </div>
</div>
<div class="row">
    <div class="col">
        <img id="body" src=""/>
    </div>
</div>
<div class="row">
    <div class="col">
        <img id="foot" src=""/>
    </div>
</div>

<h5>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</h5>

<script>
    function buildIt(){
        var checkedItems = document.querySelectorAll('input[name="partCheckbox"]:checked');
        var numChecked = checkedItems.length;
        
        if(numChecked != 3){
             alert('Select correct each of head,body and foot part');
             return;
         }
         
         var head,body,foot;
         for(var i=0; i<numChecked; i++){
             if(/[1]/.test(checkedItems[i].value))
                 head = checkedItems[i];
             else if(/[2]/.test(checkedItems[i].value))
                 body = checkedItems[i];
             else if(/[3]/.test(checkedItems[i].value))
                 foot = checkedItems[i];
         }
         
         if(!head || !body || !foot){
             alert('Select correct each of head,body and foot part');
             return;
         }
         
         document.getElementById("head").src="/pix/"+head.value;
         document.getElementById("body").src="/pix/"+body.value;
         document.getElementById("foot").src="/pix/"+foot.value;
         
    }
</script> 