
    <div class="error">
        <?php if(isset($_GET['error'])) : ?>
        <div class="alert alert-error"><?php echo $_GET['error']?></div>
        <?php endif?>
    </div>
    <form method="post" onsubmit="return validate()">
        <ul>
            <li>
                <label>Acount Name:</label>
                <input type="text" name="account" autocomplete="off" value="<?php if(isset($user)) echo $user['account_name']; ?>"  />
            </li>

            <li>
                <label>Username:</label>
                <input type="text" name="username" autocomplete="off" value="<?php if(isset($user)) echo $user['uname']?>" />
            </li>

            <li>
                <label>Password:</label>
                <input type="password" name="password" autocomplete="off" value="<?php if(isset($user)) echo 'oooooo' ?>" />
            </li>

            <li>
                <label>Confirm Password:</label>
                <input type="password" name="re-password" value="<?php if(isset($user)) echo 'oooooo' ?>" />
            </li>


            <li>
                <label>User Level:</label>
                <select name="level">
                    <option value="3" <?php if(isset($user) && $user['level']==3) echo 'selected="selected"'  ?> >Viewer</option>
                    <option value="2" <?php if(isset($user) && $user['level']==2) echo 'selected="selected"'  ?>>CMS Manager</option>
                    <option value="1" <?php if(isset($user) && $user['level']==1) echo 'selected="selected"'  ?>>Super Admin</option>
                </select>
            </li>

             <li>
                <label>&nbsp;</label>
                <input type="submit" class="btn" name="submit" value="Submit"  />
            </li>
         </ul>

        <br class="clear" />
    </form>


<script type="text/javascript">
    function validate() {

        var error = false;
        var elem;
        $('input, select').each(function(){
            elem = $(this);
            var name = elem.attr('name');
            if(elem.val()==''){
                error = "All fields are required.";
                return false;
            }
            else if(name=='re-password'){
                if( elem.val() != $('input[name="password"]').val() ){
                    error = "Passwords did not match.";
                    return false;
                }
            }
        });

        if(error){
            elem.focus();
            $('.error').html('<div class="alert alert-error">'+error+'</div>');
            return false;
        }

    }
</script>
