<?=$this->session->flashdata('cryptbox_message')?>

<h1>Check Dealership Availability by Tax ID Number (FEIN)</h1>

<p>Only Global Administrators can see this page.</p>

<?php if($_POST): ?>

<div style="padding:10px; border: 1px #000000 solid; background-color: #f4f4f4;">

	<?php if($found): ?>
	
		<p>The FEIN that you provided (<?=$_POST['theFein']?>) corresponds to the following dealership: <a href="<?=site_url('dealerships/view/' . $dealership->id)?>"><?=$dealership->name?></a>.
	
	<?php else: ?>
	
		<div class="cryptbox crypterror">No dealership could be found based on the FEIN provided: <?=$_POST['theFein']?>.</div>
	
	<?php endif; ?>

</div>

<?php endif; ?>


<form method="post" action="<?=site_url('dealerships/lookupfein')?>" style="padding:10px;">

9 digit FEIN: <input name="theFein" /> (type it in like this: <em>123456789</em>. No dashes or special characters.)

<input type="submit" name="submit" value="Lookup by FEIN" />

</form>
