<!--
 * This is the view for Settings page. Mainly used to 
 * set RPC url, items per page, etc.
-->
<h1>Settings Page</h1>

<form method='POST' action='/Settings/update'>
    <div class="login-title field-align2">
        RPC URL:
    </div>
    <div class="field-align2">
        <input type="text" name="url" value="{umbrella}" size="50" maxlength="30" required />
    </div>
    <div class="login-title field-align">
        ITEMS PER PAGE:
    </div>
    <div class="field-align2">
        <input type="text" name="items" value="{itemsperpage}" size="50" maxlength="30" required />
    </div>
    
    <div class="field-align2">
        <input type="submit" value="Update" class="btn btn-5" />
    </div>
</form>





