<!--
 * This is the view for Manage page. There are several features 
 * appropriate for this page, handled by tabs or perhaps by separate
 * panels. 
-->
<h1>Manage Page</h1>

<form name="frm" id="frm" method="post" action="/Manage/sellbot">
    <div class="row">
        {bots}
        <div class="col-sm-3">
            <input type="checkbox" name="cb[]" value="{id}">
            <img width="60%" height="60%" src="/pix/{model}.jpg" title="model: {model}"/>
        </div>
        {/bots}
    </div>
    <div class="row btn-align2">
        <span><a href="/Register" class="btn btn-5">Register</a></span>
        <span class="span-align2"><a href="/Manage/rebootme" class="btn btn-5">Reboot</a></span>
        <span class="span-align2"><a onclick="document.forms['frm'].submit()" href="#" class="btn btn-5">Sell Bot</a></span>
        <span class="span-align2"><a href="/Settings" class="btn btn-5">Settings</a></span>
    </div>
    <div class="row msg">
    {message}
    </div>
</form>



