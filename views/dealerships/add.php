<h1>Add Dealership</h1>
<p>This is the form to add a new Dealership record. Locations can be added to this Dealership separately, after this Dealership record is created.</p>
<form action="<?=site_url('dealerships/add/' . $fein)?>" name="dealership_form" id="dealership_form" method="post" class="smartform">

	<?=$_POST ? '<div class="cryptbox crypterror">Please correct the errors in your form submission.</div>' : ''?>

	<fieldset>
		<legend>Basic Information</legend>
		
		<ul>
			<li>
				<label for="fein">Federal Tax ID (FEIN)</label>
				<p>
					<?=$fein?>										<input type="hidden" name="fein" value="<?=$fein?>" />
					<br>
					<span class="moreinfo">Enter the Federal Tax ID (FEIN) in this format: 123456789 (no dashes). Must be 9 digits long.</span>
				</p>
			</li>
			<li>
				<label for="effective_date">Effective Date</label>
				<p>
					<input id="effective_date" class="input_text date" name="effective_date"  readonly="readonly" value="<?=isset($_POST['effective_date']) ? $_POST['effective_date'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['effective_date']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="name">Name</label>
				<p>
					<input id="name" class="input_text" name="name" value="<?=isset($_POST['name']) ? $_POST['name'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="address_street">Address</label>
				<p>
					<input id="address_street" class="input_text" name="address_street" value="<?=isset($_POST['address_street']) ? $_POST['address_street'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['address_street']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="address_city">City</label>
				<p>
					<input id="address_city" class="input_text" name="address_city" value="<?=isset($_POST['address_city']) ? $_POST['address_city'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['address_city']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="address_state">State</label>
				<p>
					<select name="address_state" class="input_select">
						<option value="AL" <?=isset($_POST['address_state']) && $_POST['address_state'] == "AL" ? 'selected="selected"' : ''?>>Alabama</option>
						<option value="AK" <?=isset($_POST['address_state']) && $_POST['address_state'] == "AK" ? 'selected="selected"' : ''?>>Alaska</option>
						<option value="AZ" <?=isset($_POST['address_state']) && $_POST['address_state'] == "AZ" ? 'selected="selected"' : ''?>>Arizona</option>
						<option value="AR" <?=isset($_POST['address_state']) && $_POST['address_state'] == "AR" ? 'selected="selected"' : ''?>>Arkansas</option>
						<option value="CA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "CA" ? 'selected="selected"' : ''?>>California</option>
						<option value="CO" <?=isset($_POST['address_state']) && $_POST['address_state'] == "CO" ? 'selected="selected"' : ''?>>Colorado</option>
						<option value="CT" <?=isset($_POST['address_state']) && $_POST['address_state'] == "CT" ? 'selected="selected"' : ''?>>Connecticut</option>
						<option value="DE" <?=isset($_POST['address_state']) && $_POST['address_state'] == "DE" ? 'selected="selected"' : ''?>>Delaware</option>
						<option value="FL" <?=isset($_POST['address_state']) && $_POST['address_state'] == "FL" ? 'selected="selected"' : ''?>>Florida</option>
						<option value="GA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "GA" ? 'selected="selected"' : ''?>>Georgia</option>
						<option value="HI" <?=isset($_POST['address_state']) && $_POST['address_state'] == "HI" ? 'selected="selected"' : ''?>>Hawaii</option>
						<option value="ID" <?=isset($_POST['address_state']) && $_POST['address_state'] == "ID" ? 'selected="selected"' : ''?>>Idaho</option>
						<option value="IL" <?=isset($_POST['address_state']) && $_POST['address_state'] == "IL" ? 'selected="selected"' : ''?>>Illinois</option>
						<option value="IN" <?=isset($_POST['address_state']) && $_POST['address_state'] == "IN" ? 'selected="selected"' : ''?>>Indiana</option>
						<option value="IA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "IA" ? 'selected="selected"' : ''?>>Iowa</option>
						<option value="KS" <?=isset($_POST['address_state']) && $_POST['address_state'] == "KS" ? 'selected="selected"' : ''?>>Kansas</option>
						<option value="KY" <?=isset($_POST['address_state']) && $_POST['address_state'] == "KY" ? 'selected="selected"' : ''?>>Kentucky</option>
						<option value="LA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "LA" ? 'selected="selected"' : ''?>>Louisiana</option>
						<option value="ME" <?=isset($_POST['address_state']) && $_POST['address_state'] == "ME" ? 'selected="selected"' : ''?>>Maine</option>
						<option value="MD" <?=isset($_POST['address_state']) && $_POST['address_state'] == "MD" ? 'selected="selected"' : ''?>>Maryland</option>
						<option value="MA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "MA" ? 'selected="selected"' : ''?>>Massachusetts</option>
						<option value="MI" <?=isset($_POST['address_state']) && $_POST['address_state'] == "MI" ? 'selected="selected"' : ''?>>Michigan</option>
						<option value="MN" <?=isset($_POST['address_state']) && $_POST['address_state'] == "MN" ? 'selected="selected"' : ''?>>Minnesota</option>
						<option value="MS" <?=isset($_POST['address_state']) && $_POST['address_state'] == "MS" ? 'selected="selected"' : ''?>>Mississippi</option>
						<option value="MO" <?=isset($_POST['address_state']) && $_POST['address_state'] == "MO" ? 'selected="selected"' : ''?>>Missouri</option>
						<option value="MT" <?=isset($_POST['address_state']) && $_POST['address_state'] == "MT" ? 'selected="selected"' : ''?>>Montana</option>
						<option value="NE" <?=isset($_POST['address_state']) && $_POST['address_state'] == "NE" ? 'selected="selected"' : ''?>>Nebraska</option>
						<option value="NV" <?=isset($_POST['address_state']) && $_POST['address_state'] == "NV" ? 'selected="selected"' : ''?>>Nevada</option>
						<option value="NH" <?=isset($_POST['address_state']) && $_POST['address_state'] == "NH" ? 'selected="selected"' : ''?>>New Hampshire</option>
						<option value="NJ" <?=isset($_POST['address_state']) && $_POST['address_state'] == "NJ" ? 'selected="selected"' : ''?>>New Jersey</option>
						<option value="NM" <?=isset($_POST['address_state']) && $_POST['address_state'] == "NM" ? 'selected="selected"' : ''?>>New Mexico</option>
						<option value="NY" <?=isset($_POST['address_state']) && $_POST['address_state'] == "NY" ? 'selected="selected"' : ''?>>New York</option>
						<option value="NC" <?=isset($_POST['address_state']) && $_POST['address_state'] == "NC" ? 'selected="selected"' : ''?>>North Carolina</option>
						<option value="ND" <?=isset($_POST['address_state']) && $_POST['address_state'] == "ND" ? 'selected="selected"' : ''?>>North Dakota</option>
						<option value="OH" <?=isset($_POST['address_state']) && $_POST['address_state'] == "OH" ? 'selected="selected"' : ''?>>Ohio</option>
						<option value="OK" <?=isset($_POST['address_state']) && $_POST['address_state'] == "OK" ? 'selected="selected"' : ''?>>Oklahoma</option>
						<option value="OR" <?=isset($_POST['address_state']) && $_POST['address_state'] == "OR" ? 'selected="selected"' : ''?>>Oregon</option>
						<option value="PA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "PA" ? 'selected="selected"' : ''?>>Pennsylvania</option>
						<option value="RI" <?=isset($_POST['address_state']) && $_POST['address_state'] == "RI" ? 'selected="selected"' : ''?>>Rhode Island</option>
						<option value="SC" <?=isset($_POST['address_state']) && $_POST['address_state'] == "SC" ? 'selected="selected"' : ''?>>South Carolina</option>
						<option value="SD" <?=isset($_POST['address_state']) && $_POST['address_state'] == "SD" ? 'selected="selected"' : ''?>>South Dakota</option>
						<option value="TN" <?=isset($_POST['address_state']) && $_POST['address_state'] == "TN" ? 'selected="selected"' : ''?>>Tennessee</option>
						<option value="TX" <?=isset($_POST['address_state']) && $_POST['address_state'] == "TX" ? 'selected="selected"' : ''?>>Texas</option>
						<option value="UT" <?=isset($_POST['address_state']) && $_POST['address_state'] == "UT" ? 'selected="selected"' : ''?>>Utah</option>
						<option value="VT" <?=isset($_POST['address_state']) && $_POST['address_state'] == "VT" ? 'selected="selected"' : ''?>>Vermont</option>
						<option value="VA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "VA" ? 'selected="selected"' : ''?>>Virginia</option>
						<option value="WA" <?=isset($_POST['address_state']) && $_POST['address_state'] == "WA" ? 'selected="selected"' : ''?>>Washington</option>
						<option value="WV" <?=isset($_POST['address_state']) && $_POST['address_state'] == "WV" ? 'selected="selected"' : ''?>>West Virginia</option>
						<option value="WI" <?=isset($_POST['address_state']) && $_POST['address_state'] == "WI" ? 'selected="selected"' : ''?>>Wisconsin</option>
						<option value="WY" <?=isset($_POST['address_state']) && $_POST['address_state'] == "WY" ? 'selected="selected"' : ''?>>Wyoming</option>
					</select>
				</p>
			</li>
			<li>
				<label for="address_zip">Zip</label>
				<p>
					<input id="address_zip" class="input_text" name="address_zip" value="<?=isset($_POST['address_zip']) ? $_POST['address_zip'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['address_zip']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
		</ul>
	</fieldset>
	
	<fieldset>
		<legend>Contact Information</legend>
		<ul>
			<li>
				<label for="contact_name">Name</label>
				<p>
					<input id="contact_name" class="input_text" name="contact_name" value="<?=isset($_POST['contact_name']) ? $_POST['contact_name'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['contact_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="contact_phone">Phone</label>
				<p>
					<input id="contact_phone" class="input_text" name="contact_phone" value="<?=isset($_POST['contact_phone']) ? $_POST['contact_phone'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['contact_phone']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="contact_email">Email</label>
				<p>
					<input id="contact_email" class="input_text" name="contact_email" value="<?=isset($_POST['contact_email']) ? $_POST['contact_email'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['contact_email']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
		</ul>
	</fieldset>
	
	<fieldset>
		<legend>Contact for Claims Information</legend>
		<ul>
			<li>
				<label for="claim_phone">Phone</label>
				<p>
					<input id="claim_phone" class="input_text" name="claim_phone" value="<?=isset($_POST['claim_phone']) ? $_POST['claim_phone'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['claim_phone']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="claim_email">Email</label>
				<p>
					<input id="claim_email" class="input_text" name="claim_email" value="<?=isset($_POST['claim_email']) ? $_POST['claim_email'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['claim_email']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
		</ul>
	</fieldset>
	
	<fieldset>
		<legend>Lienholder Information</legend>
		<ul>
			<li>
				<label for="lienholder_name">Name</label>
				<p>
					<input id="lienholder_name" class="input_text" name="lienholder_name" value="<?=isset($_POST['lienholder_name']) ? $_POST['lienholder_name'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['lienholder_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="lienholder_address_street">Address</label>
				<p>
					<input id="lienholder_address_street" class="input_text" name="lienholder_address_street" value="<?=isset($_POST['lienholder_address_street']) ? $_POST['lienholder_address_street'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['lienholder_address_street']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="lienholder_address_city">City</label>
				<p>
					<input id="lienholder_address_city" class="input_text" name="lienholder_address_city" value="<?=isset($_POST['lienholder_address_city']) ? $_POST['lienholder_address_city'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['lienholder_address_city']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="lienholder_address_state">State</label>
				<p>
					<select name="lienholder_address_state" class="input_select">
						<option value="AL" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "AL" ? 'selected="selected"' : ''?>>Alabama</option>
						<option value="AK" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "AK" ? 'selected="selected"' : ''?>>Alaska</option>
						<option value="AZ" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "AZ" ? 'selected="selected"' : ''?>>Arizona</option>
						<option value="AR" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "AR" ? 'selected="selected"' : ''?>>Arkansas</option>
						<option value="CA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "CA" ? 'selected="selected"' : ''?>>California</option>
						<option value="CO" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "CO" ? 'selected="selected"' : ''?>>Colorado</option>
						<option value="CT" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "CT" ? 'selected="selected"' : ''?>>Connecticut</option>
						<option value="DE" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "DE" ? 'selected="selected"' : ''?>>Delaware</option>
						<option value="FL" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "FL" ? 'selected="selected"' : ''?>>Florida</option>
						<option value="GA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "GA" ? 'selected="selected"' : ''?>>Georgia</option>
						<option value="HI" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "HI" ? 'selected="selected"' : ''?>>Hawaii</option>
						<option value="ID" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "ID" ? 'selected="selected"' : ''?>>Idaho</option>
						<option value="IL" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "IL" ? 'selected="selected"' : ''?>>Illinois</option>
						<option value="IN" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "IN" ? 'selected="selected"' : ''?>>Indiana</option>
						<option value="IA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "IA" ? 'selected="selected"' : ''?>>Iowa</option>
						<option value="KS" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "KS" ? 'selected="selected"' : ''?>>Kansas</option>
						<option value="KY" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "KY" ? 'selected="selected"' : ''?>>Kentucky</option>
						<option value="LA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "LA" ? 'selected="selected"' : ''?>>Louisiana</option>
						<option value="ME" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "ME" ? 'selected="selected"' : ''?>>Maine</option>
						<option value="MD" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "MD" ? 'selected="selected"' : ''?>>Maryland</option>
						<option value="MA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "MA" ? 'selected="selected"' : ''?>>Massachusetts</option>
						<option value="MI" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "MI" ? 'selected="selected"' : ''?>>Michigan</option>
						<option value="MN" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "MN" ? 'selected="selected"' : ''?>>Minnesota</option>
						<option value="MS" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "MS" ? 'selected="selected"' : ''?>>Mississippi</option>
						<option value="MO" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "MO" ? 'selected="selected"' : ''?>>Missouri</option>
						<option value="MT" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "MT" ? 'selected="selected"' : ''?>>Montana</option>
						<option value="NE" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "NE" ? 'selected="selected"' : ''?>>Nebraska</option>
						<option value="NV" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "NV" ? 'selected="selected"' : ''?>>Nevada</option>
						<option value="NH" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "NH" ? 'selected="selected"' : ''?>>New Hampshire</option>
						<option value="NJ" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "NJ" ? 'selected="selected"' : ''?>>New Jersey</option>
						<option value="NM" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "NM" ? 'selected="selected"' : ''?>>New Mexico</option>
						<option value="NY" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "NY" ? 'selected="selected"' : ''?>>New York</option>
						<option value="NC" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "NC" ? 'selected="selected"' : ''?>>North Carolina</option>
						<option value="ND" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "ND" ? 'selected="selected"' : ''?>>North Dakota</option>
						<option value="OH" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "OH" ? 'selected="selected"' : ''?>>Ohio</option>
						<option value="OK" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "OK" ? 'selected="selected"' : ''?>>Oklahoma</option>
						<option value="OR" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "OR" ? 'selected="selected"' : ''?>>Oregon</option>
						<option value="PA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "PA" ? 'selected="selected"' : ''?>>Pennsylvania</option>
						<option value="RI" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "RI" ? 'selected="selected"' : ''?>>Rhode Island</option>
						<option value="SC" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "SC" ? 'selected="selected"' : ''?>>South Carolina</option>
						<option value="SD" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "SD" ? 'selected="selected"' : ''?>>South Dakota</option>
						<option value="TN" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "TN" ? 'selected="selected"' : ''?>>Tennessee</option>
						<option value="TX" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "TX" ? 'selected="selected"' : ''?>>Texas</option>
						<option value="UT" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "UT" ? 'selected="selected"' : ''?>>Utah</option>
						<option value="VT" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "VT" ? 'selected="selected"' : ''?>>Vermont</option>
						<option value="VA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "VA" ? 'selected="selected"' : ''?>>Virginia</option>
						<option value="WA" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "WA" ? 'selected="selected"' : ''?>>Washington</option>
						<option value="WV" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "WV" ? 'selected="selected"' : ''?>>West Virginia</option>
						<option value="WI" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "WI" ? 'selected="selected"' : ''?>>Wisconsin</option>
						<option value="WY" <?=isset($_POST['lienholder_address_state']) && $_POST['lienholder_address_state'] == "WY" ? 'selected="selected"' : ''?>>Wyoming</option>
					</select>
				</p>
			</li>
			<li>
				<label for="lienholder_address_zip">Zip</label>
				<p>
					<input id="lienholder_address_zip" class="input_text" name="lienholder_address_zip" value="<?=isset($_POST['lienholder_address_zip']) ? $_POST['lienholder_address_zip'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['lienholder_address_zip']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
		</ul>
	</fieldset>
	
	<fieldset>
		<legend>Questionnaire</legend>
		
		<table class="questionnaire_tbl" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td class="maincol">Question</td>
					<td class="actioncol">YES</td>
					<td class="actioncol">NO</td>
				</tr>
			</thead>
            <?php
            	foreach($questionaire as $key => $ques) {
					//echo "<pre>".print_r($ques, 1)."</pre>";
					$checked1 = false;
					$checked0 = false;
					$q_no = "q".$key;
					$msg = "";
					$checked_sub = '';
					if($ques['msg']) {
						$msg = $ques['msg'];
					}
					isset($_POST[$q_no]) && $_POST[$q_no] == 1 ? $checked1 = "checked" : '';
					isset($_POST[$q_no]) && $_POST[$q_no] == 0 ? $checked0 = "checked" : '';
					
					$validation_msg_YN = $_POST && !isset($_POST[$q_no]) ? '<span class="error">You must have to chose one option. </span>' : '';
					$validation_msg_TA = $_POST && empty($_POST[$q_no."_text"]) ? '<span class="error">This can not be left blank. </span>' : '';
					$validation_msg_option = $_POST && (isset($_POST[$q_no]) && $_POST[$q_no] == 1) && !isset($_POST[$q_no."__option"]) ? '<span class="error">You must have to chose one option. </span>' : '';
					$onclick_func = '';
					
					echo "<tr>";
					
					if($ques['boolean'] && !$ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
					
						/////////////// OPTIONS - YES AND NO ////////////////////
						$yes = "<td align='right' style='text-align:center;'><input type='radio' name='$q_no' id='".$q_no."_Y' value='1' $checked1 /></td>";
						$no = "<td align='right' style='text-align:center;'><input type='radio' name='$q_no' id='".$q_no."_N' value='0' $checked0 /></td>";
						
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label></td>";
						echo $yes." ".$no;
					
					} else if($ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
						
						$class = isset($_POST[$q_no]) && $_POST[$q_no] == "1" ? '' : 'hide';
					
						/////////////// OPTIONS - YES AND NO ////////////////////
						$yes = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_Y" value="1" onclick="expandQues(\''.$q_no.'_additional\', \'show\')" '.$checked1.' /></td>';
						$no = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_N" value="0" onclick="expandQues(\''.$q_no.'_additional\', \'hide\')" '.$checked0.' /></td>';
						////////////////TEXTAREA VALUE///////////////////////
						$textarea_value = isset($_POST[$q_no.'_text']) ? $_POST[$q_no.'_text'] : '';
						
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label><br><div id='".$q_no."_additional' class='".$class."'><textarea class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea><br><label for='".$q_no."_text' class='error'></a></td>";
						echo $yes." ".$no;
					
					} else if($ques['boolean'] && $ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
						
						$class = isset($_POST[$q_no]) && $_POST[$q_no] == "1" ? '' : 'hide';
					
						/////////////// OPTIONS - YES AND NO ////////////////////
						$yes = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_Y" value="1" onclick="expandQues(\''.$q_no.'_additional\', \'show\')" '.$checked1.' /></td>';
						$no = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_N" value="0" onclick="expandQues(\''.$q_no.'_additional\', \'hide\')" '.$checked0.' /></td>';
						
						$options = "";
						$checked_sub = false;
						
						$textarea_value = isset($_POST[$q_no.'_text']) ? $_POST[$q_no.'_text'] : '';
						foreach ($ques['radios'] as $oKey=>$opt) {
							isset($_POST[$q_no."_option"]) && $_POST[$q_no."_option"] == $oKey ? $checked_sub = "checked" : '';
							$options .= "<input type='radio' name='".$q_no."__option' value='".$oKey."' $checked_sub /> ".$opt;
						}
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label><br><div id='".$q_no."_additional' class='".$class."'>".$options."<br><textarea class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea></div></td>";
						echo $yes." ".$no;
					
					} else if($ques['boolean'] && !$ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
						
						$class = isset($_POST[$q_no]) && $_POST[$q_no] == "1" ? '' : 'hide';
					
						/////////////// OPTIONS - YES AND NO ////////////////////
						$yes = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_Y" value="1" onclick="expandQues(\''.$q_no.'_additional\', \'show\')" '.$checked1.' /></td>';
						$no = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_N" value="0" onclick="expandQues(\''.$q_no.'_additional\', \'hide\')" '.$checked0.' /></td>';
						
						$options = "";
						foreach ($ques['radios'] as $oKey=>$opt) {
							isset($_POST[$q_no."_option"]) && $_POST[$q_no."_option"] == $oKey ? $checked_sub = "checked" : $checked_sub = "";
							$options .= "<input type='radio' name='".$q_no."_option' value='".$oKey."' $checked_sub /> ".$opt;
						}
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label><br>
						<div id='".$q_no."_additional' class='".$class."'>".$options." <br><label for='".$q_no."_option' class='error'></div></td>";
						echo $yes." ".$no;
					
					}  else if(!$ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
					
						$textarea_value = isset($_POST[$q_no.'_text']) ? $_POST[$q_no.'_text'] : '';
						echo "<td colspan='3'>$key) ".$ques['ques']." $msg<br><textarea class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea>
						<br><label for='".$q_no."_text' class='error'></label></td>";
					}
							  
					echo "</tr>";
				}
			?>
            <tr>
            	<td>42) DOES DEALER USES MULTI STORY PARKING STRUCTURE AT ANY LOCATION <label for='q42' class='error' style='float:right;'></label>
                	<?php $class42 = isset($_POST['q42']) && $_POST['q42'] == 1 ? '' : 'hide'; ?>
                	<div id="q42_additional_a" class="<?php print $class42;?>">
                        <br />a.	WHEN WAS STRUCTURE BUILT? <input type="text" class="input_text" name="q42_a" id="q42_a" value="<?=isset($_POST['q42_a']) ? $_POST['q42_a'] : ''?>" />
                        <label for='q42_a' class='error'></label>
                    <br />b.	IF BUILT BEFORE 2000, HAS IT BEEN RETROFITTED TO MEET STATE EARTHQUAKE CODES? 
                    <input type="radio" name="q42_b" <?=isset($_POST['q42_b']) && $_POST['q42_b'] == 1 ? 'checked="checked"' : ''?> value="1" /> Yes 
                    <input type="radio" name="q42_b" <?=isset($_POST['q42_b']) && $_POST['q42_b'] == 0 ? 'checked="checked"' : ''?> value="0" /> No<br />
                    </div>
                </td>
                 <td align="right" style="text-align:center;"><input type="radio" name="q42" id="q42_Y" onclick="expandQues('q42_additional_a', 'show'), expandQues('q43_options', 'show')" value="1" <?=isset($_POST['q42']) && $_POST['q42'] == 1 ? 'checked="checked"' : ''?> /></td>
				<td align="right" style="text-align:center;"><input type="radio" name="q42"  id="q42_N" onclick="expandQues('q42_additional_a', 'hide'), expandQues('q43_options', 'hide')" value="0" <?=isset($_POST['q42']) && $_POST['q42'] == 0 ? 'checked="checked"' : ''?> /></td>
			</tr>
            <?php $class43options = isset($_POST['q42']) && $_POST['q42'] == 1 ? '' : 'hide'; ?>
            <tr id="q43_options" class="<?php print $class43options;?>">
            	<td colspan="3">43) SELECT STRUCTURE'S CONTRUCTION <label for='q43_option' class='error' style='float:right;'></label>
               	 	<?php $class43 = isset($_POST['q43_option']) && $_POST['q43_option'] == 'c' ? '' : 'hide'; ?>
                	<br />a. PRECAST CONCRETE SURFACE WITH POURED CONCRETE PILLARS <input type="radio" name="q43_option" onclick="expandQues('q43_additional_c', 'hide')" id="q43_A" <?=isset($_POST['q43_option']) && $_POST['q43_option'] == 'a' ? 'checked="checked"' : ''?> value="a" />
                    <br />b. POURED CONCRETE 100% <input type="radio" name="q43_option" onclick="expandQues('q43_additional_c', 'hide')" id="q43_B" <?=isset($_POST['q43_option']) && $_POST['q43_option'] == 'b' ? 'checked="checked"' : ''?> value="b" />
                    <br />c. OTHER <input type="radio" name="q43_option" onclick="expandQues('q43_additional_c', 'show')" value="c" id="q43_C" <?=isset($_POST['q43_option']) && $_POST['q43_option'] == 'c' ? 'checked="checked"' : ''?> />
                    <br /> 
                    <div id="q43_additional_c" class="<?php print $class43;?>">
                    (if Other, Describe)
                        <textarea class="textbox-area" name="q43_c_text"><?=isset($_POST['q43_c_text']) ? $_POST['q43_c_text'] : ''?></textarea> 
                        <label for='q43_c_text' class='error'></label>
                    </div>
                </td>
            </tr>
            <tr>
            	<td colspan="3">44) PROVIDE EARTHQUAKE LIMITS AND DEDUCTIBLES ON EXPIRING POLICY 
                				<br />a.	LIMITS
                                <textarea class="textbox-area" name="q44_a_text"><?=isset($_POST['q44_a_text']) ? $_POST['q44_a_text'] : ''?></textarea>
                                <label for='q44_a_text' class='error'></label>
								<br />b.	DEDUCTIBLE
                                <textarea class="textbox-area" name="q44_b_text"><?=isset($_POST['q44_b_text']) ? $_POST['q44_b_text'] : ''?></textarea>
                                <label for='q44_b_text' class='error'></label>
                </td>
            </tr>
            <tr>
            	<td colspan="3">45) Number of people who are allowed to drive company owned vehicle for personal use. <label for='q45' class='error' style='float:right;'></label><br />
                	<table><tr>
                    <th>Owner</th>
                    <th>Family</th>
                    <th>Employees</th>
                    <th>Other</th>
                    </tr>
                    <tr>
                    <td><input type="text" class="input_text" name="q45_a" value="<?=isset($_POST['q45_a']) ? $_POST['q45_a'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_b" value="<?=isset($_POST['q45_b']) ? $_POST['q45_b'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_c" value="<?=isset($_POST['q45_c']) ? $_POST['q45_c'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_d" value="<?=isset($_POST['q45_d']) ? $_POST['q45_d'] : ''?>" /></td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr>
			</tr>
		</table>
		
	</fieldset>
	
	<fieldset>
		<legend>Other Information</legend>
		
		<ul>
			<li>
				<label for="franchises">Franchises for this dealer/group</label>
				<p>
					<input id="franchises" class="input_text" name="franchises" value="<?=isset($_POST['franchises']) ? $_POST['franchises'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['franchises']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
					<br>
					<span class="moreinfo">List any franchises at this location (e.g. Ford, Nissan, etc).</span>
				</p>
			</li>
            <li>
				<label for="invetory_type">What type of inventory?</label>
				<p>
					<select id="inventory_type" name="inventory_type">
                    	<option value="Auto" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Auto" ? "selected='selected'" : ''?>>Auto</option>
                        <option value="Motorcycle" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Motorcycle" ? "selected='selected'" : ''?>>Motorcycle</option>
                        <option value="RV" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "RV" ? "selected='selected'" : ''?>>RV</option>
                        <option value="Simi trucks" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Simi trucks" ? "selected='selected'" : ''?>>Simi trucks</option>
                        <option value="Other" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Other" ? "selected='selected'" : ''?>>Other</option>
                    </select>
                    
				</p>
                <p id="type_other"><input id="inventory_type_other" class="input_text" name="inventory_type_other" value="<?=isset($_POST['inventory_type_other']) ? $_POST['inventory_type_other'] : ''?>" size="45">
                    <?=$_POST && $_POST['inventory_type'] == "Other" && strlen($_POST['inventory_type_other']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?></p>
			</li>
			<li>				<label for="over250k">Excess of $250,000?</label>				<p>					<select id="over250k" class="input_select" name="over250k">						<option value="0" <?=isset($_POST['over250k']) && $_POST['over250k'] == "0" ? 'selected="selected"' : ''?>>No</option>						<option value="1" <?=isset($_POST['over250k']) && $_POST['over250k'] == "1" ? 'selected="selected"' : ''?>>Yes</option>					</select>					<br>					<span class="moreinfo">Select "yes" if this dealership carries any vehicles in excess of $250,000.</span>				</p>			</li>						<li>				<label for="is_allianz_renewal"><span style="font-size: 10px;">Is this a ABC/XYZ renewal?</span></label>				<p>					<select id="is_allianz_renewal" class="input_select" name="is_allianz_renewal">						<option value="0" <?=isset($_POST['is_allianz_renewal']) && $_POST['is_allianz_renewal'] == "0" ? 'selected="selected"' : ''?>>No</option>						<option value="1" <?=isset($_POST['is_allianz_renewal']) && $_POST['is_allianz_renewal'] == "1" ? 'selected="selected"' : ''?>>Yes</option>					</select>					<br>					<span class="moreinfo">Select "yes" if this is a renewal for ABC/XYZ.</span>				</p>			</li>
			<li>
				<label for="parking_garage_num_units"><span style="font-size: 10px;">Parking Garage Number of Units</span></label>
				<p>
					<input id="parking_garage_num_units" class="input_text" name="parking_garage_num_units" value="<?=isset($_POST['parking_garage_num_units']) ? $_POST['parking_garage_num_units'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['parking_garage_num_units']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="parking_garage_max_inventory"><span style="font-size: 10px;">Parking Garage Max. Inventory Vals</span></label>
				<p>
					<input id="parking_garage_max_inventory" class="input_text" name="parking_garage_max_inventory" value="<?=isset($_POST['parking_garage_max_inventory']) ? $_POST['parking_garage_max_inventory'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['parking_garage_max_inventory']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="comprehensive_deductibles"><span style="font-size: 10px;">Comprehensive and Collision Deductibles</span></label>
				<p>
					<select id="comprehensive_deductibles" class="input_select" name="comprehensive_deductibles">
						<option value="0" <?=isset($_POST['comprehensive_deductibles']) && $_POST['comprehensive_deductibles'] == "0" ? 'selected="selected"' : ''?>>Comp $1,000 / $5,000 - Coll $1,000</option>
						<option value="1" <?=isset($_POST['comprehensive_deductibles']) && $_POST['comprehensive_deductibles'] == "1" ? 'selected="selected"' : ''?>>Comp $2,500 / $10,000 - Coll $2,500</option>
						<option value="2" <?=isset($_POST['comprehensive_deductibles']) && $_POST['comprehensive_deductibles'] == "2" ? 'selected="selected"' : ''?>>Comp $5,000 / $25,000 - Coll $5,000</option>
						<option value="3" <?=isset($_POST['comprehensive_deductibles']) && $_POST['comprehensive_deductibles'] == "3" ? 'selected="selected"' : ''?>>Comp $10,000 / $50,000 - Col $10,000</option>
					</select>
				</p>
			</li>
			<li>
				<label for="current_insurance_carrier">Current Insurance Carrier</label>
				<p>
					<input id="current_insurance_carrier" class="input_text" name="current_insurance_carrier" value="<?=isset($_POST['current_insurance_carrier']) ? $_POST['current_insurance_carrier'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['current_insurance_carrier']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="expiring_deductibles">Expiring Deductibles</label>
				<p>
					<input id="expiring_deductibles" class="input_text" name="expiring_deductibles" value="<?=isset($_POST['expiring_deductibles']) ? $_POST['expiring_deductibles'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['expiring_deductibles']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="expiring_weather_deductibles">Expiring Weather Deductibles</label>
				<p>
					<input id="expiring_weather_deductibles" class="input_text" name="expiring_weather_deductibles" value="<?=isset($_POST['expiring_weather_deductibles']) ? $_POST['expiring_weather_deductibles'] : ''?>" size="45">
					<?=$_POST && strlen($_POST['expiring_weather_deductibles']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</p>
			</li>
			<li>
				<label for="target_premium">Target Premium</label>
				<p>
					<input id="target_premium" class="input_text" name="target_premium" value="<?=isset($_POST['target_premium']) ? $_POST['target_premium'] : ''?>" size="45">
					<?=$_POST && ! is_numeric($_POST['target_premium']) ? '<span class="error">This must be a number.</span>' : ''?>
					<br>										<span class="moreinfo">This field must enter a number containing digits only. For example, "500000" instead of $500,000.</span>
				</p>
			</li>
			<li style="padding-right:40px;">
				<fieldset>
					<legend>Additional Notes to Underwriter (Optional)</legend>
					<span class="moreinfo">If you have anything else you would like the underwriter to know, include it here.</span>
					<textarea class="textbox-area" name="notes"><?=isset($_POST['notes']) ? $_POST['notes'] : ''?></textarea>
				</fieldset>
			</li>						<!--<li style="padding-right:40px;">				<fieldset>					<legend>Attach Additional Files (Optional)</legend>					<span class="moreinfo">If you have any other files you want to see, upload them here.</span>				</fieldset>			</li>-->
		</ul>
	</fieldset>
		
	<div class="smartformbuttoncontainer">
		<input type="submit" name="submit" value="Save Record" class="submitbutton" />
	</div>
	
</form>
<script type="text/javascript">
function expandQues(div_id, action) {
	if(action == "show") {
		$("#"+div_id).show('fast');
	} else {
		$("#"+div_id).find('input').each(function () {
			if(this.type ==  "radio") {
				$(this).attr('checked',false);
			}
			if(this.type ==  "text") {
				$(this).val('');
			}
		});
		$("#"+div_id).find('textarea').each(function() {
            $(this).val('');
        });
		
		$("#"+div_id).hide('fast');
	}
	
}
/*$.validator.setDefaults({
	submitHandler: function() { alert("submitted!"); }
});*/
jQuery.validator.addMethod("num", function (num) {
	if (isNaN(num)) return false;
	return true;
}, "Please enter a valid number");

$.validator.addMethod(
     "DateFormat",
     function(value, element) {
     return value.match(/(\d{4})-(\d{2})-(\d{2})/);
     },
      "Please enter a date in the format yyyy-mm-dd"//;
);

jQuery.validator.addMethod("australianDate", function(value, element) { 
    return value.match(/(\d{4})-(\d{2})-(\d{2})/);
	//return Date.parseExact(value, "d/M/yyyy");
}, "Please enter a valid date in the format dd/mm/yyyy.");

jQuery.validator.addMethod("fill_other", function (val) {
	var itype = $("#inventory_type").val();
	var ovalue = $("#inventory_type_other").val();
	if (itype == "Other" && val == null) { 
		alert("Other value cannot be empty!");
		return false;
	}
	return true;
}, "You have to enter other type");

jQuery.validator.addMethod("compare_with", function (value, element) {
	var yr = $("#q43_a").val();
	//alert( yr );
	if( parseInt(yr) < 2000) {
		return false;
	}
	return true;
}, "Please select yes or no for this field!");

$().ready(function() {
	
	$('label.error').hide();
	$('div.hide').hide();
	$('tr.hide').hide();
	// validate dealership form on submit
	$("#dealership_form").validate({
		rules: {
			effective_date: {
			  required: true,
			  dateENG: true
			},
			q1: "required",
			q2_text: {
				required: true,
				minlength: 2
			},
			q3: "required",
			q4: "required",
			q5: "required",
			q5_text: {
				required: "#q5_Y:checked",
				minlength: 2
			},
			q6: "required",
			q7: "required",
			q8: "required",
			q9: "required",
			q10: "required",
			q10_text: {
				required: "#q10_Y:checked",
				minlength: 2
			},
			q11: "required",
			q11_option: {
				required: "#q11_Y:checked"
			},
			q12: "required",
			q12_option: {
				required: "#q12_Y:checked"
			},
			q13: "required",
			q14: "required",
			q15: "required",
			q16: "required",
			q17: "required",
			q18: "required",
			q18_text: {
				required: "#q18_Y:checked",
				minlength: 2
			},
			q19: "required",
			q19_text: {
				required: "#q19_Y:checked",
				minlength: 2
			},
			q20: "required",
			q20_option: {
				required: "#q20_Y:checked"
			},
			q21: "required",
			q22: "required",
			q23: "required",
			q24: "required",
			q25_text: "required",
			q26: "required",
			q27: "required",
			q28: "required",
			q29: "required",
			q29_text: {
				required: "#q29_Y:checked",
				minlength: 2
			},
			q30: "required",
			q31: "required",
			q31_text: {
				required: "#q31_Y:checked",
				minlength: 2
			},
			q32_text: "required",
			q33_text: "required",
			q34: "required",
			q35: "required",
			q35_text: {
				required: "#q35_Y:checked",
				minlength: 2
			},
			q36: "required",
			q37: "required",
			q38_text: "required",
			q39: "required",
			q39_text: {
				required: "#q39_Y:checked",
				minlength: 2
			},
			q40_text: "required",
			q41: "required",
			q42: "required",
			q42_a: {
				required: "#q42_Y:checked"
			},
			/*q42_b: {
				compare_with : "#q42_a"
			},*/
			q43_option: {
				required: "#q42_Y:checked"
			},
			q43_c_text: {
				required: "#q43_C:checked"
			},
			q44_a_text: "required",
			q44_b_text: "required",
			q45_a: { 
				required : true,
				num : true 
			},
			q45_b: { 
				required : true,
				num : true 
			},
			q45_c: { 
				required : true,
				num : true 
			},
			q45_d: { 
				required : true,
				num : true 
			},
			inventory_type: "required"//,
			/*inventory_type_other: {
				fill_other: true
			},*/
			
		},
		messages: {}
	});
	$("#type_other").hide();
	if($("#inventory_type").val() == "Other") {
		$("#type_other").show();
	}
	
	$("#inventory_type").change(function() {
		if($(this).val() == "Other") {
			$("#type_other").show();
		} else {
			$("#type_other").hide();
		}
		
	});
	
	$(".date").attr("placeholder", "mm/dd/yyyy").datepicker({ dateFormat : 'mm/dd/yy' });
	/*$.validator.setDefaults({
		submitHandler: function() { alert("submitted!"); }
	});*/
});
</script>