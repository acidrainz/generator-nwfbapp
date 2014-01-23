
<div class="error">
    <?php if(isset($_GET['error'])) : ?>
    <div class="alert alert-error"><?php echo $_GET['error']?></div>
    <?php endif?>
</div>
<form method="post" onsubmit="return validate()">
    <ul>
        <li> 
            <label>Acount Name:</label>
            <input type="text" id="account" name="account" value="<?=$this->session->userdata('user_account')?>"  />
        </li>

        <li> 
            <label>Username:</label>
            <input type="text" id="username" name="username" value="<?=$this->session->userdata('user_name')?>"  />
        </li>
        
        <!-- <li> 
            <label>Email Address:</label>
            <input type="text" name="email" value="<?=$this->session->userdata('user_email')?>"  />
        </li> -->

        <li> 
            <label>New Password:</label>
            <input type="password" id="new-password" name="new_password" autocomplete="off" />
        </li>

        <li> 
            <label>Old Password:</label>
            <input type="password" id="password" name="password" value=""   />
        </li>

         <li> 
            <label>&nbsp;</label>
            <input type="submit" class="btn" name="submit" value="Update"  />
        </li>
     </ul>
    
    <br class="clear" />
</form>

<script type="text/javascript">
    function validate() {
        a = document.getElementById('account').value;
    	u = document.getElementById('username').value;
        o = document.getElementById('password').value;

        if(a == '') {
            $('.error').html('<div class="alert alert-error">Plese enter account name.</div>');
            document.getElementById('account').focus();
            return false;
        }

    	if(u == '') {
            $('.error').html('<div class="alert alert-error">Plese enter a username.</div>');
            document.getElementById('username').focus();
            return false;
        }
    	
        if(o == '') {
            $('.error').html('<div class="alert alert-error">Plese enter your current password.</div>');
            document.getElementById('password').focus();
            return false;
        }
    }
</script>