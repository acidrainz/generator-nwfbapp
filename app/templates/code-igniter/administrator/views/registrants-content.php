<div class="page-controls">
	<a class="btn advanced"> <i class="icon-search"></i><span class="hidden-phone"> Advance Query</span></a>
     <a href="<?=site_url('export/registrants?'.http_build_query($_GET, '', "&"))?>" class="btn hidden-phone"><i class="icon-download-alt"></i> Export</a>

     <div class=" advance-search">
        <div class="form-content">
            <form class="form-search">

                <div class="input-prepend">
                    <span class="add-on">FBID</span>
                    <input type="text" class="input-small" name="fbid" value="<?=isset($_GET['fbid']) ? $_GET['fbid'] : '' ?>" >
                </div>

                <div class="input-prepend">
                    <span class="add-on">NAME</span>
                    <input type="text" class="input-medium" name="name" value="<?=isset($_GET['name']) ? $_GET['name'] : '' ?>">
                </div>
                

                <div class="input-prepend">
                    <span class="add-on">GENDER</span>
                    <select name="gender" class="input-small">
                        <option></option>
                        <option <?=isset($_GET['gender']) && $_GET['gender']=='Male'  ? 'selected="selected"' : '' ?> >Male</option>
                        <option <?=isset($_GET['gender']) && $_GET['gender']=='Female'  ? 'selected="selected"' : '' ?> >Female</option>
                    </select>
                </div>

                <div class="input-prepend">
                    <span class="add-on">BIRTHDAY</span>
                    <select name="bmonth" class="input-medium">
                        <option value=""></option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='1'  ? 'selected="selected"' : ''?> value="1">January</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='2'  ? 'selected="selected"' : ''?> value="2">February</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='3'  ? 'selected="selected"' : ''?> value="3">March</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='4'  ? 'selected="selected"' : ''?> value="4">April</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='5'  ? 'selected="selected"' : ''?> value="5">May</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='6'  ? 'selected="selected"' : ''?> value="6">June</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='7'  ? 'selected="selected"' : ''?> value="7">July</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='8'  ? 'selected="selected"' : ''?> value="8">August</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='9'  ? 'selected="selected"' : ''?> value="9">September</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='10'  ? 'selected="selected"' : ''?> value="10">October</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='11'  ? 'selected="selected"' : ''?> value="11">November</option>
                         <option <?=isset($_GET['bmonth']) && $_GET['bmonth']=='12'  ? 'selected="selected"' : ''?> value="12">December</option>
                    </select>
                </div>
                

                <div class="input-prepend">
                    <span class="add-on">EMAIL</span>
                    <input type="text" class="input-medium" name="email" value="<?=isset($_GET['email']) ? $_GET['email'] : '' ?>"  >
                </div>

                <div class="input-prepend">
                    <span class="add-on">MOBILE</span>
                    <input type="text" class="input-medium" name="mobile" value="<?=isset($_GET['mobile']) ? $_GET['mobile'] : '' ?>" >
                </div>


                <div class="input-prepend">
                    <span class="add-on">DATE FROM</span>
                    <input type="text" class="input-small" value="<?=isset($_GET['from']) ? $_GET['from'] : '' ?>" name="from">
                </div>
                    
                <div class="input-prepend">
                    <span class="add-on">DATE TO</span>
                    <input type="text" class="input-small" value="<?=isset($_GET['to']) ? $_GET['to'] : '' ?>" name="to" >
                </div>

                <div class="input-prepend">
                    <span class="add-on">ITEMS/PAGE</span>
                    <select name="psize" class="input-small">
                        <option <?=isset($_GET['psize']) && $_GET['psize']=='15'  ? 'selected="selected"' : ''?>>15</option>
                        <option <?=isset($_GET['psize']) && $_GET['psize']=='30'  ? 'selected="selected"' : ''?>>30</option>
                        <option <?=isset($_GET['psize']) && $_GET['psize']=='50'  ? 'selected="selected"' : ''?>>50</option>
                        <option <?=isset($_GET['psize']) && $_GET['psize']=='100' ? 'selected="selected"' : ''?>>100</option>
                        <option <?=isset($_GET['psize']) && $_GET['psize']=='200' ? 'selected="selected"' : ''?>>200</option>
                    </select>
                </div>
                    
                <button type="submit" class="btn btn-primary" name="search" value="1">Search</button>

            </form>
        </div>
     </div>
 
</div>

<table class="table table-hover table-bordered table-heading">
    <thead>
		<tr>
               <td class="hidden-tablet hidden-phone">FBID</td>
               <td>NAME</td>
               <td class="hidden-phone hidden-tablet">GENDER</td>
               <td class="hidden-phone">BIRTHDATE</td>
               <td class="hidden-phone">EMAIL</td>
               <td>MOBILE</td>
               <td></td>
               <td class="hidden-phone">TIMESTAMP</td>
		</tr>
	</thead>
		<tr>
			<?php 
        	if( $registrants ) : $i = 0;
        		foreach( $registrants as $k => $v ) : $i++;
        	?>
        	 <tr <?=$v['joiner']==1 ? 'class="promo-joiner"' : '' ?> >
                <td class="hidden-tablet hidden-phone"><?=$v['fbid']?></td>
                <td><?=$v['name']?></td>
                <td class="hidden-phone hidden-tablet"><?=$v['gender']?></td>
                <td class="hidden-phone"><?=$v['birthdate']?></td>
                <td class="hidden-phone"><?=$v['email']?></td>
                <td><?=$v['mobile']?></td>
                <td> <button class="btn deem" title="Deem as promo joiner" data-fname="<?=$v['fname']?>" data-lname="<?=$v['lname']?>" data-email="<?=$v['email']?>" data-fbid="<?=$v['fbid']?>" data-promo="cms template" ><i class="icon-user"></i></button></td>
                <td class="hidden-phone"><?=date('M d, Y', strtotime($v['timestamp']))?></td>
            </tr>
        <?php endforeach; else: ?>
          <tr>
               <td colspan="10"><center>No Result</center></td>
          </tr>
    	<?php endif;?>
          <tr>
               <td colspan="10"><h4>Total: <?=$total?></h4></td>
          </tr>
    </tbody>

</table>

<div class="pagination pull-right"><?php echo $pagination?></div>


<script type="text/javascript">
$(function(){

     $('.advanced').click(function(){
          $('.advance-search').slideToggle();
     })

     $('.deem').click(function(){
          var el = $(this);
          var data = {
               firstname : el.data('fname'),
               lastname : el.data('lname'),
               email : el.data('email'),
               fbid : el.data('fbid'),
               promo : el.data('promo')
          }

          $.post('<?=site_url()?>/ajax/promojoiner',data);
          el.parent().parent().addClass("promo-joiner");
          el.addClass('btn-danger');
     })

     $('input[name="from"]').datepicker({
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat:'yy-mm-dd',
          onClose: function( selectedDate ) {
               $( 'input[name="to"]').datepicker( "option", "minDate", selectedDate );
          }
     });

     $('input[name="to"]').datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat:'yy-mm-dd',
          onClose: function( selectedDate ) {
               $('input[name="from"]').datepicker( "option", "maxDate", selectedDate );
          }
     });
});
</script>