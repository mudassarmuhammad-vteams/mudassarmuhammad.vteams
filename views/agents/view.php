<?=$this->session->flashdata('cryptbox_message')?>

<h1>Agent: <?=$agent->first_name?> <?=$agent->last_name?></h1>

<div class="usertabscontainer">
	<div class="usertabs">
	
		<?php //Determine what tabs to show based on user permissions: ?>
		
		<?php if($this->LOGGED_IN_USER->perm_agent_view == 'all' || ($this->LOGGED_IN_USER->perm_agent_view == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_agent_view == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='index' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id)?>">overview</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_agent_edit == 'all' || ($this->LOGGED_IN_USER->perm_agent_edit == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_agent_edit == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='edit' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=edit')?>">edit info</a>
		<?php endif; ?>
        
        <?php if($this->LOGGED_IN_USER->perm_edit_password == 'all' || ($this->LOGGED_IN_USER->perm_edit_password == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_edit_password == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='change_password' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=change_password')?>">change password</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_dealership_view == 'all' || ($this->LOGGED_IN_USER->perm_dealership_view == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_dealership_view == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='dealerships' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=dealerships')?>">dealerships (<?=count($dealerships)?>)</a>
		<?php endif; ?>
        
        <?php if($this->LOGGED_IN_USER->perm_export_dealer_list == 'all' || ($this->LOGGED_IN_USER->perm_export_dealer_list == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_export_dealer_list == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='export_dealerships' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=export_dealerships')?>">export dealerships (<?=count($dealerships)?>)</a>
		<?php endif; ?>
		
		<!--<a <?=$tab=='change_password' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=change_password')?>">change password</a>-->
		
		<?php if($this->LOGGED_IN_USER->perm_edit_permissions): ?>
			<a <?=$tab=='permissions' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=permissions')?>">permissions</a>
		<?php endif; ?>
		
		<?php if($this->LOGGED_IN_USER->perm_agent_delete == 'all' || ($this->LOGGED_IN_USER->perm_agent_delete == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_agent_delete == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='delete' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=delete')?>">delete account</a>
		<?php endif; ?>
        
        <?php if($this->LOGGED_IN_USER->perm_agent_notes_view == 'all' || ($this->LOGGED_IN_USER->perm_agent_notes_view == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_agent_notes_view == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
			<a <?=$tab=='notes' ? 'class="youarehere" ' : ''?>href="<?=site_url('agents/view/' . $agent->id . '?tab=notes')?>">notes</a>
		<?php endif; ?>
	</div>
</div>

	<?php
		switch($tab):
		case 'dealerships':
		?>
			
			<?php if(count($dealerships)): ?>
			
				<table class="searchresultstbl" cellpadding="0" cellspacing="0">
					<thead>
						<td class="maincol">Dealership</td>
						<td class="actioncol" colspan="2">Action</td>
					</thead>
					<tfoot>
						<td class="maincol" colspan="3">
							Total Records: <?=count($dealerships)?>
						</td>
					</tfoot>
					<?php foreach($dealerships as $dealership): ?>
						<tr>
							<td><a href="<?=site_url('dealerships/view/' . $dealership->id)?>"><?=$dealership->name?></a></td>
							<td class="iconcol"><a href="<?=site_url('dealerships/view/' . $dealership->id)?>"><img src="<?=site_url('images/icons/16/dealership-view.png')?>" alt="VIEW" title="VIEW"></a></td>
							<td class="iconcol"><a href="<?=site_url('dealerships/view/' . $dealership->id . '?tab=edit')?>"><img src="<?=site_url('images/icons/16/dealership-edit.png')?>" alt="EDIT" title="EDIT"></a></td>
						</tr>
					<?php endforeach;?>
				</table>
			
			<?php else: ?>
			
				<div class="cryptbox cryptwarning">There are no results to be shown.</div>
			
			<?php endif; ?>
			
		<?php
		break;
		case 'edit':
		?>
			<form method="post" action="<?=site_url('agents/view/' . $agent->id . '?tab=edit')?>" class="smartform">
				<fieldset>
					<legend>Update Agent Information</legend>
					<ul>
						<li>
							<label for="email">Email</label>
							<p>
								<input id="email" class="input_text" size="45" value="<?=isset($_POST['email']) ? $_POST['email'] : $agent->email?>" name="email" />
								<?=$_POST && ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? '<span class="error">Email is invalid.</span>' : ''?>
							</p>
						</li>
						<li>
							<label for="first_name">First Name</label>
							<p>
								<input id="first_name" class="input_text" size="45" value="<?=isset($_POST['first_name']) ? $_POST['first_name'] : $agent->first_name?>" name="first_name" />
								<?=isset($_POST['first_name']) && strlen($_POST['first_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
							</p>
						</li>
						<li>
							<label for="last_name">Last Name</label>
							<p>
								<input id="last_name" class="input_text" size="45" value="<?=isset($_POST['last_name']) ? $_POST['last_name'] : $agent->last_name?>" name="last_name" />
								<?=isset($_POST['last_name']) && strlen($_POST['last_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
							</p>
						</li>
						<li>
							<label for="address_street">Street Address</label>
							<p>
								<input id="address_street" class="input_text" size="45" value="<?=isset($_POST['address_street']) ? $_POST['address_street'] : $agent->address_street?>" name="address_street" />
								<?=isset($_POST['address_street']) && strlen($_POST['address_street']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
								<br />
								<span class="moreinfo">Enter street number and street, e.g. 1234 Elm Street.</span>
							</p>
						</li>
						<li>
							<label for="address_city">City</label>
							<p>
								<input id="address_city" class="input_text" size="45" value="<?=isset($_POST['address_city']) ? $_POST['address_city'] : $agent->address_city?>" name="address_city" />
								<?=isset($_POST['address_city']) && strlen($_POST['address_city']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
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
											$address_state_select = $agent->address_state;
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
								<input id="address_zip" class="input_text" size="45" value="<?=isset($_POST['address_zip']) ? $_POST['address_zip'] : $agent->address_zip?>" name="address_zip" />
								<?=isset($_POST['address_zip']) && strlen($_POST['address_zip']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
							</p>
						</li>
						<li>
							<label for="phone">Phone Number</label>
							<p>
								<input id="phone" class="input_text" size="45" value="<?=isset($_POST['phone']) ? $_POST['phone'] : $agent->phone?>" name="phone" />
								<?=isset($_POST['phone']) && strlen($_POST['phone']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
								<br />
								<span class="moreinfo">Please enter in this format: (123) 456 7890.</span>
							</p>
						</li>
					</ul>
				</fieldset>
				<div class="smartformbuttoncontainer">
					<input type="submit" name="submit" value="Update Information" class="submitbutton" />
				</div>
			</form>
			
		<?php
		break;
		case 'change_password':
		?>
			
			<form method="POST" action="<?=site_url('agents/view/' . $agent->id . '?tab=change_password')?>" class="smartform">
				<fieldset>
					
					<?=$_POST ? '<div class="cryptbox crypterror">Please correct the errors in your form submission.</div>' : ''?>
					
					<legend>Change Agent Password</legend>
					<ul>
						<?php if ($require_old_password): ?>
                        <li>
							<label for="old_password">Old Password</label>
							<p>
								<input id="old_password" class="input_text" size="45" value="<?=isset($_POST['old_password']) ? $_POST['old_password'] : ''?>" type="password" name="old_password" autocomplete="off" />
								<?=$_POST && ! isset($old_password_invalid) ? '<span class="error">That\'s not your old password.</span>' : ''?>
							</p>
						</li>
                        <?php endif;?>
						<li>
							<label for="new_password">Password</label>
							<p>
								<input id="new_password" class="input_text" size="45" value="<?=isset($_POST['new_password']) ? $_POST['new_password'] : ''?>" type="password" name="new_password" autocomplete="off" />
								<?=$_POST && ! preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['new_password']) ? '<span class="error">Password is invalid.</span>' : ''?>
								<br />
								<span class="moreinfo">Passwords must be at least 8 characters long, and contain at least one uppercase letter, lowercase letter, and a digit.</span>
							</p>
						</li>
						<li>
							<label for="new_password_confirmation">Confirm Password</label>
							<p>
								<input id="new_password_confirmation" class="input_text" size="45" value="<?=isset($_POST['new_password_confirmation']) ? $_POST['new_password_confirmation'] : ''?>" type="password" name="new_password_confirmation" autocomplete="off" />
								<?=$_POST && $_POST['new_password'] != $_POST['new_password_confirmation'] ? '<span class="error">Passwords do not match.</span>' : ''?>
							</p>
						</li>
					</ul>
				</fieldset>
				<div class="smartformbuttoncontainer">
					<input type="submit" name="submit" value="Change Password" class="submitbutton" />
				</div>
			</form>
			
		<?php
		break;
		case 'permissions':
		?>
			
			<p>This is the page to change the permissions of this agent. Only ABC employees can see this page.</p>
			
			<form action="<?=site_url('agents/view/' . $agent->id . '?tab=permissions')?>" method="post" class="smartform">
			
				<p>
					Set default permissions to:
					<a id="perm_set_global_administrator" style="padding:6px; border:1px #444 solid; cursor:pointer; background-color:#f4f4f4;">Global Administrator</a>
					<a id="perm_set_agency_administrator" style="padding:6px; border:1px #444 solid; cursor:pointer; background-color:#f4f4f4;">Agency Administrator</a>
					<a id="perm_set_agent" style="padding:6px; border:1px #444 solid; cursor:pointer; background-color:#f4f4f4;">Regular Agent</a>
				</p>
				
				<table class="searchresultstbl" cellpadding="0" cellspacing="0">
					<thead>
						<td class="maincol">Permission Property</td>
						<td class="actioncol" style="width:50px;"><small>ALL</small></td>
						<td class="actioncol" style="width:50px;"><small>WITHIN AGENCY</small></td>
						<td class="actioncol" style="width:50px;"><small>OWN</small></td>
						<td class="actioncol" style="width:50px;"><small>NONE</small></td>
					</thead>
					<tr>
						<td colspan="5"><strong>Agencies:</strong></td>
					</tr>
					<tr>
						<td>What agencies can this agent see?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_view" value="all" <?=$agent->perm_agency_view == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_view" value="own" <?=$agent->perm_agency_view == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_view" value="none" <?=$agent->perm_agency_view == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What agencies can this agent edit?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_edit" value="all" <?=$agent->perm_agency_edit == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_edit" value="own" <?=$agent->perm_agency_edit == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_edit" value="none" <?=$agent->perm_agency_edit == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What agencies can this agent delete?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_delete" value="all" <?=$agent->perm_agency_delete == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_delete" value="own" <?=$agent->perm_agency_delete == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_delete" value="none" <?=$agent->perm_agency_delete == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    <tr>
						<td>What agencies can this agent export?</td>
						<td style="text-align: center;"><input type="radio" name="perm_export_agency_list" value="all" <?=$agent->perm_export_agency_list == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_agency_list" value="own" <?=$agent->perm_export_agency_list == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_agency_list" value="none" <?=$agent->perm_export_agency_list == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td colspan="5"><strong>Agents:</strong></td>
					</tr>
					<tr>
						<td>What agents can this agent see?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_view" value="all" <?=$agent->perm_agent_view == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_view" value="agency" <?=$agent->perm_agent_view == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_view" value="own" <?=$agent->perm_agent_view == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"></td>
					</tr>
					<tr>
						<td>What agents can this agent edit?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_edit" value="all" <?=$agent->perm_agent_edit == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_edit" value="agency" <?=$agent->perm_agent_edit == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_edit" value="own" <?=$agent->perm_agent_edit == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"></td>
					</tr>
					<tr>
						<td>What agents can this agent delete?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_delete" value="all" <?=$agent->perm_agent_delete == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_delete" value="agency" <?=$agent->perm_agent_delete == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_delete" value="own" <?=$agent->perm_agent_delete == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"></td>
					</tr>
                    <tr>
						<td>What agents can this agent export?</td>
						<td style="text-align: center;"><input type="radio" name="perm_export_agent_list" value="all" <?=$agent->perm_export_agent_list == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_agent_list" value="agency" <?=$agent->perm_export_agent_list == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_agent_list" value="own" <?=$agent->perm_export_agent_list == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_agent_list" value="none" <?=$agent->perm_export_agent_list == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    <tr>
						<td>What agents' password can this agent change?</td>
						<td style="text-align: center;"><input type="radio" name="perm_edit_password" value="all" <?=$agent->perm_edit_password == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_edit_password" value="agency" <?=$agent->perm_edit_password == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_edit_password" value="own" <?=$agent->perm_edit_password == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_edit_password" value="none" <?=$agent->perm_edit_password == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td colspan="5"><strong>Dealerships:</strong></td>
					</tr>
					<tr>
						<td>What dealerships can this agent see?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_view" value="all" <?=$agent->perm_dealership_view == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_view" value="agency" <?=$agent->perm_dealership_view == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_view" value="own" <?=$agent->perm_dealership_view == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_view" value="none" <?=$agent->perm_dealership_view == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealerships can this agent edit?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_edit" value="all" <?=$agent->perm_dealership_edit == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_edit" value="agency" <?=$agent->perm_dealership_edit == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_edit" value="own" <?=$agent->perm_dealership_edit == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_edit" value="none" <?=$agent->perm_dealership_edit == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    <tr>
						<td>What dealerships' agent can this agent change?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_agentchange" value="all" <?=$agent->perm_dealership_agentchange == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_agentchange" value="agency" <?=$agent->perm_dealership_agentchange == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_agentchange" value="own" <?=$agent->perm_dealership_agentchange == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_agentchange" value="none" <?=$agent->perm_dealership_agentchange == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    <tr>
						<td>What dealerships' checklst can this agent fill?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_checklist" value="all" <?=$agent->perm_dealership_checklist == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_checklist" value="agency" <?=$agent->perm_dealership_checklist == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_checklist" value="own" <?=$agent->perm_dealership_checklist == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_checklist" value="none" <?=$agent->perm_dealership_checklist == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealerships can this agent attach files to/from?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_attachfiles" value="all" <?=$agent->perm_dealership_attachfiles == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_attachfiles" value="agency" <?=$agent->perm_dealership_attachfiles == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_attachfiles" value="own" <?=$agent->perm_dealership_attachfiles == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_attachfiles" value="none" <?=$agent->perm_dealership_attachfiles == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealerships can this agent download an .xls spreadsheet for?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_downloadxls" value="all" <?=$agent->perm_dealership_downloadxls == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_downloadxls" value="agency" <?=$agent->perm_dealership_downloadxls == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_downloadxls" value="own" <?=$agent->perm_dealership_downloadxls == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_downloadxls" value="none" <?=$agent->perm_dealership_downloadxls == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealerships can this agent email to ABC for review?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_emailforreview" value="all" <?=$agent->perm_dealership_emailforreview == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_emailforreview" value="agency" <?=$agent->perm_dealership_emailforreview == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_emailforreview" value="own" <?=$agent->perm_dealership_emailforreview == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_emailforreview" value="none" <?=$agent->perm_dealership_emailforreview == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealerships can this agent print?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_print" value="all" <?=$agent->perm_dealership_print == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_print" value="agency" <?=$agent->perm_dealership_print == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_print" value="own" <?=$agent->perm_dealership_print == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_print" value="none" <?=$agent->perm_dealership_print == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealerships can this agent delete?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_delete" value="all" <?=$agent->perm_dealership_delete == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_delete" value="agency" <?=$agent->perm_dealership_delete == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_delete" value="own" <?=$agent->perm_dealership_delete == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealership_delete" value="none" <?=$agent->perm_dealership_delete == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    <tr>
						<td>What dealerships can this agent export?</td>
						<td style="text-align: center;"><input type="radio" name="perm_export_dealer_list" value="all" <?=$agent->perm_export_dealer_list == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_dealer_list" value="agency" <?=$agent->perm_export_dealer_list == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_dealer_list" value="own" <?=$agent->perm_export_dealer_list == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_export_dealer_list" value="none" <?=$agent->perm_export_dealer_list == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td colspan="5"><strong>Locations:</strong></td>
					</tr>
					<tr>
						<td>What locations can this agent see?</td>
						<td style="text-align: center;"><input type="radio" name="perm_location_view" value="all" <?=$agent->perm_location_view == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_view" value="agency" <?=$agent->perm_location_view == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_view" value="own" <?=$agent->perm_location_view == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_view" value="none" <?=$agent->perm_location_view == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What locations can this agent edit?</td>
						<td style="text-align: center;"><input type="radio" name="perm_location_edit" value="all" <?=$agent->perm_location_edit == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_edit" value="agency" <?=$agent->perm_location_edit == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_edit" value="own" <?=$agent->perm_location_edit == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_edit" value="none" <?=$agent->perm_location_edit == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What locations can this agent delete?</td>
						<td style="text-align: center;"><input type="radio" name="perm_location_delete" value="all" <?=$agent->perm_location_delete == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_delete" value="agency" <?=$agent->perm_location_delete == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_delete" value="own" <?=$agent->perm_location_delete == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_location_delete" value="none" <?=$agent->perm_location_delete == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    
                    <tr>
						<td colspan="5"><strong>Notes:</strong></td>
					</tr>
					<tr>
						<td>What agency notes can this agent see?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_view" value="all" <?=$agent->perm_agency_notes_view == "all" ? 'checked="checked"' : ''?>/></td><td></td>
						<!--<td style="text-align: center;"><input type="radio" name="perm_agency_notes_view" value="agency" <?=$agent->perm_agency_notes_view == "agency" ? 'checked="checked"' : ''?>/></td>-->
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_view" value="own" <?=$agent->perm_agency_notes_view == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_view" value="none" <?=$agent->perm_agency_notes_view == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What agency notes can this agent edit?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_edit" value="all" <?=$agent->perm_agency_notes_edit == "all" ? 'checked="checked"' : ''?>/></td><td></td>
						<!--<td style="text-align: center;"><input type="radio" name="perm_agency_notes_edit" value="agency" <?=$agent->perm_agency_notes_edit == "agency" ? 'checked="checked"' : ''?>/></td>-->
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_edit" value="own" <?=$agent->perm_agency_notes_edit == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_edit" value="none" <?=$agent->perm_agency_notes_edit == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What agency notes can this agent delete?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_delete" value="all" <?=$agent->perm_agency_notes_delete == "all" ? 'checked="checked"' : ''?>/></td><td></td>
						<!--<td style="text-align: center;"><input type="radio" name="perm_agency_notes_delete" value="agency" <?=$agent->perm_agency_notes_delete == "agency" ? 'checked="checked"' : ''?>/></td>-->
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_delete" value="own" <?=$agent->perm_agency_notes_delete == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agency_notes_delete" value="none" <?=$agent->perm_agency_notes_delete == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    
                    <tr>
						<td>What agent notes can this agent see?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_view" value="all" <?=$agent->perm_agent_notes_view == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_view" value="agency" <?=$agent->perm_agent_notes_view == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_view" value="own" <?=$agent->perm_agent_notes_view == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_view" value="none" <?=$agent->perm_agent_notes_view == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What agent notes can this agent edit?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_edit" value="all" <?=$agent->perm_agent_notes_edit == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_edit" value="agency" <?=$agent->perm_agent_notes_edit == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_edit" value="own" <?=$agent->perm_agent_notes_edit == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_edit" value="none" <?=$agent->perm_agent_notes_edit == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What agent notes can this agent delete?</td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_delete" value="all" <?=$agent->perm_agent_notes_delete == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_delete" value="agency" <?=$agent->perm_agent_notes_delete == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_delete" value="own" <?=$agent->perm_agent_notes_delete == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_agent_notes_delete" value="none" <?=$agent->perm_agent_notes_delete == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
                    
                    <tr>
						<td>What dealership notes can this agent see?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_view" value="all" <?=$agent->perm_dealer_notes_view == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_view" value="agency" <?=$agent->perm_dealer_notes_view == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_view" value="own" <?=$agent->perm_dealer_notes_view == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_view" value="none" <?=$agent->perm_dealer_notes_view == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealership notes can this agent edit?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_edit" value="all" <?=$agent->perm_dealer_notes_edit == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_edit" value="agency" <?=$agent->perm_dealer_notes_edit == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_edit" value="own" <?=$agent->perm_dealer_notes_edit == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_edit" value="none" <?=$agent->perm_dealer_notes_edit == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
					<tr>
						<td>What dealership notes can this agent delete?</td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_delete" value="all" <?=$agent->perm_dealer_notes_delete == "all" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_delete" value="agency" <?=$agent->perm_dealer_notes_delete == "agency" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_delete" value="own" <?=$agent->perm_dealer_notes_delete == "own" ? 'checked="checked"' : ''?>/></td>
						<td style="text-align: center;"><input type="radio" name="perm_dealer_notes_delete" value="none" <?=$agent->perm_dealer_notes_delete == "none" ? 'checked="checked"' : ''?>/></td>
					</tr>
				</table>
				
				<input type="submit" name="submit" value="Save User Permissions" />
				<input type="reset" value="Revert Changes" />
			
			</form>
			
		<?php
		break;
		case 'delete':
		?>
			
			<form action="<?=site_url('agents/view/' . $agent->id . '?tab=delete')?>" method="post" class="smartform">

				<div class="cryptbox crypterror">Be absolutely sure you want to delete this. Once deleted, it cannot be undone.</div>
				
				<fieldset class="cluster">
					<legend>Agency Information</legend>
					First Name: <?=$agent->first_name?><br />
					Last Name: <?=$agent->last_name?><br />
					Address: <?=$agent->address_street . '; ' . $agent->address_city . ', ' . $agent->address_state . ' ' . $agent->address_zip?><br />
					Phone Number: <?=$agent->phone?><br />
				</fieldset>
				<div class="smartformbuttoncontainer">
					<input type="submit" name="confirm" value="Permanently Delete" class="submitbutton" />
					<input type="submit" name="cancel" value="Cancel" class="submitbutton" />
				</div>

			</form>
			
		<?php
		break;
		case 'notes':
		?>
			
			<p>Special notes about this agent.</p>
			<fieldset class="cluster">
				<legend>Notes</legend>
				<ul>
					<?php foreach($notes as $note) { ?>
						<li>
							<p>
								<div id="original-<?php print $note->id?>" class="this_note"><?php print $note->note;?></div>
								<div id="edit-<?php print $note->id?>" class="hide">
									<form action="<?=site_url('agents/view/' . $agent->id . '?tab=notes&edit='.$note->id)?>" method="post" class="smartform">
				
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
								<?php if($this->LOGGED_IN_USER->perm_agent_notes_edit == 'all' || ($this->LOGGED_IN_USER->perm_agent_notes_edit == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_agent_notes_edit == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
								<a class="edit_note" id="a-<?php print $note->id?>" href="<?=site_url('agents/view/' . $agent->id . '?tab=notes&edit='.$note->id)?>">Edit</a>
								<?php endif; ?>
								   
								<?php if($this->LOGGED_IN_USER->perm_agent_notes_delete == 'all' || ($this->LOGGED_IN_USER->perm_agent_notes_delete == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) || ($this->LOGGED_IN_USER->perm_agent_notes_delete == 'own' && $agent->id == $this->LOGGED_IN_USER->id ) ): ?>
								<a  class="delete_note" href="<?=site_url('agents/view/' . $agent->id . '?tab=notes&delete='.$note->id)?>">Delete</a>
								<?php endif; ?>
						</li>
					<?php } ?>
				</ul>
			</fieldset>
			<form action="<?=site_url('agents/view/' . $agent->id . '?tab=notes')?>" method="post" class="smartform">
				
				<fieldset class="cluster">
					<legend>Agent Notes</legend>
					<span class="moreinfo">If you have anything you would like to remember about this agent? please write it here.</span>
					<textarea class="textbox-area" name="note"><?=isset($_POST['note']) ? $_POST['note'] : ''?></textarea>
					<?=$_POST && strlen($_POST['note']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>
				</fieldset>
				<div class="smartformbuttoncontainer">
					<input type="submit" name="confirm" value="Save Note" class="submitbutton" />
				</div>
	
			</form>
			
		<?php
		break;
		case "index":
		default:
		?>
			
			<fieldset class="cluster">
				<legend>Agent Information</legend>
				First Name: <?=$agent->first_name?><br />
				Last Name: <?=$agent->last_name?><br />
				Address: <?=$agent->address_street . '; ' . $agent->address_city . ', ' . $agent->address_state . ' ' . $agent->address_zip?><br />
				Phone Number: <?=$agent->phone?><br />
			</fieldset>
            
            <fieldset class="cluster">
				<legend>Agency Information</legend>
				Name: <?=$agency->name?><br />
				Tax ID Number: <?=$agency->fein?><br />
				Address: <?=$agency->address_street . '; ' . $agency->address_city . ', ' . $agency->address_state . ' ' . $agency->address_zip?><br />
				Phone Number: <?=$agency->phone?><br />
			</fieldset>
            
 		<?php
		break;
		endswitch;
	?>

</div>
<script type="text/javascript">
$().ready(function() {
	$('div.hide').hide();
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