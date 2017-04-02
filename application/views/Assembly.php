
<!--
 * This is the view for assembly page.
 * User can selects parts from list to assemble a new bot or
 * return it to head office.
-->

<h1>Assembly Page</h1>
<div id="selectParts">
    <h3>Select Parts</h3>
    <div class="row">
        {parts}
        <div class="col-sm-4">
            <input type="checkbox" name="partCheckbox" data-image="{image}" data-id="{id}" data-code="{code}" data-ca="{ca}">
            <img width="80%" height="80%" src="/pix/{image}"/>
        </div>
        {/parts}
    </div>
    <button onclick="assemble()">Assemble it</button>
    <button onclick="">Return to head office</button>
</div>

<br>
<div id="assemblingBot" hidden>
    <h3>Built bot</h3>
    <form id="assembleForm" onsubmit="return confirm()" method="post" action="Assembly/assemble">
        <div class="row">
            <div class="col">
                <img id="head" src=""/>
                <input type="text" name="head" id="headCode" hidden>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img id="body" src=""/>
                <input type="text" name="body" id="bodyCode" hidden>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img id="foot" src=""/>
                <input type="text" name="foot" id="footCode" hidden>
            </div>
        </div>
        <button type="submit" value="Confirm">Confirm</button>
        <button type="reset" onclick="cancel()" value="Cancel">Cancel</button>
    </form>
</div>

<h3>Assembled Bot(s)</h3>
<div class="row">
    {bots}
    <div class="col-sm-4">
        <input type="checkbox" name="botCheckbox" data-image="{image}" data-code="{code}" data-ca="{ca}">
        <img width="80%" height="80%" src="/pix/{image}"/>
    </div>
    {/bots}
</div>
<button onclick="">Ship it</button>

        
<h5>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</h5>
<script type="text/javascript" src="js/assembly.js"></script>