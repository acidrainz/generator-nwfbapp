<div class="page-controls">
    <a class="btn advanced"> <i class="icon-search"></i><span class="hidden-phone"> Advance Query</span></a>
     <a href="<?=site_url('export/entries?'.http_build_query($_GET, '', "&"))?>" class="btn hidden-phone"><i class="icon-download-alt"></i> Export</a>

     <div class=" advance-search">
        <div class="form-content">
            <form class="form-search">
                <div class="input-prepend">
                    <span class="add-on">AUTHOR</span>
                    <input type="text" class="input-medium" name="author" value="<?=isset($_GET['author']) ? $_GET['author'] : '' ?>" >
                </div>
               

                <div class="input-prepend">
                    <span class="add-on">HASHTAG</span>
                    <input type="text" class="input-medium" name="hashtag" value="<?=isset($_GET['hashtag']) ? $_GET['hashtag'] : '' ?>" >
                </div>

                <div class="input-prepend">
                    <span class="add-on">SOURCE</span>
                    <select class="input-medium" name="source">
                        <option value="">All</option>
                        <option value="upload" <?=isset($_GET['source']) && $_GET['source']=='upload'  ? 'selected="selected"' : '' ?>>Uploaded</option>
                        <option value="instagram" <?=isset($_GET['source']) && $_GET['source']=='instagram'  ? 'selected="selected"' : '' ?>>Instagram</option>
                        <option value="twitter" <?=isset($_GET['source']) && $_GET['source']=='twitter'  ? 'selected="selected"' : '' ?>>Twitter</option>
                    </select>
                </div>

                <div class="input-prepend">
                    <span class="add-on">CAPTION</span>
                    <input type="text" class="input-medium" name="caption" value="<?=isset($_GET['caption']) ? $_GET['caption'] : '' ?>" >
                </div>

                <div class="input-prepend">
                    <span class="add-on">STATUS</span>
                    <select class="input-medium" name="status">
                        <option value="">All</option>
                        <option value="1" <?=isset($_GET['status']) && $_GET['status']==1  ? 'selected="selected"' : '' ?>>Approved</option>
                        <option value="0" <?=isset($_GET['status']) && $_GET['status']==0  ? 'selected="selected"' : '' ?>>Pending</option>
                        <option value="2" <?=isset($_GET['status']) && $_GET['status']==2  ? 'selected="selected"' : '' ?>>Declined</option>
                         <option value="3" <?=isset($_GET['status']) && $_GET['status']==3  ? 'selected="selected"' : '' ?>>Winners</option>
                    </select>
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

<!-- <div class="page-header clearfix">
    <a href="<?=site_url('export/entries?'.http_build_query($_GET, '', "&"))?>" class="btn btn-inverse pull-right btn-export-data hidden-phone">Export Data</a>
</div>
 -->
    <table class="table table-hover table-bordered table-heading">
        <thead>
            <tr>
                <td>IMAGE</td>
                <td class="hidden-tablet hidden-phone">FBID</td>
                <td class="hidden-phone">USER</td>
                <td class="hidden-phone">HASHTAG</td>
                <td class="hidden-phone">SOURCE</td>
                <td>CAPTION</td>
                <td>STATUS</td>
                <td class="hidden-phone">TIMESTAMP</td>
            </tr>
        </thead>
        <tbody>
            </tr>
            <tr>
               <?php 
            if( $items ) : 
                foreach( $items as $k => $v ) :
            ?>
             <tr id="row-<?=$v['id']?>">
                <td><img src="<?=str_replace('~path~', base_url().'/uploads/', $v['url_thumbnail'])?>" width="50"/></td>
                <td class="hidden-tablet hidden-phone"><?=$v['user_id']?></td>
                <td class="hidden-phone"><?=$v['author']?></td>
                <td class="hidden-phone"><?=$v['hashtag']?></td>
                <td class="hidden-phone"><?=$v['source']?></td>
                <td><?=$v['caption']?></td>
                <td>

                    <div class="btn-group action" data-id="<?=$v['id']?>">>
                        <button class="btn <?=$v['status']==1 ? 'btn-success' : ''?>" rel="1" ><i class="icon-ok"></i></button>
                        <button class="btn <?=$v['status']==2 ? 'btn-success' : ''?>" rel="2" ><i class="icon-remove"></i></button>
                        <button class="btn <?=$v['status']==3 ? 'btn-success' : ''?>" rel="3" ><i class="icon-star"></i></button>
                    </div>
                </td>
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


    <div class="pagination  pull-right"><?php echo $pagination?></div>

<style type="text/css">img._status{cursor: pointer;}</style>

<script type="text/javascript">
$(function() {

    $('.advanced').click(function(){
          $('.advance-search').slideToggle();
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

    $('.action > .btn').click(function(){
          var el = $(this);
          var activeClass = 'btn-success';
          var action = 'status';
          var post;
          var data = {table : 'entries',
                      wherec: 'id',
                      wheref: el.parent().data('id'),
                      items : {}}

          if( el.hasClass(activeClass) ){
               el.removeClass(activeClass);
               data.items[action] = 0;
          }else{
               el.addClass(activeClass);
               el.siblings().removeClass(activeClass);
               data.items[action] = el.attr('rel');
          }
          $.post('<?=site_url()?>/ajax/update',data);
     })
    
});
</script>