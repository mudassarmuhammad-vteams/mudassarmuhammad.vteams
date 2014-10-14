<h1>Add Dealership</h1>
<p>First, please enter the Tax ID Number of the dealership you are adding.</p>
<form action="<?=site_url('dealerships/addfirststep')?>" method="post" class="smartform">

	<?=$_POST ? '<div class="cryptbox crypterror">Please correct the errors in your form submission.</div>' : ''?>	<?=isset($already_exists) && $already_exists ? '<div class="cryptbox crypterror">This Tax ID Number already exists.</div>' : ''?>	<?=isset($not_valid) && $not_valid ? '<div class="cryptbox crypterror">This Tax ID Number is not valid.</div>' : ''?>

	<fieldset>
		<legend>Enter Dealership Tax ID Number</legend>
		<ul>
			<li>
				<label for="fein">Federal Tax ID (FEIN)</label>
				<p>
					<input id="fein" class="input_text" name="fein" value="<?=isset($_POST['fein']) ? $_POST['fein'] : ''?>" size="45">
					<?=$_POST && ! preg_match('/^[0-9]{9}$/', $_POST['fein']) ? '<span class="error">This must be 9 digits long.</span>' : ''?>
					<br>
					<span class="moreinfo">Enter the Federal Tax ID (FEIN) in this format: 123456789 (no dashes). Must be 9 digits long.</span>
				</p>
			</li>
		</ul>
	</fieldset>
		
	<div class="smartformbuttoncontainer">
		<input type="submit" name="submit" value="Next Page" class="submitbutton" />
	</div>
	
</form>