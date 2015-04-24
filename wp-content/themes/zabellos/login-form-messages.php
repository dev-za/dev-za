<?php if(!empty($_REQUEST['login']) && $_REQUEST['login'] == 'failed'):?>
    <p class="text-danger">Either the email or password you entered is invalid.</p>

<?php endif;?>
<?php if(!empty($_REQUEST['checkemail']) && $_REQUEST['checkemail'] == 'confirm'):?>
    <p class="text-muted">Check your e-mail for the confirmation link.</p>

<?php endif;?>
