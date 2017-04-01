<h1>Manage Page</h1>

<h5>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</h5>

<?php if(!$registered) : ?>
<form method='POST' action='Manage/register'>
  Team name:<br>
  <input type="text" name="plant"><br>
  password:<br>
  <input type="text" name="token"><br>
  <input type='submit' value='Register'/>
</form>
<?php else : ?>
<form method='POST' action='Manage/rebootme'>
    <input type='submit' value='Reboot'/>
</form>
<?php endif; ?>



