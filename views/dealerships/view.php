<?=$this->session->flashdata('cryptbox_message')?>

<h1><?=$dealership->name?></h1>

<ul>
	<li>You are viewing the dealership called "<?=$dealership->name?>".</li>
	<li>This dealership has been added by <a href="<?=site_url('agents/view/' . $dealership->user_id)?>"><?=$dealership->user->first_name . ' ' . $dealership->user->last_name?></a>. <?=$dealership->user_id == $this->LOGGED_IN_USER->id ? '(This is you)' : ''?></li>
	<li>Use the tabs below to maintain all aspects of this dealership.</li>
</ul>

<div class="usertabscontainer">
	<div class="usertabs">
	
		<?php //Determine what tabs to show based on user permissions: ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_view == 'all' || ($this->LOGGED_IN_USER->perm_dealership_view == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_view == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='index' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id)?>">overview</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_location_view == 'all' || ($this->LOGGED_IN_USER->perm_location_view == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_location_view == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='locations' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=locations')?>">locations (<?=count($locations)?>)</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_edit == 'all' || ($this->LOGGED_IN_USER->perm_dealership_edit == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_edit == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='edit' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=edit')?>">edit</a>
		<?php endif; ?>
        
        <?php if($this->LOGGED_IN_USER->perm_dealership_agentchange == 'all' || ($this->LOGGED_IN_USER->perm_dealership_agentchange == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_agentchange == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='change_agent' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=change_agent')?>">change agent</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_downloadxls == 'all' || ($this->LOGGED_IN_USER->perm_dealership_downloadxls == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_downloadxls == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='download' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=download')?>">download .xls</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'all' || ($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='files' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=files')?>">attach files</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_emailforreview == 'all' || ($this->LOGGED_IN_USER->perm_dealership_emailforreview == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_emailforreview == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='email' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=email')?>">email for review</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_print == 'all' || ($this->LOGGED_IN_USER->perm_dealership_print == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_print == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='printable' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/printable/' . $dealership->id)?>" target="_blank">print</a>
		<?php endif; ?>
        
        <?php if($this->LOGGED_IN_USER->perm_dealership_checklist == 'all' || ($this->LOGGED_IN_USER->perm_dealership_checklist == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_checklist == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='checklist' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=checklist')?>">checklist</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_delete == 'all' || ($this->LOGGED_IN_USER->perm_dealership_delete == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_delete == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='delete' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=delete')?>">delete</a>
		<?php endif; ?>
        
        <?php  if($this->LOGGED_IN_USER->perm_dealer_notes_view == 'all' || ($this->LOGGED_IN_USER->perm_dealer_notes_view == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealer_notes_view == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='notes' ? 'class="youarehere" ' : ''?>href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=notes')?>">notes</a>
		<?php endif; ?>
	</div>
</div>


<?php
	switch($tab):
	case 'locations':
	?>
	
		<p>This is a list of all locations we have associated with this dealership. To add a new one, <a href="<?=site_url('locations/add?dealership_id=' . $dealership->id)?>">click here</a>.</p>

		<?php if(isset($locations) && count($locations)):?>

			<table class="searchresultstbl" cellpadding="0" cellspacing="0">
				<thead>
					<td class="maincol">Location (Doing Business As)</td>
					<td class="actioncol" colspan="2">Action</td>
				</thead>
				<tfoot>
					<td class="maincol" colspan="3">
						Total Records: <?=count($locations)?>
					</td>
				</tfoot>
				<tbody>
				<?php foreach($locations as $location): ?>
					<tr>
						<td class="maincol"><a href="<?=site_url('locations/view/' . $location->id)?>"><?=$location->dba_name?></a></td>
						<td class="iconcol"><a href="<?=site_url('locations/view/' . $location->id)?>"><img src="<?=site_url('images/icons/location-view.png')?>" alt="VIEW" title="VIEW" /></a></td>
						<td class="iconcol"><a href="<?=site_url('locations/view/' . $location->id . '?tab=edit')?>"><img src="<?=site_url('images/icons/location-edit.png')?>" alt="EDIT" title="EDIT" /></a></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>

		<?php else: ?>

			<div class="cryptbox cryptwarning">There are no results to be shown.</div>

		<?php endif;?>
	
	<?php
	break;
	case 'edit':
	?>
	
		<p>This is the form to edit basic information about this dealership.</p>
		
		<?=$_POST ? '<div class="cryptbox crypterror">Please correct the errors in your form submission.</div>' : ''?>
		
		<form action="<?=site_url('dealerships/view/' . $dealership->id . '?tab=edit')?>" name="dealership_form" id="dealership_form" method="post" class="smartform">
				
			<fieldset class="cluster">
				<legend>Basic Information</legend>
				
				<ul>
					<li>
						<label for="fein">Federal Tax ID (FEIN)</label>
						<p>
							<input id="fein" class="input_text" name="fein" value="<?=isset($_POST['fein']) ? $_POST['fein'] : $dealership->fein?>" size="45">
							<?=$_POST && ! preg_match('/^[0-9]{9}$/', $_POST['fein']) ? '<span class="error">This must be 9 digits long.</span>' : ''?>
							<br>
							<span class="moreinfo">Enter the Federal Tax ID (FEIN) in this format: 123456789 (no dashes). Must be 9 digits long.</span>
						</p>
					</li>
					<li>
						<label for="effective_date">Effective Date</label>
						<p>
                        <?php 
						$pos = strpos($dealership->effective_date, '/'); 
						if ($pos === false) {
							$retrieved = $dealership->effective_date;
							$date = date('d/m/Y', strtotime($retrieved));	
						} else {
							$retrieved = str_replace('/', '-', $dealership->effective_date);
							$date = date('d/m/Y', strtotime($retrieved));
						}
						?>
							<input id="effective_date" class="input_text date" name="effective_date" value="<?=isset($_POST['effective_date']) ? $_POST['effective_date'] : ''?>" size="45" readonly="readonly"> <span class="moreinfo">Previous date: <?php print $dealership->effective_date; ?></span>
							<?=$_POST && strlen($_POST['effective_date']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="name">Name</label>
						<p>
							<input id="name" class="input_text" name="name" value="<?=isset($_POST['name']) ? $_POST['name'] : $dealership->name?>" size="45">
							<?=$_POST && strlen($_POST['name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="address_street">Mailing Address</label>
						<p>
							<input id="address_street" class="input_text" name="address_street" value="<?=isset($_POST['address_street']) ? $_POST['address_street'] : $dealership->address_street?>" size="45">
							<?=$_POST && strlen($_POST['address_street']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="address_city">City</label>
						<p>
							<input id="address_city" class="input_text" name="address_city" value="<?=isset($_POST['address_city']) ? $_POST['address_city'] : $dealership->address_city?>" size="45">
							<?=$_POST && strlen($_POST['address_city']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="address_state">State</label>
						<p>
							<select name="address_state" class="input_select">
								<?php
									//the correct <option> is selected. works before AND after form is submitted. couldn't figure out a better way to do this.
									if($_POST)
									{
										$address_state_select = $_POST['address_state'];
									}
									else
									{
										$address_state_select = $dealership->address_state;
									}
								?>
								<option value="AL" <?=$address_state_select == "AL" ? 'selected="selected"' : ''?>>Alabama</option>
								<option value="AK" <?=$address_state_select == "AK" ? 'selected="selected"' : ''?>>Alaska</option>
								<option value="AZ" <?=$address_state_select == "AZ" ? 'selected="selected"' : ''?>>Arizona</option>
								<option value="AR" <?=$address_state_select == "AR" ? 'selected="selected"' : ''?>>Arkansas</option>
								<option value="CA" <?=$address_state_select == "CA" ? 'selected="selected"' : ''?>>California</option>
								<option value="CO" <?=$address_state_select == "CO" ? 'selected="selected"' : ''?>>Colorado</option>
								<option value="CT" <?=$address_state_select == "CT" ? 'selected="selected"' : ''?>>Connecticut</option>
								<option value="DE" <?=$address_state_select == "DE" ? 'selected="selected"' : ''?>>Delaware</option>
								<option value="FL" <?=$address_state_select == "FL" ? 'selected="selected"' : ''?>>Florida</option>
								<option value="GA" <?=$address_state_select == "GA" ? 'selected="selected"' : ''?>>Georgia</option>
								<option value="HI" <?=$address_state_select == "HI" ? 'selected="selected"' : ''?>>Hawaii</option>
								<option value="ID" <?=$address_state_select == "ID" ? 'selected="selected"' : ''?>>Idaho</option>
								<option value="IL" <?=$address_state_select == "IL" ? 'selected="selected"' : ''?>>Illinois</option>
								<option value="IN" <?=$address_state_select == "IN" ? 'selected="selected"' : ''?>>Indiana</option>
								<option value="IA" <?=$address_state_select == "IA" ? 'selected="selected"' : ''?>>Iowa</option>
								<option value="KS" <?=$address_state_select == "KS" ? 'selected="selected"' : ''?>>Kansas</option>
								<option value="KY" <?=$address_state_select == "KY" ? 'selected="selected"' : ''?>>Kentucky</option>
								<option value="LA" <?=$address_state_select == "LA" ? 'selected="selected"' : ''?>>Louisiana</option>
								<option value="ME" <?=$address_state_select == "ME" ? 'selected="selected"' : ''?>>Maine</option>
								<option value="MD" <?=$address_state_select == "MD" ? 'selected="selected"' : ''?>>Maryland</option>
								<option value="MA" <?=$address_state_select == "MA" ? 'selected="selected"' : ''?>>Massachusetts</option>
								<option value="MI" <?=$address_state_select == "MI" ? 'selected="selected"' : ''?>>Michigan</option>
								<option value="MN" <?=$address_state_select == "MN" ? 'selected="selected"' : ''?>>Minnesota</option>
								<option value="MS" <?=$address_state_select == "MS" ? 'selected="selected"' : ''?>>Mississippi</option>
								<option value="MO" <?=$address_state_select == "MO" ? 'selected="selected"' : ''?>>Missouri</option>
								<option value="MT" <?=$address_state_select == "MT" ? 'selected="selected"' : ''?>>Montana</option>
								<option value="NE" <?=$address_state_select == "NE" ? 'selected="selected"' : ''?>>Nebraska</option>
								<option value="NV" <?=$address_state_select == "NV" ? 'selected="selected"' : ''?>>Nevada</option>
								<option value="NH" <?=$address_state_select == "NH" ? 'selected="selected"' : ''?>>New Hampshire</option>
								<option value="NJ" <?=$address_state_select == "NJ" ? 'selected="selected"' : ''?>>New Jersey</option>
								<option value="NM" <?=$address_state_select == "NM" ? 'selected="selected"' : ''?>>New Mexico</option>
								<option value="NY" <?=$address_state_select == "NY" ? 'selected="selected"' : ''?>>New York</option>
								<option value="NC" <?=$address_state_select == "NC" ? 'selected="selected"' : ''?>>North Carolina</option>
								<option value="ND" <?=$address_state_select == "ND" ? 'selected="selected"' : ''?>>North Dakota</option>
								<option value="OH" <?=$address_state_select == "OH" ? 'selected="selected"' : ''?>>Ohio</option>
								<option value="OK" <?=$address_state_select == "OK" ? 'selected="selected"' : ''?>>Oklahoma</option>
								<option value="OR" <?=$address_state_select == "OR" ? 'selected="selected"' : ''?>>Oregon</option>
								<option value="PA" <?=$address_state_select == "PA" ? 'selected="selected"' : ''?>>Pennsylvania</option>
								<option value="RI" <?=$address_state_select == "RI" ? 'selected="selected"' : ''?>>Rhode Island</option>
								<option value="SC" <?=$address_state_select == "SC" ? 'selected="selected"' : ''?>>South Carolina</option>
								<option value="SD" <?=$address_state_select == "SD" ? 'selected="selected"' : ''?>>South Dakota</option>
								<option value="TN" <?=$address_state_select == "TN" ? 'selected="selected"' : ''?>>Tennessee</option>
								<option value="TX" <?=$address_state_select == "TX" ? 'selected="selected"' : ''?>>Texas</option>
								<option value="UT" <?=$address_state_select == "UT" ? 'selected="selected"' : ''?>>Utah</option>
								<option value="VT" <?=$address_state_select == "VT" ? 'selected="selected"' : ''?>>Vermont</option>
								<option value="VA" <?=$address_state_select == "VA" ? 'selected="selected"' : ''?>>Virginia</option>
								<option value="WA" <?=$address_state_select == "WA" ? 'selected="selected"' : ''?>>Washington</option>
								<option value="WV" <?=$address_state_select == "WV" ? 'selected="selected"' : ''?>>West Virginia</option>
								<option value="WI" <?=$address_state_select == "WI" ? 'selected="selected"' : ''?>>Wisconsin</option>
								<option value="WY" <?=$address_state_select == "WY" ? 'selected="selected"' : ''?>>Wyoming</option>
							</select>
						</p>
					</li>
					<li>
						<label for="address_zip">Zip</label>
						<p>
							<input id="address_zip" class="input_text" name="address_zip" value="<?=isset($_POST['address_zip']) ? $_POST['address_zip'] : $dealership->address_zip?>" size="45">
							<?=$_POST && strlen($_POST['address_zip']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
				</ul>
			</fieldset>
			
			<fieldset class="cluster">
				<legend>Contact Information</legend>
				<ul>
					<li>
						<label for="contact_name">Name</label>
						<p>
							<input id="contact_name" class="input_text" name="contact_name" value="<?=isset($_POST['contact_name']) ? $_POST['contact_name'] : $dealership->contact_name?>" size="45">
							<?=$_POST && strlen($_POST['contact_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="contact_phone">Phone</label>
						<p>
							<input id="contact_phone" class="input_text" name="contact_phone" value="<?=isset($_POST['contact_phone']) ? $_POST['contact_phone'] : $dealership->contact_phone?>" size="45">
							<?=$_POST && strlen($_POST['contact_phone']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="contact_email">Email</label>
						<p>
							<input id="contact_email" class="input_text" name="contact_email" value="<?=isset($_POST['contact_email']) ? $_POST['contact_email'] : $dealership->contact_email?>" size="45">
							<?=$_POST && strlen($_POST['contact_email']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
				</ul>
			</fieldset>
			
			<fieldset class="cluster">
				<legend>Contact for Claims Information</legend>
				<ul>
					<li>
						<label for="claim_phone">Phone</label>
						<p>
							<input id="claim_phone" class="input_text" name="claim_phone" value="<?=isset($_POST['claim_phone']) ? $_POST['claim_phone'] : $dealership->claim_phone?>" size="45">
							<?=$_POST && strlen($_POST['claim_phone']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="claim_email">Email</label>
						<p>
							<input id="claim_email" class="input_text" name="claim_email" value="<?=isset($_POST['claim_email']) ? $_POST['claim_email'] : $dealership->claim_email?>" size="45">
							<?=$_POST && strlen($_POST['claim_email']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
				</ul>
			</fieldset>
			
			<fieldset class="cluster">
				<legend>Lienholder Information</legend>
				<ul>
					<li>
						<label for="lienholder_name">Name</label>
						<p>
							<input id="lienholder_name" class="input_text" name="lienholder_name" value="<?=isset($_POST['lienholder_name']) ? $_POST['lienholder_name'] : $dealership->lienholder_name?>" size="45">
							<?=$_POST && strlen($_POST['lienholder_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="lienholder_address_street">Address</label>
						<p>
							<input id="lienholder_address_street" class="input_text" name="lienholder_address_street" value="<?=isset($_POST['lienholder_address_street']) ? $_POST['lienholder_address_street'] : $dealership->lienholder_address_street?>" size="45">
							<?=$_POST && strlen($_POST['lienholder_address_street']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="lienholder_address_city">City</label>
						<p>
							<input id="lienholder_address_city" class="input_text" name="lienholder_address_city" value="<?=isset($_POST['lienholder_address_city']) ? $_POST['lienholder_address_city'] : $dealership->lienholder_address_city?>" size="45">
							<?=$_POST && strlen($_POST['lienholder_address_city']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="lienholder_address_state">State</label>
						<p>
							<select name="lienholder_address_state" class="input_select">
								<?php
									//the correct <option> is selected. works before AND after form is submitted. couldn't figure out a better way to do this.
									if($_POST)
									{
										$lienholder_address_state_select = $_POST['lienholder_address_state'];
									}
									else
									{
										$lienholder_address_state_select = $dealership->lienholder_address_state;
									}
								?>
								<option value="AL" <?=$lienholder_address_state_select == "AL" ? 'selected="selected"' : ''?>>Alabama</option>
								<option value="AK" <?=$lienholder_address_state_select == "AK" ? 'selected="selected"' : ''?>>Alaska</option>
								<option value="AZ" <?=$lienholder_address_state_select == "AZ" ? 'selected="selected"' : ''?>>Arizona</option>
								<option value="AR" <?=$lienholder_address_state_select == "AR" ? 'selected="selected"' : ''?>>Arkansas</option>
								<option value="CA" <?=$lienholder_address_state_select == "CA" ? 'selected="selected"' : ''?>>California</option>
								<option value="CO" <?=$lienholder_address_state_select == "CO" ? 'selected="selected"' : ''?>>Colorado</option>
								<option value="CT" <?=$lienholder_address_state_select == "CT" ? 'selected="selected"' : ''?>>Connecticut</option>
								<option value="DE" <?=$lienholder_address_state_select == "DE" ? 'selected="selected"' : ''?>>Delaware</option>
								<option value="FL" <?=$lienholder_address_state_select == "FL" ? 'selected="selected"' : ''?>>Florida</option>
								<option value="GA" <?=$lienholder_address_state_select == "GA" ? 'selected="selected"' : ''?>>Georgia</option>
								<option value="HI" <?=$lienholder_address_state_select == "HI" ? 'selected="selected"' : ''?>>Hawaii</option>
								<option value="ID" <?=$lienholder_address_state_select == "ID" ? 'selected="selected"' : ''?>>Idaho</option>
								<option value="IL" <?=$lienholder_address_state_select == "IL" ? 'selected="selected"' : ''?>>Illinois</option>
								<option value="IN" <?=$lienholder_address_state_select == "IN" ? 'selected="selected"' : ''?>>Indiana</option>
								<option value="IA" <?=$lienholder_address_state_select == "IA" ? 'selected="selected"' : ''?>>Iowa</option>
								<option value="KS" <?=$lienholder_address_state_select == "KS" ? 'selected="selected"' : ''?>>Kansas</option>
								<option value="KY" <?=$lienholder_address_state_select == "KY" ? 'selected="selected"' : ''?>>Kentucky</option>
								<option value="LA" <?=$lienholder_address_state_select == "LA" ? 'selected="selected"' : ''?>>Louisiana</option>
								<option value="ME" <?=$lienholder_address_state_select == "ME" ? 'selected="selected"' : ''?>>Maine</option>
								<option value="MD" <?=$lienholder_address_state_select == "MD" ? 'selected="selected"' : ''?>>Maryland</option>
								<option value="MA" <?=$lienholder_address_state_select == "MA" ? 'selected="selected"' : ''?>>Massachusetts</option>
								<option value="MI" <?=$lienholder_address_state_select == "MI" ? 'selected="selected"' : ''?>>Michigan</option>
								<option value="MN" <?=$lienholder_address_state_select == "MN" ? 'selected="selected"' : ''?>>Minnesota</option>
								<option value="MS" <?=$lienholder_address_state_select == "MS" ? 'selected="selected"' : ''?>>Mississippi</option>
								<option value="MO" <?=$lienholder_address_state_select == "MO" ? 'selected="selected"' : ''?>>Missouri</option>
								<option value="MT" <?=$lienholder_address_state_select == "MT" ? 'selected="selected"' : ''?>>Montana</option>
								<option value="NE" <?=$lienholder_address_state_select == "NE" ? 'selected="selected"' : ''?>>Nebraska</option>
								<option value="NV" <?=$lienholder_address_state_select == "NV" ? 'selected="selected"' : ''?>>Nevada</option>
								<option value="NH" <?=$lienholder_address_state_select == "NH" ? 'selected="selected"' : ''?>>New Hampshire</option>
								<option value="NJ" <?=$lienholder_address_state_select == "NJ" ? 'selected="selected"' : ''?>>New Jersey</option>
								<option value="NM" <?=$lienholder_address_state_select == "NM" ? 'selected="selected"' : ''?>>New Mexico</option>
								<option value="NY" <?=$lienholder_address_state_select == "NY" ? 'selected="selected"' : ''?>>New York</option>
								<option value="NC" <?=$lienholder_address_state_select == "NC" ? 'selected="selected"' : ''?>>North Carolina</option>
								<option value="ND" <?=$lienholder_address_state_select == "ND" ? 'selected="selected"' : ''?>>North Dakota</option>
								<option value="OH" <?=$lienholder_address_state_select == "OH" ? 'selected="selected"' : ''?>>Ohio</option>
								<option value="OK" <?=$lienholder_address_state_select == "OK" ? 'selected="selected"' : ''?>>Oklahoma</option>
								<option value="OR" <?=$lienholder_address_state_select == "OR" ? 'selected="selected"' : ''?>>Oregon</option>
								<option value="PA" <?=$lienholder_address_state_select == "PA" ? 'selected="selected"' : ''?>>Pennsylvania</option>
								<option value="RI" <?=$lienholder_address_state_select == "RI" ? 'selected="selected"' : ''?>>Rhode Island</option>
								<option value="SC" <?=$lienholder_address_state_select == "SC" ? 'selected="selected"' : ''?>>South Carolina</option>
								<option value="SD" <?=$lienholder_address_state_select == "SD" ? 'selected="selected"' : ''?>>South Dakota</option>
								<option value="TN" <?=$lienholder_address_state_select == "TN" ? 'selected="selected"' : ''?>>Tennessee</option>
								<option value="TX" <?=$lienholder_address_state_select == "TX" ? 'selected="selected"' : ''?>>Texas</option>
								<option value="UT" <?=$lienholder_address_state_select == "UT" ? 'selected="selected"' : ''?>>Utah</option>
								<option value="VT" <?=$lienholder_address_state_select == "VT" ? 'selected="selected"' : ''?>>Vermont</option>
								<option value="VA" <?=$lienholder_address_state_select == "VA" ? 'selected="selected"' : ''?>>Virginia</option>
								<option value="WA" <?=$lienholder_address_state_select == "WA" ? 'selected="selected"' : ''?>>Washington</option>
								<option value="WV" <?=$lienholder_address_state_select == "WV" ? 'selected="selected"' : ''?>>West Virginia</option>
								<option value="WI" <?=$lienholder_address_state_select == "WI" ? 'selected="selected"' : ''?>>Wisconsin</option>
								<option value="WY" <?=$lienholder_address_state_select == "WY" ? 'selected="selected"' : ''?>>Wyoming</option>
							</select>
						</p>
					</li>
					<li>
						<label for="lienholder_address_zip">Zip</label>
						<p>
							<input id="lienholder_address_zip" class="input_text" name="lienholder_address_zip" value="<?=isset($_POST['lienholder_address_zip']) ? $_POST['lienholder_address_zip'] : $dealership->lienholder_address_zip?>" size="45">
							<?=$_POST && strlen($_POST['lienholder_address_zip']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
				</ul>
			</fieldset>
			
			<fieldset class="cluster">
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
				$i= 0;
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
					if($_POST) {
						isset($_POST[$q_no]) && $_POST[$q_no] == "1" ? $checked1 = "checked" : '';
						isset($_POST[$q_no]) && $_POST[$q_no] == "0" ? $checked0 = "checked" : '';
					} else {
						isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? $checked1 = "checked" : '';
						isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? $checked0 = "checked" : '';
					}
					//isset($_POST[$q_no]) && $_POST[$q_no] == 1 ? $checked1 = "checked" : '';
					//isset($_POST[$q_no]) && $_POST[$q_no] == 0 ? $checked0 = "checked" : '';
					
					echo "<tr>";
					
					if($ques['boolean'] && !$ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
						
						$yes = "<td align='right' style='text-align:center;'><input type='radio' name='$q_no' id='".$q_no."_Y' value='1' $checked1 /></td>";
						$no = "<td align='right' style='text-align:center;'><input type='radio' name='$q_no' id='".$q_no."_N' value='0' $checked0 /></td>";
					
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label></td>";
						echo $yes." ".$no;
					
					} else if($ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
						
						if($_POST) {
							$class = isset($_POST[$q_no]) && $_POST[$q_no] == 1 ? '' : 'hide';
						} else {
							$class = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? '' : 'hide';
						}
						
						
						/////////////// OPTIONS - YES AND NO ////////////////////
						$yes = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_Y" value="1" onclick="expandQues(\''.$q_no.'_additional\', \'show\')" '.$checked1.' /></td>';
						$no = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_N" value="0" onclick="expandQues(\''.$q_no.'_additional\', \'hide\')" '.$checked0.' /></td>';
						
						$textarea_value = isset($_POST[$q_no.'_text']) ? $_POST[$q_no.'_text'] :  isset($ques_data[$key]['text']) ? $ques_data[$key]['text']:'';
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label><br>
						<div id='".$q_no."_additional' class='".$class."'>
						<textarea class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea><br><label for='".$q_no."_text' class='error'>
						</div>
						</td>";
						echo $yes." ".$no;
					
					} else if($ques['boolean'] && $ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
						
						if($_POST) {
							$class = isset($_POST[$q_no]) && $_POST[$q_no] == 1 ? '' : 'hide';
						} else {
							$class = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? '' : 'hide';
						}
						
						/////////////// OPTIONS - YES AND NO ////////////////////
						$yes = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_Y" value="1" onclick="expandQues(\''.$q_no.'_additional\', \'show\')" '.$checked1.' /></td>';
						$no = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_N" value="0" onclick="expandQues(\''.$q_no.'_additional\', \'hide\')" '.$checked0.' /></td>';
						
						$options = "";
						$textarea_value = isset($_POST[$q_no.'_text']) ? $_POST[$q_no.'_text'] :  isset($ques_data[$key]['text']) ? $ques_data[$key]['text']:'';
						foreach ($ques['radios'] as $oKey=>$opt) {
							
							$checked_sub = isset($_POST[$q_no."_option"]) && $_POST[$q_no."_option"] == $oKey ? "checked" : isset($ques_data[$key]['option']) && $ques_data[$key]['option'] == $oKey ? "checked" : '';
							
							$options .= " <input type='radio' name='".$q_no."_option' value='".$oKey."' $checked_sub /> ".$opt;
						}
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label><br>
						<div id='".$q_no."_additional' class='".$class."'>
						".$options."<br><textarea class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea>
						</div>
						</td>";
						echo $yes." ".$no;
					
					} else if($ques['boolean'] && !$ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
						
						if($_POST) {
							$class = isset($_POST[$q_no]) && $_POST[$q_no] == 1 ? '' : 'hide';
						} else {
							$class = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? '' : 'hide';
						}
						
						
						/////////////// OPTIONS - YES AND NO ////////////////////
						$yes = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_Y" value="1" onclick="expandQues(\''.$q_no.'_additional\', \'show\')" '.$checked1.' /></td>';
						$no = '<td align="right" style="text-align:center;"><input type="radio" name="'.$q_no.'" id="'.$q_no.'_N" value="0" onclick="expandQues(\''.$q_no.'_additional\', \'hide\')" '.$checked0.' /></td>';
					
						$options = "";
						foreach ($ques['radios'] as $oKey=>$opt) {
							
							$checked_sub = isset($_POST[$q_no."_option"]) && $_POST[$q_no."_option"] == $oKey ? "checked" : isset($ques_data[$key]['option']) && $ques_data[$key]['option'] == $oKey ? "checked" : '';
							
							$options .= " <input type='radio' name='".$q_no."_option' value='".$oKey."' $checked_sub /> ".$opt;
						}
						echo "<td>$key) ".$ques['ques']." $msg <label for='$q_no' class='error' style='float:right;'></label><br>
						<div id='".$q_no."_additional' class='".$class."'>
						".$options."<br><label for='".$q_no."_option' class='error'>
						</div>
						</td>";
						echo $yes." ".$no;
					
					}  else if(!$ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
					
						$textarea_value = isset($_POST[$q_no.'_text']) ? $_POST[$q_no.'_text'] : (isset($ques_data[$key]['text']) ? $ques_data[$key]['text']:'');
						echo "<td colspan='3'>$key) ".$ques['ques']." $msg<br><textarea class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea><label for='".$q_no."_text' class='error'></label></td>";
					}
							  
					echo "</tr>";
					$i++;
				}
			?>
            <tr>
            	<td>42) DOES DEALER USES MULTI STORY PARKING STRUCTURE AT ANY LOCATION <label for='q42' class='error' style='float:right;'></label>
            <?php 
				if($_POST) {
					$class42 = isset($_POST['q42']) && $_POST['q42'] == 1 ? '' : 'hide';
				} else {
					$class42 = isset($ques_data['42']['boolean']) && $ques_data['42']['boolean'] == 1 ? '':'hide';
				}
			 ?>
                    <div id="q42_additional_a" class="<?php print $class42;?>">
                    a.	WHEN WAS STRUCTURE BUILT? <input type="text" class="input_text" name="q42_a"  id="q42_a" value="<?=isset($_POST['q42_a']) ? $_POST['q42_a'] : isset($ques_data['42']['a']) && !empty($ques_data['42']['a']) ? $ques_data['42']['a']:''?>" /> <label for='q42_a' class='error'></label>
                    <br />b.	IF BUILT BEFORE 2000, HAS IT BEEN RETROFITTED TO MEET STATE EARTHQUAKE CODES? <input type="radio" name="q42_b" value="1" <?=isset($_POST['q42_b']) && $_POST['q42_b'] == '1' ? 'checked="checked"' : isset($ques_data['42']['b']) && $ques_data['42']['b'] == '1' ? 'checked="checeked"':''?> /> Yes 
                    <input type="radio" name="q42_b" value="0" <?=isset($_POST['q42_b']) && $_POST['q42_b'] == '0' ? 'checked="checked"' : isset($ques_data['42']['b']) && $ques_data['42']['b'] == '0' ? 'checked="checeked"':''?> /> No
                    </div>
                </td>
                 <td align="right" style="text-align:center;"><input type="radio" name="q42" id="q42_Y" onclick="expandQues('q42_additional_a', 'show'), expandQues('q43_options', 'show')" value="1" <?=isset($_POST['q42']) && $_POST['q42'] == 1 ? 'checked="checked"' : isset($ques_data['42']['boolean']) && $ques_data['42']['boolean'] == 1 ? 'checked="checeked"':''?> /></td>
				<td align="right" style="text-align:center;"><input type="radio" name="q42"  id="q42_N" onclick="expandQues('q42_additional_a', 'hide'), expandQues('q43_options', 'hide')" value="0" <?=isset($_POST['q42']) && $_POST['q42'] == 0 ? 'checked="checked"' : isset($ques_data[42]['boolean']) && $ques_data[42]['boolean'] == 0 ? 'checked="checeked"':''?> /></td>
			</tr>
    <?php 
		if($_POST) {
			$class43options = isset($_POST['q42']) && $_POST['q42'] == 1 ? '' : 'hide';
		} else {
			$class43options = isset($ques_data['42']['boolean']) && $ques_data['42']['boolean'] == 1 ? '':'hide';
		}
	 ?>
            <tr id="q43_options" class="<?php print $class43options;?>">
            	<td colspan="3">43) SELECT STRUCTURE'S CONTRUCTION <label for='q43_option' class='error' style='float:right;'></label>
                	<?php 
					if($_POST) {
						$class43 = isset($_POST['q43_option']) && $_POST['q43_option'] == 'c' ? '' : 'hide';
					} else {
						$class43 = isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'c' ? '' : 'hide';
					}
					?>
                	<br />a. PRECAST CONCRETE SURFACE WITH POURED CONCRETE PILLARS <input type="radio" name="q43_option" id="q43_A" onclick="expandQues('q43_additional_c', 'hide')" value="a" <?=isset($_POST['q43_option']) && $_POST['q43_option'] == 'a' ? 'checked="checked"' : isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'a' ? 'checked="checeked"':''?> />
                    <br />b. POURED CONCRETE 100% <input type="radio" name="q43_option" id="q43_B" onclick="expandQues('q43_additional_c', 'hide')" value="b" <?=isset($_POST['q43_option']) && $_POST['q43_option'] == 'b' ? 'checked="checked"' : isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'b' ? 'checked="checeked"':''?> />
                    <br />c. OTHER <input type="radio" name="q43_option" value="c" id="q43_C" onclick="expandQues('q43_additional_c', 'show')" <?=isset($_POST['q43_option']) && $_POST['q43_option'] == 'c' ? 'checked="checked"' : isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'c' ? 'checked="checeked"':''?> />
                    <br /> 
                    <div id="q43_additional_c" class="<?php print $class43;?>">
                    (if Other, Describe)
                    <textarea class="textbox-area" name="q43_c_text"><?=isset($_POST['q43_c_text']) ? $_POST['q43_c_text'] : isset($ques_data[43]['c']) ? $ques_data[43]['c'] : ''?></textarea>
                    <label for='q43_c_text' class='error'></label> 
                    </div>                   
                </td>
            </tr>
            <tr>
            	<td colspan="3">44) PROVIDE EARTHQUAKE LIMITS AND DEDUCTIBLES ON EXPIRING POLICY
                				<br />a.	LIMITS
                                <textarea class="textbox-area" name="q44_a_text"><?=isset($_POST['q44_a_text']) ? $_POST['q44_a_text'] : isset($ques_data[44]['a']) ? $ques_data[44]['a'] : ''?></textarea>
                                <label for='q44_a_text' class='error'></label>
								<br />b.	DEDUCTIBLE
                                <textarea class="textbox-area" name="q44_b_text"><?=isset($_POST['q44_b_text']) ? $_POST['q44_b_text'] : isset($ques_data[44]['b']) ? $ques_data[44]['b'] : ''?></textarea>
                                <label for='q44_b_text' class='error'></label>
                </td>
            </tr>
            <tr>
            	<td colspan="3">45) Number of people who are allowed to drive company owned vehicle for personal use.<br />
                	<table><tr>
                    <th>Owner</th>
                    <th>Family</th>
                    <th>Employees</th>
                    <th>Other</th>
                    </tr>
                    <tr>
                    <td><input type="text" class="input_text" name="q45_a" value="<?=isset($_POST['q45_a']) ? $_POST['q45_a'] : isset($ques_data[45]['a']) ? $ques_data[45]['a'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_b" value="<?=isset($_POST['q45_b']) ? $_POST['q45_b'] : isset($ques_data[45]['b']) ? $ques_data[45]['b'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_c" value="<?=isset($_POST['q45_c']) ? $_POST['q45_c'] : isset($ques_data[45]['c']) ? $ques_data[45]['c'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_d" value="<?=isset($_POST['q45_d']) ? $_POST['q45_d'] : isset($ques_data[45]['d']) ? $ques_data[45]['d'] : ''?>" /></td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr>
			</tr>
		</table>
				
			</fieldset>
			
			<fieldset class="cluster">
				<legend>Other Information</legend>
				
				<ul>
					<li>
						<label for="franchises">Franchises for this dealer/group</label>
						<p>
							<input id="franchises" class="input_text" name="franchises" value="<?=isset($_POST['franchises']) ? $_POST['franchises'] : $dealership->franchises?>" size="45">
							<?=$_POST && strlen($_POST['franchises']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
							<br>
							<span class="moreinfo">List any franchises at this location (e.g. Ford, Nissan, etc).</span>
						</p>
					</li>
                    <li>
						<label for="franchises">What type of inventory?</label>
						<p>
							<select id="inventory_type" name="inventory_type">
                                <option value="Auto" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Auto" ? "selected='selected'" : $dealership->inventory_type == "Auto" ? "selected='selected'" : ''?>>Auto</option>
                                <option value="Motorcycle" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Motorcycle" ? "selected='selected'" : $dealership->inventory_type == "Motorcycle" ? "selected='selected'" : ''?>>Motorcycle</option>
                                <option value="RV" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "RV" ? "selected='selected'" : $dealership->inventory_type == "RV" ? "selected='selected'" : ''?>>RV</option>
                                <option value="Simi trucks" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Simi trucks" ? "selected='selected'" : $dealership->inventory_type == "Simi trucks" ? "selected='selected'" : ''?>>Simi trucks</option>
                                <option value="Other" <?=isset($_POST['inventory_type']) && $_POST['inventory_type'] == "Other" ? "selected='selected'" : 
								($dealership->inventory_type != "Other" && $dealership->inventory_type != "Auto" && $dealership->inventory_type != "Motorcycle" && $dealership->inventory_type != "RV" && $dealership->inventory_type != "Simi trucks" ) ? "selected='selected'" : ''?>>Other</option>
                            </select>
                        </p>
                        <p id="type_other">
                        	<input id="inventory_type_other" class="input_text" name="inventory_type_other" value="<?=isset($_POST['inventory_type_other']) ? $_POST['inventory_type_other'] : ($dealership->inventory_type != "Other" && $dealership->inventory_type != "Auto" && $dealership->inventory_type != "Motorcycle" && $dealership->inventory_type != "RV" && $dealership->inventory_type != "Simi trucks" ) ? $dealership->inventory_type : ''?>" size="45">
							<?=$_POST && $_POST['inventory_type'] == "Other" && strlen($_POST['inventory_type_other']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
                        </p>
					</li>
                    <li>
						<label for="over250k">Excess of $250,000?</label>
						<p>
							<select id="over250k" class="input_select" name="over250k" style="width:311px;">
								<?php
									//the correct <option> is selected. works before AND after form is submitted. couldn't figure out a better way to do this.
									if($_POST)
									{
										$over250k_select = $_POST['over250k'];
									}
									else
									{
										$over250k_select = $dealership->over250k;
									}
								?>
								<option value="0" <?=$over250k_select == 0 ? 'selected="selected"' : ''?>>No</option>
								<option value="1" <?=$over250k_select == 1 ? 'selected="selected"' : ''?>>Yes</option>
							</select>
							<br>
							<span class="moreinfo">Select "yes" if this dealership carries any vehicles in excess of $250,000.</span>
						</p>
					</li>
					<li>
						<label for="is_allianz_renewal"><span style="font-size: 10px;">Is this a ABC/XYZ renewal?</span></label>
						<p>
							<select id="is_allianz_renewal" class="input_select" name="is_allianz_renewal" style="width:311px;">
								<?php
									//the correct <option> is selected. works before AND after form is submitted. couldn't figure out a better way to do this.
									if($_POST)
									{
										$is_allianz_renewal_select = $_POST['is_allianz_renewal'];
									}
									else
									{
										$is_allianz_renewal_select = $dealership->is_allianz_renewal;
									}
								?>
								<option value="0" <?=$is_allianz_renewal_select == 0 ? 'selected="selected"' : ''?>>No</option>
								<option value="1" <?=$is_allianz_renewal_select == 1 ? 'selected="selected"' : ''?>>Yes</option>
							</select>
							<br>
							<span class="moreinfo">Select "yes" if this is a renewal for ABC/XYZ.</span>
						</p>
					</li>
					<li>
						<label for="parking_garage_num_units"><span style="font-size: 10px;">Parking Garage Number of Units</span></label>
						<p>
							<input id="parking_garage_num_units" class="input_text" name="parking_garage_num_units" value="<?=isset($_POST['parking_garage_num_units']) ? $_POST['parking_garage_num_units'] : $dealership->parking_garage_num_units?>" size="45">
							<?=$_POST && strlen($_POST['parking_garage_num_units']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="parking_garage_max_inventory"><span style="font-size: 10px;">Parking Garage Max Inventory Vals</span></label>
						<p>
							<input id="parking_garage_max_inventory" class="input_text" name="parking_garage_max_inventory" value="<?=isset($_POST['parking_garage_max_inventory']) ? $_POST['parking_garage_max_inventory'] : $dealership->parking_garage_max_inventory?>" size="45">
							<?=$_POST && strlen($_POST['parking_garage_max_inventory']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="comprehensive_deductibles"><span style="font-size: 10px;">Comprehensive and Collision Deductibles</span></label>
						<p>
							<select id="comprehensive_deductibles" class="input_select" name="comprehensive_deductibles" style="width:311px;">
								<?php
									//the correct <option> is selected. works before AND after form is submitted. couldn't figure out a better way to do this.
									if($_POST)
									{
										$comp_ded_select = $_POST['comprehensive_deductibles'];
									}
									else
									{
										$comp_ded_select = $dealership->comprehensive_deductibles;
									}
								?>
								<option value="0" <?=$comp_ded_select == 0 ? 'selected="selected"' : ''?>>Comp $1,000 / $5,000 - Coll $1,000</option>
								<option value="1" <?=$comp_ded_select == 1 ? 'selected="selected"' : ''?>>Comp $2,500 / $10,000 - Coll $2,500</option>
								<option value="2" <?=$comp_ded_select == 2 ? 'selected="selected"' : ''?>>Comp $5,000 / $25,000 - Coll $5,000</option>
								<option value="3" <?=$comp_ded_select == 3 ? 'selected="selected"' : ''?>>Comp $10,000 / $50,000 - Col $10,000</option>
							</select>
						</p>
					</li>
					<!--<li style="padding-right:40px;">
						<fieldset class="cluster">
							<legend>Flood Deductibles (All States)</legend>
							<span class="moreinfo">Flood losses that occur in flood zones A, E or V shall have a deductible of 30% of the amount of loss. The deductible for "Flood" for loss occurring to vehicle(s) moved to any location pre-approved by us in Flood Zone X shall be 10% of the amount of loss. If more than one of these deductibles are applicable then all deductibles will apply in any one loss.</span>
						</fieldset>
					</li>
					<li style="padding-right:40px;">
						<fieldset class="cluster">
							<legend>Weather Deductibles</legend>
							<span class="moreinfo">
								<b style="color:#000000;"><u>Zone 1 &amp; 2 &#8212; Weather deductible is 10% of the amount of loss</u></b><br>
								Alaska, Arizona, California, Colorado (Western), Connecticut, Delaware, DC, Idaho, Illinois (Eastern), Maine, Maryland, Massachusetts, Michigan, Nevada, New Hampshire, New Mexico (Western), New York, Oregon, Ohio, Rhode Island, Utah, Vermont, Virginia, Washington, West Virginia, Wisconsin, Pennsylvania
								<br><br>
								<b style="color:#000000;"><u>Zone 3 &#8212; Weather deductible is 20% of the amount of loss</u></b><br>
								Alabama (Northern), Arkansas (Eastern), Georgia, Hawaii, Illinois (Western), Indiana, Kentucky, Mississippi (Northern), North Carolina, South Carolina, Tennessee, Montana, New Jersey 
								<br><br>
								<b style="color:#000000;"><u>Zone 4 &#8212; Weather deductible is $750 per vehicle</u></b><br>
								Alabama (Southern), Iowa, Louisiana (Northern), Minnesota, Mississippi (Southern), Missouri (Eastern), New Mexico (Eastern), Texas (Southern) 
								<br><br>
								<b style="color:#000000;"><u>Zone 5 &#8212; Weather deductible is $1000 per vehicle</u></b><br>
								Arkansas (Western), Colorado (Eastern), Florida, Kansas, Louisiana (Southern), Missouri (Western), Nebraska, North Dakota, Oklahoma, South Dakota, Texas (Northern), Wyoming 
							</span>
						</fieldset>
					</li>-->
					<li>
						<label for="current_insurance_carrier">Current Insurance Carrier</label>
						<p>
							<input id="current_insurance_carrier" class="input_text" name="current_insurance_carrier" value="<?=isset($_POST['current_insurance_carrier']) ? $_POST['current_insurance_carrier'] : $dealership->current_insurance_carrier?>" size="45">
							<?=$_POST && strlen($_POST['current_insurance_carrier']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="expiring_deductibles">Expiring Deductibles</label>
						<p>
							<input id="expiring_deductibles" class="input_text" name="expiring_deductibles" value="<?=isset($_POST['expiring_deductibles']) ? $_POST['expiring_deductibles'] : $dealership->expiring_deductibles?>" size="45">
							<?=$_POST && strlen($_POST['expiring_deductibles']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="expiring_weather_deductibles">Expiring Weather Deductibles</label>
						<p>
							<input id="expiring_weather_deductibles" class="input_text" name="expiring_weather_deductibles" value="<?=isset($_POST['expiring_weather_deductibles']) ? $_POST['expiring_weather_deductibles'] : $dealership->expiring_weather_deductibles?>" size="45">
							<?=$_POST && strlen($_POST['expiring_weather_deductibles']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
						</p>
					</li>
					<li>
						<label for="target_premium">Target Premium</label>
						<p>
							<input id="target_premium" class="input_text" name="target_premium" value="<?=isset($_POST['target_premium']) ? $_POST['target_premium'] : $dealership->target_premium?>" size="45">
							<?=$_POST && ! is_numeric($_POST['target_premium']) ? '<span class="error">This must be a number.</span>' : ''?>
							<br>
							<span class="moreinfo">This field must enter a number containing digits only. For example, "500000" instead of $500,000.</span>
						</p>
					</li>
					<li style="padding-right:40px;">
						<fieldset class="cluster">
							<legend>Additional Notes to Underwriter (Optional)</legend>
							<span class="moreinfo">If you have anything else you would like the underwriter to know, include it here.</span>
							<textarea class="textbox-area" name="notes"><?=isset($_POST['notes']) ? $_POST['notes'] : $dealership->notes?></textarea>
						</fieldset>
					</li>
				</ul>
			</fieldset>
			<div class="smartformbuttoncontainer">
				<input type="submit" name="submit" value="Save Record" class="submitbutton" />
			</div>
			
		</form>
		
	<?php
	break;
	case 'change_agent':
	?>
    	<p>This is the form to change agent of this dealership.</p>
		
		<?=$_POST ? '<div class="cryptbox crypterror">Please correct the errors in your form submission.</div>' : ''?>
		
		<form action="<?=site_url('dealerships/view/' . $dealership->id . '?tab=change_agent')?>" name="dealership_form" id="dealership_form" method="post" class="smartform">
        <fieldset class="cluster">
            <legend>Change Agent</legend>
            <ul>
                <li>
                    <label for="user_id">Agent</label>
                    <p>
                        <select class="chzn-select" name="user_id">
                            <?php foreach ($users_data as $usr) { 
                                $selected = isset($_POST['user_id']) && $_POST['user_id'] == $usr->id ? "selected='selected'" : ($dealership->user_id == $usr->id ? "selected='selected'" : ''); ?> 
                                <option value="<?php print $usr->id;?>" <?php print $selected;?>>
                                    <?php print $usr->first_name.' '.$usr->last_name;?> (<?php print $usr->email;?>)
                                </option>
                            <?php } ?>
                        </select>
                    </p>
                </li>
            </ul>
        </fieldset>
        <div class="smartformbuttoncontainer">
				<input type="submit" name="submit" value="Change Agent" class="submitbutton" />
		</div>
    <?php
	break;
	case 'delete':
	?>
		<p>This is the form to delete this dealership record. Be absolutely sure you want to delete this because once a record is deleted, there is no way we can retrieve it.</p>
		
		<form action="<?=site_url('dealerships/view/' . $dealership->id . '?tab=delete')?>" method="post" class="smartform">

			<div class="cryptbox crypterror">Be absolutely sure you want to delete this. Once deleted, it cannot be undone.</div>
			
			<fieldset class="cluster">
				<legend>Dealership Information</legend>
				Name: <?=$dealership->name?><br />
				Tax ID Number: <?=$dealership->fein?><br />
				Effective Date: <?=$dealership->effective_date?><br />
				Address: <?=$dealership->address_street . '; ' . $dealership->address_city . ', ' . $dealership->address_state . ' ' . $dealership->address_zip?><br />
			</fieldset>
			<div class="smartformbuttoncontainer">
				<input type="submit" name="confirm" value="Permanently Delete" class="submitbutton" />
				<input type="submit" name="cancel" value="Cancel" class="submitbutton" />
			</div>

		</form>
		
	<?php
	break;
	case 'download':
	?>
	
		DOWNLOAD
		
	<?php
	break;
	case 'files':
	?>
	
		<p>To attach additional files (such as loss runs, spreadsheets, documents, pictures, etc.) to this dealership for us to see, you can do so using this form. Attach as many files as are needed. Only one file can be attached at a time.</p>
		
		<form action="<?=site_url('dealerships/do_upload/' . $dealership->id)?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		
			<fieldset class="cluster">
			
				<?php
					//if the form was already submitted and there were errors, they will show here.
					$errors = $this->session->flashdata('error');
					if($errors)
						echo '<div class="cryptbox crypterror">' . $errors['error'] . '</div>';
				?>
			
				<legend>Attach a File</legend>
				
				<p>To attach a file, click "Browse..." and locate the file on your computer. Once located, click "Upload" to complete the process.</p>
				
				<div style="text-align: center;">
				
					<input type="file" name="userfile" size="20" />
					
					<input type="submit" value="Upload" />
					
					<br /><small>(Accepted file formats: .xls, .xlsx, .doc, .docx, .pdf, .jpg, .jpeg, .tif, .bmp, .gif, .png)
					<br />Maximum Allowed Filesize: 4MB</small>
				
				</div>
			
			</fieldset>
		
		</form>
		
		
		<fieldset class="cluster">
			
			<legend>Files Attached to this Dealership</legend>
			
			<?php
				//if the form was already submitted and the file uploaded successfully, show a message here
				$success = $this->session->flashdata('success');
				
				//var_dump($success);
				if($success)
					echo '<div class="cryptbox cryptsuccess">' . $success['upload_data']['orig_name'] . ' has been successfully uploaded</div>';
			?>
			
			<?php if(count($fileuploads)): ?>
			
				<p>The following files have been attached to this dealership:</p>
			
				<?php foreach($fileuploads as $fileupload): ?>
				
					<a href="<?=site_url('uploads/' . $fileupload->file_name)?>" target="_blank"><?=$fileupload->orig_filename?></a> (<a href="<?=site_url('dealerships/deletefile/' . $fileupload->id)?>">delete this file</a>)<br />
				
				<?php endforeach; ?>
			
			<?php else: ?>
			
				<p>No files are currently attached to this dealership.</p>
			
			<?php endif; ?>
			
		</fieldset>
	
	<?php
	break;
	case 'email':
	?>
		
		<p>This is the form to send this dealership to ABC/XYZ for review. Please review all information about this dealership and ensure everything is good before sending it to us.</p>
		
		<form action="<?=site_url('dealerships/view/' . $dealership->id . '?tab=email')?>" method="post" class="smartform">
			
			<fieldset class="cluster">
				<legend>Dealership Information</legend>
				Name: <?=$dealership->name?><br />
				Tax ID Number: <?=$dealership->fein?><br />
				Effective Date: <?=$dealership->effective_date?><br />
				Address: <?=$dealership->address_street . '; ' . $dealership->address_city . ', ' . $dealership->address_state . ' ' . $dealership->address_zip?><br />
				Number of Locations: <?=count($locations)?><br />
			</fieldset>
			<div class="smartformbuttoncontainer">
				<input type="submit" name="confirm" value="Email to ABC/XYZ for Review" class="submitbutton" />
				<input type="submit" name="cancel" value="Cancel" class="submitbutton" />
			</div>

		</form>
		
	<?php
	break;
	case 'notes':
	?>
		
		<p>Special notes about this dealerhip.</p>
        <fieldset class="cluster">
            <legend>Notes</legend>
            <ul>
                <?php foreach($notes as $note) { ?>
                    <li>
                        <p>
                            <div id="original-<?php print $note->id?>" class="this_note"><?php print $note->note;?></div>
                            <div id="edit-<?php print $note->id?>" class="hide">
                            	<form action="<?=site_url('dealerships/view/' . $dealership->id . '?tab=notes&edit='.$note->id)?>" method="post" class="smartform">
			
                                        <textarea class="textbox-area" name="note<?php print $note->id?>"><?php print $note->note;?></textarea>
                                        <?=$_POST && strlen($_POST['note'.$note->id]) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
                                    <div class="smartformbuttoncontainer">
                                        <input type="submit" name="edit" value="Edit Note" class="submitbutton" />
                                    </div>
                                 </form>
                            </div>
                            
                        </p>
                        by <strong><?php print $note->user->first_name.' '.$note->user->last_name;?></strong>  <?php print $note->created_at->format("M j 'y").' at '.$note->created_at->format("H:i"); ?>
                            <br />
                            <?php if($this->LOGGED_IN_USER->perm_dealer_notes_edit == 'all' || ($this->LOGGED_IN_USER->perm_dealer_notes_edit == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealer_notes_edit == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
							<a class="edit_note" id="a-<?php print $note->id?>" href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=notes&edit='.$note->id)?>">Edit</a>
							<?php endif; ?>
                              | 
        					<?php if($this->LOGGED_IN_USER->perm_dealer_notes_delete == 'all' || ($this->LOGGED_IN_USER->perm_dealer_notes_delete == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealer_notes_delete == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id ) ): ?>
			 				<a  class="delete_note" href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=notes&delete='.$note->id)?>">Delete</a>
							<?php endif; ?>
                    </li>
                <?php } ?>
            </ul>
		</fieldset>
		<form action="<?=site_url('dealerships/view/' . $dealership->id . '?tab=notes')?>" method="post" class="smartform">
			
			<fieldset class="cluster">
				<legend>Dealership Notes</legend>
                <span class="moreinfo">If you have anything you would like to remember about this dealership? please write it here.</span>
                <textarea class="textbox-area" name="note"><?=isset($_POST['note']) ? $_POST['note'] : ''?></textarea>
				<?=$_POST && strlen($_POST['note']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
			</fieldset>
			<div class="smartformbuttoncontainer">
				<input type="submit" name="confirm" value="Save Note" class="submitbutton" />
			</div>

		</form>
		
	<?php
	break;
	case 'checklist':
	?>
		
		<p>This checklist is a source for tracking dealership application review process for agent. Please check in which state the dealership application is?</p>
		
		<form action="<?=site_url('dealerships/view/' . $dealership->id . '?tab=checklist')?>" method="post" class="smartform">
			<table width="100%">
                <tr>
                    <td width="33%">Dealership Name: <?=$dealership->name?></td>
                    <td width="33%">Proposed Eff Date: </td>
                    <td>Date Emailed to Dif for review: </td>
                </tr>
            </table>
            <?php
					//if the form was already submitted and there were errors, they will show here.
					$errors = $this->session->flashdata('error');
					if($errors)
						echo '<div class="cryptbox crypterror">' . $errors['error'] . '</div>';
			?>
            <fieldset class="cluster">
				<legend>SET UP</legend>
                <table>
                	<tr>
                    	<td width="20"><input type="checkbox" name="app_received" value="1" <?=isset($_POST['app_received']) && $_POST['app_received'] == 1 ? "checked='checked'" : isset($checklist->app_received) && $checklist->app_received == 1 ? "checked='checked'" : ''?>></td>
                        <td>Application received</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="folder_setup" value="1" <?=isset($_POST['folder_setup']) && $_POST['folder_setup'] == 1 ? "checked='checked'" : isset($checklist->folder_setup) && $checklist->folder_setup == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Folders set up for Application, Loss History, Rating, Quote, Flood, and Emails</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="flood_maps" value="1" <?=isset($_POST['flood_maps']) && $_POST['flood_maps'] == 1 ? "checked='checked'" : isset($checklist->flood_maps) && $checklist->flood_maps == 1 ? "checked='checked'" : ''?>></td>
                        <td>Flood Maps obtained</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="google_earth_check_for_locations" value="1" <?=isset($_POST['google_earth_check_for_locations']) && $_POST['google_earth_check_for_locations'] == 1 ? "checked='checked'" : isset($checklist->google_earth_check_for_locations) && $checklist->google_earth_check_for_locations == 1 ? "checked='checked'" : ''?>></td>
                        <td>Google Earth Check for each location (All locations)</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="work_in_progress" value="1" <?=isset($_POST['work_in_progress']) && $_POST['work_in_progress'] == 1 ? "checked='checked'" : isset($checklist->work_in_progress) && $checklist->work_in_progress == 1 ? "checked='checked'" : ''?>></td>
                        <td>Logged into Work in Progress</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="enter_values_in_rating_worksheet" value="1" <?=isset($_POST['enter_values_in_rating_worksheet']) && $_POST['enter_values_in_rating_worksheet'] == 1 ? "checked='checked'" : isset($checklist->enter_values_in_rating_worksheet) && $checklist->enter_values_in_rating_worksheet == 1 ? "checked='checked'" : ''?>></td>
                        <td>Enter Addresses, Values, & Deductibles into Rating Worksheet</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="losses_on_rating_worksheet" value="1" <?=isset($_POST['losses_on_rating_worksheet']) && $_POST['losses_on_rating_worksheet'] == 1 ? "checked='checked'" : isset($checklist->losses_on_rating_worksheet) && $checklist->losses_on_rating_worksheet == 1 ? "checked='checked'" : ''?>></td>
                        <td>Print Losses and Enter Losses onto Rating Worksheet</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="file_given_to_uw" value="1" <?=isset($_POST['file_given_to_uw']) && $_POST['file_given_to_uw'] == 1 ? "checked='checked'" : isset($checklist->file_given_to_uw) && $checklist->file_given_to_uw == 1 ? "checked='checked'" : ''?>></td>
                        <td>File Given to U/W  _____________________ (John or Troy)</td>
                    </tr>
                    
                </table>
           </fieldset>
           <fieldset class="cluster">
				<legend>UNDERWRITING & QUOTING</legend>
                <table>
                	<tr>
                    	<td width="20"><input type="checkbox" name="review_email_to_lex" value="1" <?=isset($_POST['review_email_to_lex']) && $_POST['review_email_to_lex'] == 1 ? "checked='checked'" : isset($checklist->review_email_to_lex) && $checklist->review_email_to_lex == 1 ? "checked='checked'" : ''?>></td>
                        <td>Email to Lex for review</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="validate_and_enter_losses" value="1" <?=isset($_POST['validate_and_enter_losses']) && $_POST['validate_and_enter_losses'] == 1 ? "checked='checked'" : isset($checklist->validate_and_enter_losses) && $checklist->validate_and_enter_losses == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Validate Loss Runs and enter large losses</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="flood_review" value="1" <?=isset($_POST['flood_review']) && $_POST['flood_review'] == 1 ? "checked='checked'" : isset($checklist->flood_review) && $checklist->flood_review == 1 ? "checked='checked'" : ''?>></td>
                        <td>Flood Review</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="deductible_and_limits_checked" value="1" <?=isset($_POST['deductible_and_limits_checked']) && $_POST['deductible_and_limits_checked'] == 1 ? "checked='checked'" : isset($checklist->deductible_and_limits_checked) && $checklist->deductible_and_limits_checked == 1 ? "checked='checked'" : ''?>></td>
                        <td>Deductible and Limits Checked </td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="develop_select_rate" value="1" <?=isset($_POST['develop_select_rate']) && $_POST['develop_select_rate'] == 1 ? "checked='checked'" : isset($checklist->develop_select_rate) && $checklist->develop_select_rate == 1 ? "checked='checked'" : ''?>></td>
                        <td>Develop / Select Rate</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="save_quote_as_pdf" value="1" <?=isset($_POST['save_quote_as_pdf']) && $_POST['save_quote_as_pdf'] == 1 ? "checked='checked'" : isset($checklist->save_quote_as_pdf) && $checklist->save_quote_as_pdf == 1 ? "checked='checked'" : ''?>></td>
                        <td>Save as Quote as PDF to File</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="email_quote_to_agent" value="1" <?=isset($_POST['email_quote_to_agent']) && $_POST['email_quote_to_agent'] == 1 ? "checked='checked'" : isset($checklist->email_quote_to_agent) && $checklist->email_quote_to_agent == 1 ? "checked='checked'" : ''?>></td>
                        <td>Email quote to agent</td>
                    </tr>
                </table>
           </fieldset>
           <fieldset class="cluster">
				<legend>ADJUST QUOTE</legend>
                <table>
                	<tr>
                    	<td width="20"><input type="checkbox" name="agent_feedback_and_quote_adjusted" value="1" <?=isset($_POST['email_back_to_agent']) && $_POST['email_back_to_agent'] == 1 ? "checked='checked'" : isset($checklist->email_back_to_agent) && $checklist->email_back_to_agent == 1 ? "checked='checked'" : ''?>></td>
                        <td>Agent Feedback and Quote adjusted</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="email_back_to_agent" value="1" <?=isset($_POST['email_back_to_agent']) && $_POST['email_back_to_agent'] == 1 ? "checked='checked'" : isset($checklist->email_back_to_agent) && $checklist->email_back_to_agent == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Email back to agent</td>
                    </tr>
                </table>
           </fieldset>
           <fieldset class="cluster">
				<legend>BIND</legend>
                <table>
                	<tr>
                    	<td width="20"><input type="checkbox" name="email_fax_bind_req_rec" value="1" <?=isset($_POST['email_fax_bind_req_rec']) && $_POST['email_fax_bind_req_rec'] == 1 ? "checked='checked'" : isset($checklist->email_fax_bind_req_rec) && $checklist->email_fax_bind_req_rec == 1 ? "checked='checked'" : ''?>></td>
                        <td>Email or faxed Bind request received.  Binding effective date <input id="binding_effective_date" class="input_text" name="binding_effective_date" value="<?=isset($_POST['binding_effective_date']) ? $_POST['binding_effective_date'] : isset($checklist->binding_effective_date) && ($checklist->binding_effective_date != NULL) ? date('Y-m-d', strtotime($checklist->binding_effective_date)) : ''?>" size="45"></td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="make_cert_ln_mr_folder" value="1" <?=isset($_POST['make_cert_ln_mr_folder']) && $_POST['make_cert_ln_mr_folder'] == 1 ? "checked='checked'" : isset($checklist->make_cert_ln_mr_folder) && $checklist->make_cert_ln_mr_folder == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Make Certificate, Loss Notice, and Monthly Report folders</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="validate_cert_against_rating_worksheet" value="1" <?=isset($_POST['validate_cert_against_rating_worksheet']) && $_POST['validate_cert_against_rating_worksheet'] == 1 ? "checked='checked'" : isset($checklist->validate_cert_against_rating_worksheet) && $checklist->validate_cert_against_rating_worksheet == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Validate Certificate against Rating Worksheet, Certificate and Monthly Report (send to Jack for approval)</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="save_cert_excel_copy_in_cert_folder" value="1" <?=isset($_POST['save_cert_excel_copy_in_cert_folder']) && $_POST['save_cert_excel_copy_in_cert_folder'] == 1 ? "checked='checked'" : isset($checklist->save_cert_excel_copy_in_cert_folder) && $checklist->save_cert_excel_copy_in_cert_folder == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Save a copy of Certificate in Excel in Certificate Folder</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="save_monthly_report_to_idrive" value="1" <?=isset($_POST['save_monthly_report_to_idrive']) && $_POST['save_monthly_report_to_idrive'] == 1 ? "checked='checked'" : isset($checklist->save_monthly_report_to_idrive) && $checklist->save_monthly_report_to_idrive == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Save Monthly Report to I Drive</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="save_loss_notic_to_idrive" value="1" <?=isset($_POST['save_loss_notic_to_idrive']) && $_POST['save_loss_notic_to_idrive'] == 1 ? "checked='checked'" : isset($checklist->save_loss_notic_to_idrive) && $checklist->save_loss_notic_to_idrive == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Save Loss Notice to I Drive</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="email_docs_to_agent" value="1" <?=isset($_POST['email_docs_to_agent']) && $_POST['email_docs_to_agent'] == 1 ? "checked='checked'" : isset($checklist->email_docs_to_agent) && $checklist->email_docs_to_agent == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Email Certificate, Monthly Report, Loss Notice and Policy Copy to Agent or Dealer</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="email_sold_notice" value="1" <?=isset($_POST['email_sold_notice']) && $_POST['email_sold_notice'] == 1 ? "checked='checked'" : isset($checklist->email_sold_notice) && $checklist->email_sold_notice == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Email Sold Notice to Ashley</td>
                    </tr>
                </table>
           </fieldset>
           <fieldset class="cluster">
				<legend>POST BINDING</legend>
                <table>
                	<tr>
                    	<td width="20"><input type="checkbox" name="enter_data_into_db" value="1" <?=isset($_POST['enter_data_into_db']) && $_POST['enter_data_into_db'] == 1 ? "checked='checked'" : isset($checklist->enter_data_into_db) && $checklist->enter_data_into_db == 1 ? "checked='checked'" : ''?>></td>
                        <td>Enter Data into DOL Database</td>
                    </tr>
                    <tr>
                    	<td width="20"><input type="checkbox" name="scan_docs_into_file" value="1" <?=isset($_POST['scan_docs_into_file']) && $_POST['scan_docs_into_file'] == 1 ? "checked='checked'" : isset($checklist->scan_docs_into_file) && $checklist->scan_docs_into_file == 1 ? "checked='checked'" : ''?> ></td>
                        <td>Scan documents into file</td>
                    </tr>
                </table>
           </fieldset>
			<div class="smartformbuttoncontainer">
				<input type="submit" name="confirm" value="Submit checklist" class="submitbutton" />
				<input type="submit" name="cancel" value="Cancel" class="submitbutton" />
			</div>

		</form>
		
	<?php
	break;
	case 'index':
	default:
	?>
    <style>
  .progress-label {
    float: left;
    margin-left: 41.5%;
    margin-top: 5px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
  }
  </style>
  <script>
    $(function() {
		var perc = <?php print $perc;?>;
		 var progressbar = $( "#progressbar" ),
      	progressLabel = $( ".progress-label" ), 
		perc_done = $( "#perc_done" );
		perc_done.text( perc.toPrecision(3) + "%" );
		progressbar.progressbar({
			  value: perc,
			  change: function() {
				
			  },
			  complete: function() {
				progressLabel.text( "Dealership Review Process Completed!" );
			  }
		});
	});
  </script>
        <p>This is a basic overview of information we have about this dealership.</p>
        <div id="progressbar"><div class="progress-label">Dealership Review Process <span id="perc_done">0%</span> Done</div></div>
		
		<fieldset class="cluster">
			<legend>Dealership Information</legend>
			Name: <?=$dealership->name?><br />
			Tax ID Number: <?=$dealership->fein?><br />
			Effective Date: <?php echo  $dealership->effective_date;
			/*$pos = strpos($dealership->effective_date, '/'); 
			if ($pos === false) {
				$retrieved = $dealership->effective_date;
				$date = date('M j, Y', strtotime($retrieved));	
			} else {
				$retrieved = str_replace('/', '-', $dealership->effective_date);
				$date = date('M j, Y', strtotime($retrieved));
			}
			echo $date;*///->format('d/m/Y');
			//$date = str_replace('/', '-', $dealership->effective_date);
			//$d = new DateTime( $date );
			//echo $d->format( 'M j, Y' );
			?><br />
			Mailing Address: <?=$dealership->address_street . '; ' . $dealership->address_city . ', ' . $dealership->address_state . ' ' . $dealership->address_zip?><br />
		</fieldset>

		<fieldset class="cluster">
			<legend>Contact Information</legend>
			Name: <?=$dealership->contact_name?><br />
			Phone: <?=$dealership->contact_phone?><br />
			Email: <?=$dealership->contact_email?>
		</fieldset>

		<fieldset class="cluster">
			<legend>Contact for Claims</legend>
			Phone: <?=$dealership->claim_phone?><br />
			Email: <?=$dealership->claim_email?><br />
		</fieldset>

		<fieldset class="cluster">
			<legend>Lienholder Information</legend>
			Name: <?=$dealership->lienholder_name?><br />
			Address: <?=$dealership->lienholder_address_street . '; ' . $dealership->lienholder_address_city . ', ' . $dealership->lienholder_address_state . ' ' . $dealership->lienholder_address_zip?><br />
		</fieldset>


		<fieldset class="cluster">
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
					//echo "<pre>".print_r($ques_data[$key], 1)."</pre>";
					$checked1 = false;
					$checked0 = false;
					$q_no = "q".$key;
					$msg = "";
					$checked_sub = '';
					if($ques['msg']) {
						$msg = $ques['msg'];
					}
					
					$yes = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />
					' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />';
					$no = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />';
					
					//print_r($ques);
					echo "<tr>";
					
					if($ques['boolean'] && !$ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
						
						echo "<td>$key) ".$ques['ques']." $msg</td>";
						
						echo "<td>".$yes."</td><td>".$no."</td>";
					
					} else if($ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
						
						$class = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? '' : 'hide';
						
						$textarea_value = isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : '';
						
						echo "<td>$key) ".$ques['ques']." $msg<br>
						<div id='".$q_no."_additional' class='".$class."'>
						<textarea  disabled='disabled' class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea>
						</div>
						</td>";
						
						echo "<td>".$yes."</td><td>".$no."</td>";
					
					} else if($ques['boolean'] && $ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
						
						$class = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? '' : 'hide';
						
						$options = "";
						
						$textarea_value = isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : '';
						
						foreach ($ques['radios'] as $oKey=>$opt) {
							$options .= isset($ques_data[$key]['option']) && $ques_data[$key]['option'] == $oKey ? ' <img src="' . site_url('images/icons/checkbox_on.png') . '" /> '.$opt : ' <img src="' . site_url('images/icons/checkbox_off.png') . '" /> '.$opt ;
							//isset($_POST[$q_no."_".$oKey]) && $_POST[$q_no."_".$oKey] == $oKey ? $checked_sub = "checked" : '';
							//$options .= "<input type='radio' name='".$q_no."_".$oKey."' value='".$oKey."' $checked_sub /> ".$opt;
						}
						echo "<td>$key) ".$ques['ques']." $msg<br>
						<div id='".$q_no."_additional' class='".$class."'>
							".$options."<br><textarea disabled='disabled' class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea>
						</div>
						</td>";
						echo "<td>".$yes."</td><td>".$no."</td>";
					
					} else if($ques['boolean'] && !$ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
						
						$class = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? '' : 'hide';
						
						$options = "";
						foreach ($ques['radios'] as $oKey=>$opt) {
							$options .= isset($ques_data[$key]['option']) && $ques_data[$key]['option'] == $oKey ? ' <img src="' . site_url('images/icons/checkbox_on.png') . '" /> '.$opt : ' <img src="' . site_url('images/icons/checkbox_off.png') . '" /> '.$opt;
						}
						
						echo "<td>$key) ".$ques['ques']." $msg<br>
						<div id='".$q_no."_additional' class='".$class."'>
						".$options."</div></td>";
						echo "<td>".$yes."</td><td>".$no."</td>";
					
					}  else if(!$ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
						
						$textarea_value = isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : '';
						
						echo "<td colspan='3'>$key) ".$ques['ques']." $msg<br><textarea disabled='disabled' class='textbox-area' name='".$q_no."_text'>".$textarea_value."</textarea></td>";
					}
							  
					echo "</tr>";
				}
			?>
            <tr>
            	<td>42) DOES DEALER USES MULTI STORY PARKING STRUCTURE AT ANY LOCATION
                	<?php $class42 = isset($ques_data['42']['boolean']) && $ques_data['42']['boolean'] == 1 ? '' : 'hide'; ?>
                    <div id="q42_additional_a" class="<?php print $class42;?>">
                    <br />a.	WHEN WAS STRUCTURE BUILT? <input type="text" disabled="disabled" value="<?=isset($ques_data['42']['a']) ? $ques_data['42']['a'] : ''?>" />
                    <br />b.	IF BUILT BEFORE 2000, HAS IT BEEN RETROFITTED TO MEET STATE EARTHQUAKE CODES? 
					<?=isset($ques_data['42']['b']) && $ques_data['42']['b'] == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?> Yes 
                    <?=isset($ques_data['42']['b']) && $ques_data['42']['b'] == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?> No
                    </div>
                </td>
                 <td align="right" style="text-align:center;"> <?=isset($ques_data['42']['boolean']) && $ques_data['42']['boolean'] == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				<td align="right" style="text-align:center;"><?=isset($ques_data['42']['boolean']) && $ques_data['42']['boolean'] == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
			</tr>
            <?php $class43options = isset($ques_data['42']['boolean']) && $ques_data['42']['boolean'] == 1 ? '' : 'hide'; ?>
            <tr id="q43_options" class="<?php print $class43options;?>">
            	<td colspan="3">43) SELECT STRUCTURE'S CONTRUCTION
                	<?php $class43 = isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'c' ? '' : 'hide'; ?>
                	<br />a. PRECAST CONCRETE SURFACE WITH POURED CONCRETE PILLARS <?=isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'a' ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?>
                    <br />b. POURED CONCRETE 100% <?=isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'b' ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?>
                    <br />c. OTHER <?=isset($ques_data['43']['option']) && $ques_data['43']['option'] == 'c' ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?>
                    <br /> 
                    <div id="q43_additional_c" class="<?php print $class43;?>">
                        (if Other, Describe)
                        <textarea class="textbox-area" disabled="disabled" name="q43_c_text"><?=isset($ques_data['43']['c']) ? $ques_data['43']['c'] : ''?></textarea>                    </div>
                </td>
            </tr>
            <tr>
            	<td colspan="3">44) PROVIDE EARTHQUAKE LIMITS AND DEDUCTIBLES ON EXPIRING POLICY
                				<br />a.	LIMITS
                                <textarea class="textbox-area" disabled="disabled" name="q44_a_text"><?=isset($ques_data['44']['a']) ? $ques_data['44']['a'] : ''?></textarea>
								<br />b.	DEDUCTIBLE
                                <textarea class="textbox-area" disabled="disabled" name="q44_b_text"><?=isset($ques_data['44']['b']) ? $ques_data['44']['b'] : ''?></textarea>
                </td>
            </tr>
            <tr>
            	<td colspan="3">45) Number of people who are allowed to drive company owned vehicle for personal use.<br />
                	<table><tr>
                    <th>Owner</th>
                    <th>Family</th>
                    <th>Employees</th>
                    <th>Other</th>
                    </tr>
                    <tr>
                    <td><input type="text" class="input_text" name="q45_a" disabled="disabled" value="<?=isset($ques_data['45']['a']) ? $ques_data['45']['a'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_b" disabled="disabled" value="<?=isset($ques_data['45']['b']) ? $ques_data['45']['b'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_c" disabled="disabled" value="<?=isset($ques_data['45']['c']) ? $ques_data['45']['c'] : ''?>" /></td>
                    <td><input type="text" class="input_text" name="q45_d" disabled="disabled" value="<?=isset($ques_data['45']['d']) ? $ques_data['45']['d'] : ''?>" /></td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr>
			</tr>
		</table>
            
			<!--<table class="questionnaire_tbl" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td class="maincol">Question</td>
						<td class="actioncol">YES</td>
						<td class="actioncol">NO</td>
					</tr>
				</thead>
				<tr>
					<td>
						1) Is identification required before releasing vehicles for test drive?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q1 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q1 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						2) Does salesperson accompany all test drives?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q2 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q2 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						3) Are employee driving records reviewed at least annually?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q3 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q3 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						4) Does dealer use window lockboxes for overnight storage of vehicle keys?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q4 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q4 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td colspan="3">
						5) Describe system(s) used for key storage.<br>
						<div style="padding:10px; border:1px solid #888888; background-color:#fff; width: 96%;">
							<?=$dealership->q5?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						6) Does dealer furnish automobiles to non-employees?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q6 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q6 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						7) Does dealer provide demonstrators to employees? If so, how many?
						<div style="padding:10px; border:1px solid #888888; background-color:#fff; width: 96%;">
							Answer provided: <?=$dealership->q7text?>
						</div>
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q7 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q7 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						8) Are buildings monitored by central security service and alarms?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q8 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q8 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						9) Does dealer use on premises security service during non-business hours?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q9 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q9 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						10) Does dealer use surveillance cameras?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q10 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q10 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						11) Do all buildings in which vehicles are stored overnight have security alarms?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q11 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q11 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						12) Does dealer have rock aggregate on any building roofs?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q12 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q12 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						13) Are any storage or parking lots in a flood zone? Please explain.<br>
						<div style="padding:10px; border:1px solid #888888; background-color:#fff; width: 96%;">
							Answer provided: <?=$dealership->q13text?>
						</div>
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q13 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q13 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						14) Has any portion of dealer's vehicle storage or parking areas ever flooded? Please explain.<br>
						<div style="padding:10px; border:1px solid #888888; background-color:#fff; width: 96%;">
							Answer provided: <?=$dealership->q14text?>
						</div>
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q14 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q14 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						15) Does dealer have written disaster plan for avoiding damage from severe weather storms?
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q15 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q15 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td>
						16) If hail nets, buildings, or other structures will protect vehicles from hail damage, how many cars are protected?
						<div style="padding:10px; border:1px solid #888888; background-color:#fff; width: 96%;">
							Answer provided: <?=$dealership->q16text?>
						</div>
					</td>
					<td align="right" style="text-align:center;"><?=$dealership->q16 == 1 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
					<td align="right" style="text-align:center;"><?=$dealership->q16 == 0 ? '<img src="' . site_url('images/icons/checkbox_on.png') . '" />' : '<img src="' . site_url('images/icons/checkbox_off.png') . '" />'?></td>
				</tr>
				<tr>
					<td colspan="3">
						17) Describe any managerial or loss control improvements in the past 4 years that were implemented as a result of a loss.<br>
						<div style="padding:10px; border:1px solid #888888; background-color:#fff; width: 96%;">
							<?=$dealership->q17?>
						</div>
					</td>
				</tr>
				<tr>
				</tr>
			</table>-->
		</fieldset>

		<fieldset class="cluster">
			<legend>Other Information</legend>
			Franchises: <?=$dealership->franchises?><br />
            What type of inventory?: <?=$dealership->inventory_type?><br />
			Vehicles in Excess of $250,000?: <?=($dealership->over250k ? 'Yes' : 'No')?><br />
			Is this a ABC/XYZ renewal?: <?=($dealership->is_allianz_renewal ? 'Yes' : 'No')?><br />
			Number of Units in Parking Garage: <?=$dealership->parking_garage_num_units?><br />
			Maximum Inventory Values in Parking Garage <?=$dealership->parking_garage_max_inventory?><br />
			Comprehensive and Collision Deductible Choice: 
						<?php
							switch($dealership->comprehensive_deductibles):
							case 0:
								echo 'Comp $1,000 / $5,000 - Coll $1,000';
								break;
							case 1:
								echo 'Comp $2,500 / $10,000 - Coll $2,500';
								break;
							case 2:
								echo 'Comp $5,000 / $25,000 - Coll $5,000';
								break;
							case 3:
								echo 'Comp $10,000 / $50,000 - Col $10,000';
								break;
							default:
								echo 'None chosen';
								break;
								endswitch;
							?><br />
			Current Insurance Carrier: <?=$dealership->current_insurance_carrier?><br />
			Expiring Deductibles: <?=$dealership->expiring_deductibles?><br />
			Expiring Weather Deductibles: <?=$dealership->expiring_weather_deductibles?><br />
			Target Premium: <?=$dealership->target_premium?><br />
			Additional Notes to Underwriter (Optional): <?=strlen($dealership->notes) > 0 ? $dealership->notes : '<em>None provided.</em>'?><br />
		</fieldset>
		
	<?php
	break;
	endswitch;
?>
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

jQuery.validator.addMethod("compare_with", function (value, element) {
	var yr = $("#q42_a").val();
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
			}
			
		},
		messages: {}
	});
	$(".chzn-select").chosen();
	$("#binding_effective_date").datepicker({ dateFormat : 'yy-mm-dd' });
	
	$(".date").attr("placeholder", "mm/dd/yyyy").datepicker({ dateFormat : 'mm/dd/yy' });
	
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
	var prev_show = "";
	var original_hide = "";
	$('.edit_note').each(function(index, element) {
       	$(this).click(function(e) {
			e.preventDefault();
			var str = this.id;
			var n=str.split('-');
			var id = n[1];
			if(prev_show != null) {
				$(prev_show).hide();
			}
			if(original_hide != null) {
				$(original_hide).show();
			}
			$("#original-"+id).hide();
			$("#edit-"+id).show();
			
			prev_show = "#edit-"+id;
			original_hide = "#original-"+id;
		});
	 });
});
</script>
