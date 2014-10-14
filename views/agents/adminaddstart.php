<h1>Add Agent</h1>

<p>Only Global Administrators can see this page. The alternative way to create a new agent is to have the agent go through the registration process.</p>

<form action="<?=site_url('agents/adminaddstart')?>" method="post" class="smartform">

	<fieldset>

		<legend>Choose Agency to Add Agent To:</legend>

		<ul>

			<li>

				<label for="fein">Agency:</label>

				<p>

					<select id="agency_id" name="agency_id" class="input_select">
						<?php foreach($agencies as $agency): ?>
						
							<option value="<?=$agency->id?>"><?=$agency->name?></option>
							
						<?php endforeach; ?>
					</select>

				</p>

			</li>

		</ul>

	</fieldset>

		

	<div class="smartformbuttoncontainer">

		<input type="submit" name="submit" value="Next Page" class="submitbutton" />

	</div>

	

</form>