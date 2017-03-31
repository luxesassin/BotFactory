<h1>Parts Page</h1>
<h3>Available Parts</h3>
<h3>{title}</h3>
<div class="row">
    {parts}
    <div class="col-sm-4">
        <input type="checkbox" name="partCheckbox" value="{image}">
        <img width="80%" height="80%" src="/pix/{image}" title="{partname} ({line})"  />
    </div>
    {/parts}
	
	<input type="button" value="Build more parts" style="margin-top: 1cm">
	<input type="button" value="Buy parts" style="margin-top: 1cm">
	
	
</div>
<br/>
<h5>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</h5>
