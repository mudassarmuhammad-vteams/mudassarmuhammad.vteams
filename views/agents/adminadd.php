<h1>Add Agent</h1>

<p>Only Global Administrators can see this page. The alternative way to create a new agent is to have the agent go through the registration process.</p>

<p>You are adding an agent to the agency: <?=$agency->name?>. If this is not correct, use the back button on your browser and do it again.</p>

<form action="<?=site_url('agents/adminadd/' . $agency->id)?>" method="post" class="smartform">

	<fieldset>

		<legend>New Agent Information</legend>

		<ul>

			<li>

				<label for="fein">Agency:</label>

				<p>

					<?=$agency->name?>

				</p>

			</li>

			<li>

				<label for="email">Email</label>

				<p>

					<input id="email" class="input_text" size="45" value="<?=isset($_POST['email']) ? $_POST['email'] : ''?>" name="email" autocomplete="off" />

					<?=$_POST && ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? '<span class="error">Email is invalid.</span>' : ''?>

				</p>

			</li>

			<li>

				<label for="password">Password</label>

				<p>

					<input id="password" class="input_text" size="45" value="<?=isset($_POST['password']) ? $_POST['password'] : ''?>" type="password" name="password" autocomplete="off" />

					<?=$_POST && ! preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['password']) ? '<span class="error">Password is invalid.</span>' : ''?>

					<br />

					<span class="moreinfo">Passwords must be at least 8 characters long, and contain at least one uppercase letter, lowercase letter, and a digit.</span>

				</p>

			</li>

			<li>

				<label for="password_confirmation">Confirm Password</label>

				<p>

					<input id="password_confirmation" class="input_text" size="45" value="<?=isset($_POST['password_confirmation']) ? $_POST['password_confirmation'] : ''?>" type="password" name="password_confirmation" />

					<?=$_POST && $_POST['password'] != $_POST['password_confirmation'] ? '<span class="error">Passwords do not match.</span>' : ''?>

				</p>

			</li>

			<li>

				<label for="first_name">First Name</label>

				<p>

					<input id="first_name" class="input_text" size="45" value="<?=isset($_POST['first_name']) ? $_POST['first_name'] : ''?>" name="first_name" />

					<?=isset($_POST['first_name']) && strlen($_POST['first_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>

				</p>

			</li>

			<li>

				<label for="last_name">Last Name</label>

				<p>

					<input id="last_name" class="input_text" size="45" value="<?=isset($_POST['last_name']) ? $_POST['last_name'] : ''?>" name="last_name" />

					<?=isset($_POST['last_name']) && strlen($_POST['last_name']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>

				</p>

			</li>

			<li>

				<label for="address_street">Street Address</label>

				<p>

					<input id="address_street" class="input_text" size="45" value="<?=isset($_POST['address_street']) ? $_POST['address_street'] : ''?>" name="address_street" />

					<?=isset($_POST['address_street']) && strlen($_POST['address_street']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>

					<br />

					<span class="moreinfo">Enter street number and street, e.g. 1234 Elm Street.</span>

				</p>

			</li>

			<li>

				<label for="address_city">City</label>

				<p>

					<input id="address_city" class="input_text" size="45" value="<?=isset($_POST['address_city']) ? $_POST['address_city'] : ''?>" name="address_city" />

					<?=isset($_POST['address_city']) && strlen($_POST['address_city']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>

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

					<input id="address_zip" class="input_text" size="45" value="<?=isset($_POST['address_zip']) ? $_POST['address_zip'] : ''?>" name="address_zip" />

					<?=isset($_POST['address_zip']) && strlen($_POST['address_zip']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>

				</p>

			</li>

			<li>

				<label for="phone">Phone Number</label>

				<p>

					<input id="phone" class="input_text" size="45" value="<?=isset($_POST['phone']) ? $_POST['phone'] : ''?>" name="phone" />

					<?=isset($_POST['phone']) && strlen($_POST['phone']) == 0 ? '<span class="error">This can not be left blank.</span>' : ''?>

					<br />

					<span class="moreinfo">Please enter in this format: (123) 456 7890.</span>

				</p>

			</li>

		</ul>

	</fieldset>

		

	<div class="smartformbuttoncontainer">

		<input type="submit" name="submit" value="Add Agent" class="submitbutton" />

	</div>

	

</form>