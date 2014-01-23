<div class="page-controls">
	<a href="<?=site_url('accounts/add')?>" class="btn">Add User</a>
</div>

<table class="table table-hover table-bordered table-heading">
    <thead>
		<tr>
            <td>USERID</td>
            <td>ACCOUNT NAME</td>
            <td>USERNAME</td>
            <td>LEVEL</td>
            <td>TIMESTAMP</td>
			<td>ACTION</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php 
        	if( $items ) : 
        		foreach( $items as $k => $v ) :
        	?>
        	 <tr>
                <td><?=$v['user_id']?></td>
                <td><?=$v['account_name']?></td>
                <td><?=$v['uname']?></td>
                <td><?=$v['level']?></td>
                <td><?=date('M d, Y', strtotime($v['timestamp']))?></td>
                <td>
                	<a class="btn btn-small" href="<?=site_url('accounts/edit/'.$v['user_id'])?>">Edit</a>
                	<a class="btn btn-small" href="<?=site_url('accounts/delete/'.$v['user_id'])?>" onclick="return confirm('Delete <?=$v['account_name']?> account?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="10"><center>No Result</center></td>
        </tr>
    	<?php endif;?>
    </tbody>

</table>

