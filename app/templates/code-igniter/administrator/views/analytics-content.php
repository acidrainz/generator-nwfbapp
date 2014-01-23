

<?php if(isset($_POST['content'])) { ?>
<div class="alert alert-success">Analytics has been successfully updated! <button type="button" class="close" data-dismiss="alert">&times;</button></div>
<? } ?>

<form method="post">
    <textarea id="content" class="span12" name="content" style="height:200px"><?php echo $analytics['content'] ?></textarea>
    <br class="clear" />
    <br />
    <input type="submit" class="btn" value="Update"  />
    <br class="clear" />
</form>



