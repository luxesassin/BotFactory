<!--
 * This is the view for Parts page. The parts page (for the "Worker" role)
 * shows all the parts currently on hand, ordered reasonably (piece type) 
 * in a grid with images. Show the model & line as either a tooltip for 
 * the image, or underneath each. 
-->
<h1>Parts Page</h1>
<h3>Available Parts</h3>
<div class="row">
    <div class="col-sm-4">
        {parts_data1}
        <div class="parts-align">
            <input type="checkbox" name="partCheckbox" value="{image}">
            <a href="/PartDetails/{id}">
                <img width="60%" height="60%" src="/pix/{image}" title="{model}, {plant}"/>
            </a>
        </div>
        {/parts_data1}
    </div>
     <div class="col-sm-4">
        {parts_data2}
        <div class="parts-align">
            <input type="checkbox" name="partCheckbox" value="{image}">
            <a href="/PartDetails/{id}">
                <img width="60%" height="60%" src="/pix/{image}" title="{model}, {plant}"/>
            </a>
        </div>
        {/parts_data2}
     </div>
     <div class="col-sm-4">
        {parts_data3}
        <div class="parts-align">
            <input type="checkbox" name="partCheckbox" value="{id}">
            <a href="/PartDetails/{id}">
                <img width="60%" height="60%" src="/pix/{image}" title="{model}, {plant}"/>
            </a>
        </div>
        {/parts_data3}
     </div>
</div>
<div class="row btn-align2">
    <span><a href="/Parts/buildpart" class="btn btn-5">Build Parts</a></span>
    <span class="span-align"><a href="/Parts/buybox" class="btn btn-5">Buy Parts</a></span>
</div>
