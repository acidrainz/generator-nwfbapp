

<?php if(isset($_POST['content'])) { ?>
<div class="alert alert-success">Updated<button type="button" class="close" data-dismiss="alert">&times;</button></div>
<? } ?>
<form method="post">
    <textarea id="content" name="content"><?php echo $mechanics['content'] ?></textarea>
    <br class="clear" />
    <br />
    <input type="submit" class="btn" value="Update"  />
    <br class="clear" />
</form>


<script src="<?=base_url()?>js/admin/texteditor/nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function(){
  new nicEditor({iconsPath : '<?=base_url()?>js/admin/texteditor/nicEditorIcons.gif'}).panelInstance('content');
});
</script>