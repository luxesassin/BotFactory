<!--
 * This is the view for assembly page.
 * User can selects parts from list to assemble a new bot or
 * return it to head office.
-->

<h1>Assembly Page</h1>
<h3>Select Parts</h3>
<form name="frm" id="frm" method="post" action="/Assembly/handle">
    <div class="row">
        <div class="col-sm-4">
            {parts_data1}
            <div class="parts-align">
                <input type="checkbox" name="cb1[]" value="{id}">
                <img width="60%" height="60%" src="/pix/{image}" title="{model}, {plant}"/>
            </div>
            {/parts_data1}
        </div>
         <div class="col-sm-4">
            {parts_data2}
            <div class="parts-align">
                <input type="checkbox" name="cb2[]" value="{id}">
                <img width="60%" height="60%" src="/pix/{image}" title="{model}, {plant}"/>
            </div>
            {/parts_data2}
         </div>
         <div class="col-sm-4">
            {parts_data3}
            <div class="parts-align">
                <input type="checkbox" name="cb3[]" value="{id}">
                <img width="60%" height="60%" src="/pix/{image}" title="{model}, {plant}"/>
            </div>
            {/parts_data3}
         </div>
    </div><br>
    
    <h3>Assembled Bots</h3>
    <div class="row">
        {bots_data}
        <div class="col-sm-4">
            <div class="parts-align">
                <input type="checkbox" name="cb[]" value="{id}">
                <img width="60%" height="60%" src="/pix/{model}.jpg" title="model: {model}"/>
            </div>
        </div>
        {/bots_data}
    </div>
    <div class="row btn-align2">
        <span><input type="submit" name="assemble" value="Assemble" class="btn btn-5"/></span>
        <span class="span-align2"><input type="submit" name="recycle" value="Recycle" class="btn btn-5"/></span>
    </div>
    <div class="row msg">
    {message}
    </div>
</form>