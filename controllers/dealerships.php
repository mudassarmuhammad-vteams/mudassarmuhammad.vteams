<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealerships extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->check_login();
	}
	
	function index(){}
	
	
	function lookupfein()
	{
		if($_POST)
		{
			$dealership = Dealership::find_by_fein($_POST['theFein']);
			
			if($dealership)
			{
				$this->view_data['found'] = TRUE;
				$this->view_data['dealership'] = $dealership;
			}
			else
			{
				$this->view_data['found'] = FALSE;
			}
		}
	}
	
	function view($dealership_id = NULL)
	{
		//load this dealership record (and associated locations) into memory
		$dealership = Dealership::find_by_id($dealership_id);
		$locations = Location::find_all_by_dealership_id($dealership_id);
		$questionaires = Dealershipsquestionnaire::find_all_by_dealership_id($dealership_id); // client's filled questionnaire
		
		$all_users = User::all(array('order' => "first_name ASC, last_name ASC")); //Find find all users having group id 1
		$this->view_data['users_data'] = $all_users;
		
		$ques_data = array();
		foreach($questionaires as $que) {
			$ques_data[$que->q_id]['q_id'] = $que->q_id;
			if($que->attribute == 'boolean') {
				$ques_data[$que->q_id]['boolean'] = $que->value;
			}
			if($que->attribute == 'text') {
				$ques_data[$que->q_id]['text'] = $que->value;
			}
			if($que->attribute == 'a') {
				$ques_data[$que->q_id]['a'] = $que->value;
			}
			if($que->attribute == 'b') {
				$ques_data[$que->q_id]['b'] = $que->value;
			}
			if($que->attribute == 'c') {
				$ques_data[$que->q_id]['c'] = $que->value;
			}
			if($que->attribute == 'd') {
				$ques_data[$que->q_id]['d'] = $que->value;
			}
			if($que->attribute == 'option') {
				$ques_data[$que->q_id]['option'] = $que->value;
			}
		}
		$questionaire = $this->dealership_questionaire();
		
		//Determine what tab to display in the output page based on HTTP GET. If none is set in HTTP GET, default to index.
		$tab = isset($_GET['tab']) ? $_GET['tab'] : '';
		switch($tab)
		{
			case 'locations':
			
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_location_view == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_location_view == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_location_view == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				$this->view_data['tab'] = "locations";
				break;
			case 'edit':
			
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_dealership_edit == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_edit == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_edit == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
			
			
				$this->view_data['tab'] = "edit";
				
				if($_POST)
				{
					if($_POST['inventory_type'] == 'Other' && isset($_POST['inventory_type_other']) && !empty($_POST['inventory_type_other']) ) {
						$inventory_type = $_POST['inventory_type_other'];
						$inventory_condition = true;
					} elseif($_POST['inventory_type'] == 'Other' && isset($_POST['inventory_type_other']) && empty($_POST['inventory_type_other']) ) {
						$inventory_condition = false;
					} else {
						$inventory_type = $_POST['inventory_type'];
						$inventory_condition = true;
					}
					if(preg_match('/^[0-9]{9}$/', $_POST['fein']) &&
						strlen($_POST['effective_date']) > 0 &&
						strlen($_POST['name']) > 0 &&
						strlen($_POST['address_street']) > 0 &&
						strlen($_POST['address_city']) > 0 &&
						strlen($_POST['address_state']) > 0 &&
						strlen($_POST['address_zip']) > 0 &&
						strlen($_POST['contact_name']) > 0 &&
						strlen($_POST['contact_phone']) > 0 &&
						strlen($_POST['contact_email']) > 0 &&
						strlen($_POST['claim_phone']) > 0 &&
						strlen($_POST['claim_email']) > 0 &&
						strlen($_POST['lienholder_name']) > 0 &&
						strlen($_POST['lienholder_address_street']) > 0 &&
						strlen($_POST['lienholder_address_city']) > 0 &&
						strlen($_POST['lienholder_address_state']) > 0 &&
						strlen($_POST['lienholder_address_zip']) > 0 &&
						strlen($_POST['franchises']) > 0 &&
						$inventory_condition == true &&
						strlen($_POST['parking_garage_num_units']) > 0 &&
						strlen($_POST['parking_garage_max_inventory']) > 0 &&
						strlen($_POST['current_insurance_carrier']) > 0 &&
						strlen($_POST['expiring_deductibles']) > 0 &&
						strlen($_POST['expiring_weather_deductibles']) > 0 &&
						is_numeric($_POST['target_premium'])
					){
						$dealership = Dealership::find_by_id($dealership_id);
						$dealership->fein = $_POST['fein'];
						$dealership->effective_date = $_POST['effective_date'];
						$dealership->name = $_POST['name'];
						$dealership->address_street = $_POST['address_street'];
						$dealership->address_city = $_POST['address_city'];
						$dealership->address_state = $_POST['address_state'];
						$dealership->address_zip = $_POST['address_zip'];
						$dealership->contact_name = $_POST['contact_name'];
						$dealership->contact_phone = $_POST['contact_phone'];
						$dealership->contact_email = $_POST['contact_email'];
						$dealership->claim_phone = $_POST['claim_phone'];
						$dealership->claim_email = $_POST['claim_email'];
						$dealership->lienholder_name = $_POST['lienholder_name'];
						$dealership->lienholder_address_street = $_POST['lienholder_address_street'];
						$dealership->lienholder_address_city = $_POST['lienholder_address_city'];
						$dealership->lienholder_address_state = $_POST['lienholder_address_state'];
						$dealership->lienholder_address_zip = $_POST['lienholder_address_zip'];
						$dealership->franchises = $_POST['franchises'];
						$dealership->inventory_type = $inventory_type;
						$dealership->over250k = $_POST['over250k'];
						$dealership->is_allianz_renewal = $_POST['is_allianz_renewal'];
						$dealership->parking_garage_num_units = $_POST['parking_garage_num_units'];
						$dealership->parking_garage_max_inventory = $_POST['parking_garage_max_inventory'];
						$dealership->comprehensive_deductibles = $_POST['comprehensive_deductibles'];
						$dealership->current_insurance_carrier = $_POST['current_insurance_carrier'];
						$dealership->expiring_deductibles = $_POST['expiring_deductibles'];
						$dealership->expiring_weather_deductibles = $_POST['expiring_weather_deductibles'];
						$dealership->target_premium = $_POST['target_premium'];
						$dealership->notes = $_POST['notes'];
						$dealership->save();
						
						if($dealership->id) {
							//before adding new rows we need to remove previouse questions entries
							$prev_questionaires = Dealershipsquestionnaire::find_all_by_dealership_id($dealership->id);
							foreach($prev_questionaires as $prev_question)
							{
								$prev_question->delete();
							}
							
							// all previouse entries are flushed, now adding updated entries...
							$questions_data = array();
							$last_pointer = '';
							foreach ($_POST as $post_key => $value) {
								if (strspn($post_key,'q', 0, 1) == 1) {//we need the key which starts with q
								//if (strpos($post_key,'q') !== false) {
									if (strpos($post_key,'_') !== false) {
										$type = explode('_', $post_key);
										$type = $type[1];
									} else {
										$type = 'boolean';
									}
									$q_no = $this->getNumericValue($post_key);
									//echo $post_key." >>> ".$value."<br>";
									$questions_data[trim($q_no)][$type] = $value; 
								}
							}
							//$this->load->database();
							foreach($questions_data as $qNo => $qDetail) {
								//echo $qNo." ( <pre>".print_r($qDetail, 1)."</pre> )";
								foreach($qDetail as $key => $value){
									$dealerships_questionnaire = new Dealershipsquestionnaire();
									$dealerships_questionnaire->dealership_id = $dealership->id;
									$dealerships_questionnaire->q_id = $qNo;
									$dealerships_questionnaire->attribute = $key;
									$dealerships_questionnaire->value = $value;
									$dealerships_questionnaire->save();
								}
							}
		
							
						} // add  updated questions
						
						$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Dealership has been successfully edited.'));
						redirect('dealerships/view/' . $dealership_id);
					}
				}
				
				break;
			case 'change_agent':
			
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_dealership_agentchange == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_agentchange == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_agentchange == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
			
			
				$this->view_data['tab'] = "change_agent";
				if($_POST)
				{
					$dealership = Dealership::find_by_id($dealership_id);
					$dealership->user_id = $_POST['user_id'];
					$dealership->save();
					
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Dealership agent has been successfully changed.'));
					redirect('dealerships/view/' . $dealership_id);
				}
				
				break;
			case 'delete':
				
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_dealership_delete == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_delete == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_delete == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
			
				$this->view_data['tab'] = "delete";
				
				$dealership = Dealership::find_by_id($dealership_id);
				if(isset($_POST['confirm'])) //confirm deletion
				{
					$locations = Location::find_all_by_dealership_id($dealership->id);
					foreach($locations as $location)
					{
						$location->delete();
					}
					$prev_questionaires = Dealershipsquestionnaire::find_all_by_dealership_id($dealership->id);
					foreach($prev_questionaires as $prev_question)
					{
						$prev_question->delete();
					}
					
					$dealership->delete();
					
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
					redirect();
				}
				
				if(isset($_POST['cancel'])) //Cancel deletion
				{
					redirect('dealerships/view/' . $dealership_id);
				}
				
				break;
			case 'download':
				
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_dealership_downloadxls == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_downloadxls == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) 
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_downloadxls == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				$this->view_data['tab'] = "download";
				
				$dealership = Dealership::find($dealership_id);
				
				$pos = strpos($dealership->effective_date, '/'); 
				if ($pos === false) {
					$retrieved = $dealership->effective_date;
					$date = date('M j, Y', strtotime($retrieved));	
				} else {
					$retrieved = str_replace('/', '-', $dealership->effective_date);
					$date = date('M j, Y', strtotime($retrieved));
				}
				$effective_date = $dealership->effective_date;
				
				$data = array(
					1 => array('This spreadsheet document was created on ' . date('m/d/y') . '.'),
					array('Proprietary information of abc Insurance Facilities'),
					array('18 Augusta Pines Drive, Suite 220W'),
					array('Spring, TX 77389'),
				);
				
				$data[] = array('');
				$data[] = array('Tax ID Number: ', $dealership->fein);
				$data[] = array('Effective Date: ', $effective_date);
				$data[] = array('Dealership Name: ', $dealership->name);
				$data[] = array('Mailing Address: ', $dealership->address_street . '; ' . $dealership->address_city . ', ' . $dealership->address_state . ' ' . $dealership->address_zip);
				$data[] = array('Contact Name: ', $dealership->contact_name);
				$data[] = array('Contact Phone: ', $dealership->contact_phone);
				$data[] = array('Contact Email: ', $dealership->contact_email);
				
				$data[] = array('');
				$data[] = array('Questionnaire');
				foreach($questionaire as $key => $ques) {
					 $q_no = "q".$key;
					 
					 if($ques['boolean'] && !$ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
					
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? "Yes" : 'N/A';
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? "No" : $YNvalue;
						$data[] = array("$key) ".$ques['ques'], $YNvalue);
						
					 } else if($ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
					
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? isset($ques_data[$key]['text']) ? "Yes - ".$ques_data[$key]['text'] : '' : 'N/A';
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? "No" : $YNvalue;
						$data[] = array("$key) ".$ques['ques'], $YNvalue);
						
					 } else if($ques['boolean'] && $ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
					
						$options = " ";
						
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : '' : 'N/A';
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? "No" : $YNvalue;
						foreach ($ques['radios'] as $oKey=>$opt) {
							$selected = isset($ques_data[$key]['option']) && $ques_data[$key]['option'] == $oKey ? $opt : '';
							$options .= " - ".$selected;
						}
						$data[] = array("$key) ".$ques['ques'], $YNvalue." ".$options);
					
					 } else if($ques['boolean'] && !$ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
					
						$options = " ";
						$op = false;
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? 'Yes' : 'N/A';
						$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? "No" : $YNvalue;
						$op = $YNvalue == 'Yes' ? true : false;
						if($op) {
							foreach ($ques['radios'] as $oKey=>$opt) {
								$selected = isset($ques_data[$key]['option']) && $ques_data[$key]['option'] == $oKey ? $opt : '';
								$options .= " - ".$selected;
							}
						}
						$data[] = array("$key) ".$ques['ques'], $YNvalue." ".$options);
					
					 }  else if(!$ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
					
						$text = isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : 'N/A';
						$data[] = array("$key) ".$ques['ques'], $text);
					 }
				}
				if(isset($ques_data['42']['boolean'])) {
					$data_42 = $ques_data['42']['boolean'] == '1' ? 'Yes' : 'No';
					if($data_42 == 'Yes') {
						$value42B = isset($ques_data['42']['b']) && $ques_data['42']['b'] == 1 ? 'Yes' : 'No';
						$value42A = isset($ques_data['42']['a']) ? $ques_data['42']['a'] : '';
						$data_42 .= " 42 a.	WHEN WAS STRUCTURE BUILT? $value42A\n\r";
						$data_42 .= " 42 b.	IF BUILT BEFORE 2000, HAS IT BEEN RETROFITTED TO MEET STATE EARTHQUAKE CODES? $value42B"; 
					}
				} else {
					$data_42 = 'N/A';
				}
				$data[] = array('42) DOES DEALER USES MULTI STORY PARKING STRUCTURE AT ANY LOCATION', $data_42);
				
				$data_43 = 'N/A';
				if(isset($ques_data['43']['option']) ) {
						if($ques_data['43']['option'] == 'a') {
							$data_43 = 'a.	PRECAST CONCRETE SURFACE WITH POURED CONCRETE PILLARS';
						}
						if($ques_data['43']['option'] == 'b') {
							$data_43 = 'b.	POURED CONCRETE 100%';
						}
						if($ques_data['43']['option'] == 'c') {
							$data_43 = "Other: \n".$ques_data['43']['c'];
							
						}
				}
				$data[] = array('43 ) SELECT STRUCTURE\'S CONTRUCTION', $data_43);
				$data_44 = 'N/A';
				if(isset($ques_data['44']['a']) && !empty($ques_data['44']['a']) ) {
					$data_44 = "a. LIMITS: \n".$ques_data['44']['a']."\n";
				}
				if(isset($ques_data['44']['b']) && !empty($ques_data['44']['b']) ) {
					$data_44 .= "b. DEDUCTIBLE: \n". $ques_data['44']['b'];
				}
				$data[] = array('44 )PROVIDE EARTHQUAKE LIMITS AND DEDUCTIBLES ON EXPIRING POLICY ', $data_44);
				
				$data_45a = isset($ques_data['45']['a']) ? $ques_data['45']['a'] : 'N/A';
				$data_45b = isset($ques_data['45']['b']) ? $ques_data['45']['b'] : 'N/A';
				$data_45c = isset($ques_data['45']['c']) ? $ques_data['45']['c'] : 'N/A';
				$data_45d = isset($ques_data['45']['d']) ? $ques_data['45']['d'] : 'N/A';
				$data[] = array('45) Number of people who are allowed to drive company owned vehicle for personal use.', 'Owner	(' . $data_45a . ') Family (' . $data_45b . ') Employees (' . $data_45c . ') 	Other (' . $data_45d . ')');
				
				$data[] = array('');
				$data[] = array('Other Information');
				$data[] = array('Franchises: ', $dealership->franchises);
				$data[] = array('What type of inventory?: ', $dealership->inventory_type);
				$data[] = array('Vehicles in Excess of $250,000? ', ($dealership->over250k ? 'Yes' : 'No'));
				$data[] = array('Is this a abc/xyz renewal? ', ($dealership->is_allianz_renewal ? 'Yes' : 'No'));
				$data[] = array('Number of Units in Parking Garage: ', $dealership->parking_garage_num_units);
				$data[] = array('Maximum Inventory Values in Parking Garage: ', $dealership->parking_garage_max_inventory);
				
				switch($dealership->comprehensive_deductibles)
				{
					case 0:
						$comprehensive_deductibles = 'Comp $1,000 / $5,000 - Coll $1,000';
						break;
					case 1:
						$comprehensive_deductibles = 'Comp $2,500 / $10,000 - Coll $2,500';
						break;
					case 2:
						$comprehensive_deductibles = 'Comp $5,000 / $25,000 - Coll $5,000';
						break;
					case 3:
						$comprehensive_deductibles = 'Comp $10,000 / $50,000 - Col $10,000';
						break;
					default:
						$comprehensive_deductibles = 'None chosen';
						break;
				}
				$data[] = array('Comprehensive and Collision Deductible Choice: ', $comprehensive_deductibles);

				$data[] = array('Current Insurance Carrier: ', $dealership->current_insurance_carrier );
				$data[] = array('Expiring Deductibles: ', $dealership->expiring_deductibles);
				$data[] = array('Expiring Weather Deductibles: ', $dealership->expiring_weather_deductibles);
				$data[] = array('Target Premium: ', $dealership->target_premium);
				$data[] = array('Additional Notes to Underwriter: ', $dealership->notes);

				$data[] = array('');
				$data[] = array('Agent: ', $dealership->user->first_name . ' ' . $dealership->user->last_name);
				$data[] = array('Phone: ', $dealership->user->phone);
				$data[] = array('Email: ', $dealership->user->email);
				$data[] = array('Address: ', $dealership->user->address_street . '; ' . $dealership->user->address_city . ', ' . $dealership->user->address_state . ' ' . $dealership->user->address_zip);
				
				$agency = Agency::find_by_id($dealership->user->agency_id);
				
				$data[] = array('');
				$data[] = array('Agency: ', $agency->name);
				$data[] = array('Tax ID Number: ', $agency->fein);
				$data[] = array('Phone: ', $agency->phone);
				$data[] = array('Address: ', $agency->address_street . '; ' . $agency->address_city . ', ' . $agency->address_state . ' ' . $agency->address_zip);
				$data[] = array('States Licensed: ', $agency->states_licensed);
				
				$data[] = array('');
				$data[] = array('Locations at this Dealership: ', count($dealership->locations));
				foreach($dealership->locations as $location)
				{
					$data[] = array('Location ID: ', $location->id);
					$data[] = array('Name (Doing Business As): ', $location->dba_name);
					$data[] = array('Address: ', $location->address_street . '; ' . $location->address_city . ', ' . $location->address_state . ' ' . $location->address_zip);
					$data[] = array('Tax ID Number: ', $location->fein);
					$data[] = array('Maximum New Coll Values: ', '$' . number_format($location->maximum_new_coll));
					$data[] = array('Maximum Used Coll Values: ', '$' . number_format($location->maximum_used_coll));
					$data[] = array('Average New Coll Values: ', '$' . number_format($location->average_new_coll));
					$data[] = array('Average Used Coll Values: ', '$' . number_format($location->average_used_coll));
					$data[] = array('Demo Coll Values: ', '$' . number_format($location->demo_coll));
					$data[] = array('Shop Rental Coll Values: ', '$' . number_format($location->shop_rental_coll));
					$data[] = array('Maximum New Comp Values: ', '$' . number_format($location->maximum_new_comp));
					$data[] = array('Maximum Used Comp Values: ', '$' . number_format($location->maximum_used_comp));
					$data[] = array('Average New Comp Values: ', '$' . number_format($location->average_new_comp));
					$data[] = array('Average Used Comp Values: ', '$' . number_format($location->average_used_comp));
					$data[] = array('Demo Comp Values: ', '$' . number_format($location->demo_comp));
					$data[] = array('Shop Rental Comp Values: ', '$' . number_format($location->shop_rental_comp));
					$data[] = array('Capacity in Multi Story Parking Structure: ', $location->msps_capacity);
					$data[] = array('Capacity in Single Story Building: ', $location->ssb_capacity);
					$data[] = array('Capacity in Hail Net / Awning Structure: ', $location->hns_capacity);
					$data[] = array('the TOTAL number of vehicles the dealer could protect: ', $location->hail_damage_protection_capacity);
					$data[] = array('How long would it take to move this number of vehicles?: ', $location->move_time);
					$data[] = array('');
				}
				
				$this->load->library('php_excel');
				$this->php_excel->initialize('UTF-8', false, 'Entity Information');
				$this->php_excel->addArray($data);
				$this->php_excel->generateXML('dealership-' . $dealership->name);
				
				die(); //Kill script so download will happen.
				
				break;
			case 'files':
			
				//Logged in user MUST have permission to attach files to this dealership.
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
			
				$this->view_data['tab'] = "files";
				
				//NOTE! Change this! The files to show will change depending on the permission of the user.
				$this->view_data['fileuploads'] = Fileupload::find_all_by_dealership_id($dealership->id);
				
				break;
			case 'email':
			
				//Determine if the logged in user has permission
				$has_permission = FALSE;

				if($this->LOGGED_IN_USER->perm_dealership_emailforreview == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_emailforreview == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_emailforreview == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //most regular agents will not be able to do this.
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				
				
			
				$this->view_data['tab'] = "email";
				
				$dealership = Dealership::find_by_id($dealership_id);
				if(isset($_POST['confirm']))
				{
					//Load email library with desired config settings
					$this->load->library('email');
					$config = array();
					$config['mailtype'] = "html";
					$this->email->initialize($config);
					//$this->email->clear();
					
					$this->email->from('no-reply@mydomain.com', 'My Domain');
					$this->email->to('abc@mydomain.com');

					$this->email->subject('New Dealership; Name: ' . $dealership->name . '; Effective Date: ' . $dealership->effective_date);
					
					$dealership = Dealership::find_by_id($dealership_id);
					$locations = Location::find_all_by_dealership_id($dealership_id);
					$agency = Agency::find_by_id($dealership->user->agency_id);
					$underwriter_detail = '';
					if($agency->underwriter_id) { //If underwrited_id is not zero 
						$underwriter = User::find_by_id($agency->underwriter_id);
						$underwriter_email = $underwriter->email;
						$underwriter_phone = $underwriter->phone;
						$underwriter_name = $underwriter->first_name.' '.$underwriter->last_name;
						$underwriter_address = $underwriter->address_street.', '.$underwriter->address_city.',s '.$underwriter->address_state.' '.$underwriter->address_zip;
						$this->email->cc($underwriter_email);
						$underwriter_detail = " 
						<br>The underwriter will be:
						<br>$underwriter_name
						<br>$underwriter_phone
						<br>$underwriter_email
						<br>$underwriter_address";
					}
					
					$message = '<html><body>A new dealership was submitted for review by ' . $this->LOGGED_IN_USER->first_name . ' ' . $this->LOGGED_IN_USER->last_name . '. 
						The dealership has ' . count($locations) . ' location(s) and is from the following agency: ' . $agency->name . '. 
						Click <a href="http://www.mydomain.com/dealerships/view/' . $dealership->id . '">here</a> to view that dealership within the our application.
						<a href="http://www.mydomain.com/dealerships/view/' . $dealership->id . '?tab=download">Here</a> is a direct link to download the excel spreadsheet.
						NOTE: You must be logged in as a global administrator.<br><br>Sincerely,<br>ABC Insurance Facilities</body></html>';
					//NOTE: For some reason, using site_url() on the links above in the email message don't work properly? Not sure why. So I put the full URL in. -NSM 2/7/2012
					$this->email->message($message);
					$this->email->send();
					
					//to send another email, we need to clear previous email data
					$this->email->clear();

					//Now send a convirmation email to the Agent.
					$this->email->from('no-reply@mydomain.com', 'My Domain');
					$this->email->to($this->LOGGED_IN_USER->email);
					$this->email->subject('Dealership Confirmation');
					$message = '<html><body><p>' . $this->LOGGED_IN_USER->first_name . ',</p>This email is to confirm that we have received the dealership you submitted, and it is now under review.
						The dealership submitted is ' . $dealership->name . ' and has ' . count($locations) . ' location(s) and is from the following agency: ' . $agency->name . '. 
						Click <a href="http://www.mydomain.com/dealerships/view/' . $dealership->id . '">here</a> to view that dealership within the Our application.
						NOTE: You must be logged in to see it.<br>
						'.$underwriter_detail.'
					<br>Thank you for submitting the dealership to us.<br><br>Sincerely,<br>ABC Insurance Facilities</body></html>';
					$this->email->message($message);
					$this->email->send();
					$this->email->clear();
					
					$checklist = Checklist::find_by_dealership_id($dealership->id);
					if(!empty($checklist)) //Delete checklist to start fresh review process
						$checklist->delete();
					
					$dealership->renewal_sent = '0'; //update renewal_sent in dealership to include this dealership in renewal notifiction cron job.
					$dealership->save();
					
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
					redirect('dealerships/view/' . $dealership_id);
				}
				
				if(isset($_POST['cancel']))
				{
					redirect('dealerships/view/' . $dealership_id);
				}
				
				break;
			case 'checklist':
			
				//Determine if the logged in user has permission
				$has_permission = FALSE;

				if($this->LOGGED_IN_USER->perm_dealership_checklist == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_checklist == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_checklist == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //most regular agents will not be able to do this.
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				
				
			
				$this->view_data['tab'] = "checklist";
				
				$checklist = Checklist::find_by_dealership_id($dealership->id);
				$this->view_data['checklist'] = $checklist;
				if(isset($_POST['confirm']))
				{
					if(!empty($checklist)) //Delete previous checklist for this dealership to replace it with latest POST
						$checklist->delete();
					
					$checklist = new Checklist();
					$checklist->dealership_id = $dealership->id;
					/////SETUP
					$checklist->app_received = isset($_POST['app_received']) ? $_POST['app_received'] : 0;
					$checklist->folder_setup = isset($_POST['folder_setup']) ? $_POST['folder_setup'] : 0;
					$checklist->flood_maps = isset($_POST['flood_maps']) ? $_POST['flood_maps'] : 0;
					$checklist->google_earth_check_for_locations = isset($_POST['google_earth_check_for_locations']) ? $_POST['google_earth_check_for_locations'] : 0;
					$checklist->work_in_progress = isset($_POST['work_in_progress']) ? $_POST['work_in_progress'] : 0;
					$checklist->enter_values_in_rating_worksheet = isset($_POST['enter_values_in_rating_worksheet']) ? $_POST['enter_values_in_rating_worksheet'] : 0;
					$checklist->losses_on_rating_worksheet = isset($_POST['losses_on_rating_worksheet']) ? $_POST['losses_on_rating_worksheet'] : 0;
					$checklist->file_given_to_uw = isset($_POST['file_given_to_uw']) ? $_POST['file_given_to_uw'] : 0;
					/////UNDERWRITING & QUOTING
					$checklist->review_email_to_lex = isset($_POST['review_email_to_lex']) ? $_POST['review_email_to_lex'] : 0;
					$checklist->validate_and_enter_losses = isset($_POST['validate_and_enter_losses']) ? $_POST['validate_and_enter_losses'] : 0;
					$checklist->flood_review = isset($_POST['flood_review']) ? $_POST['flood_review'] : 0;
					$checklist->deductible_and_limits_checked = isset($_POST['deductible_and_limits_checked']) ? $_POST['deductible_and_limits_checked'] : 0;
					$checklist->develop_select_rate = isset($_POST['develop_select_rate']) ? $_POST['develop_select_rate'] : 0;
					$checklist->save_quote_as_pdf = isset($_POST['save_quote_as_pdf']) ? $_POST['save_quote_as_pdf'] : 0;
					$checklist->email_quote_to_agent = isset($_POST['email_quote_to_agent']) ? $_POST['email_quote_to_agent'] : 0;
					/////ADJUST QUOTE
					$checklist->agent_feedback_and_quote_adjusted = isset($_POST['agent_feedback_and_quote_adjusted']) ? $_POST['agent_feedback_and_quote_adjusted'] : 0;
					$checklist->email_back_to_agent = isset($_POST['email_back_to_agent']) ? $_POST['email_back_to_agent'] : 0;
					/////BIND
					$checklist->email_fax_bind_req_rec = isset($_POST['email_fax_bind_req_rec']) ? $_POST['email_fax_bind_req_rec'] : 0;
					$checklist->binding_effective_date = isset($_POST['binding_effective_date']) ? $_POST['binding_effective_date'] : '0000-00-00 00:00:00';
					$checklist->make_cert_ln_mr_folder = isset($_POST['make_cert_ln_mr_folder']) ? $_POST['make_cert_ln_mr_folder'] : 0;
					$checklist->validate_cert_against_rating_worksheet = isset($_POST['validate_cert_against_rating_worksheet']) ? $_POST['validate_cert_against_rating_worksheet'] : 0;
					$checklist->save_cert_excel_copy_in_cert_folder = isset($_POST['save_cert_excel_copy_in_cert_folder']) ? $_POST['save_cert_excel_copy_in_cert_folder'] : 0;
					$checklist->save_monthly_report_to_idrive = isset($_POST['save_monthly_report_to_idrive']) ? $_POST['save_monthly_report_to_idrive'] : 0;
					$checklist->save_loss_notic_to_idrive = isset($_POST['save_loss_notic_to_idrive']) ? $_POST['save_loss_notic_to_idrive'] : 0;
					$checklist->email_docs_to_agent = isset($_POST['email_docs_to_agent']) ? $_POST['email_docs_to_agent'] : 0;
					$checklist->email_sold_notice = isset($_POST['email_sold_notice']) ? $_POST['email_sold_notice'] : 0;
					//////POST BINDING
					$checklist->enter_data_into_db = isset($_POST['enter_data_into_db']) ? $_POST['enter_data_into_db'] : 0;
					$checklist->scan_docs_into_file = isset($_POST['scan_docs_into_file']) ? $_POST['scan_docs_into_file'] : 0;
					
					$checklist->updated_at = date('Y-m-d h:i:s');
					$checklist->save();
					
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
					redirect('dealerships/view/' . $dealership_id);
					//process checklist
				}
				
				if(isset($_POST['cancel']))
				{
					redirect('dealerships/view/' . $dealership_id);
				}
				
				break;
			case 'notes':
			
				//Determine if the logged in user has permission
				$has_permission = FALSE;

				if($this->LOGGED_IN_USER->perm_dealer_notes_view == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealer_notes_view == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealer_notes_view == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //most regular agents will not be able to do this.
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				
				
			
				$this->view_data['tab'] = "notes";
				
				$sql = "SELECT * FROM notes WHERE parent_id = '".$dealership->id."' and type = 'Dealer' ORDER BY created_at DESC";
				$notes  = Note::find_by_sql($sql); //get the full list
				$this->view_data['notes'] = $notes;
				
				if(isset($_POST['confirm']))
				{
					if(strlen($_POST['note']) > 0 ) {
						$notes = new Note();
						$notes->parent_id = $dealership->id;
						$notes->user_id = $this->LOGGED_IN_USER->id;
						$notes->type = 'Dealer';
						$notes->note = $_POST['note'];
						$notes->created_at = date('Y-m-d h:i:s');
						$notes->updated_at = date('Y-m-d h:i:s');
						$notes->save();
						
						$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
						redirect('dealerships/view/' . $dealership_id.'?tab=notes');
					}
				}
				if(isset($_POST['edit']))
				{
					$id = $_GET['edit'];
					$notes = Note::find_by_id($id);
					$notes->note = $_POST['note'.$id];
					$notes->updated_at = date('Y-m-d h:i:s');
					$notes->save();
						
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Notes has been successfully updated.'));
					redirect('dealerships/view/' . $dealership_id.'?tab=notes');
				}
				if(isset($_GET['delete']))
				{
					$id = $_GET['delete'];
					//Determine if the logged in user has permission
					$edit_permission = FALSE;
	
					if($this->LOGGED_IN_USER->perm_dealer_notes_delete == 'all') {
						$edit_permission = TRUE;
						
					}
					
					if($this->LOGGED_IN_USER->perm_dealer_notes_delete == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) {
						$edit_permission = TRUE;
					}
						
					if($this->LOGGED_IN_USER->perm_dealer_notes_delete == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) {
						$edit_permission = TRUE;
					}
						
					if(! $edit_permission) { //If user doesn't have permission, restrict his access to be here.
						$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
						redirect();
					}
					
					$notes = Note::find_by_id($id);
					$notes->delete();
					
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Note successfully deleted.'));
					redirect('dealerships/view/' . $dealership_id.'?tab=notes');
				}
				
				if(isset($_POST['cancel']))
				{
					redirect('dealerships/view/' . $dealership_id .'?tab=notes');
				}
				
				break;
			default: //view this dealership
			
				/**Determine if the logged in user has permission to view this dealership
				 */
				$has_permission = FALSE;

				if($this->LOGGED_IN_USER->perm_dealership_view == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_view == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_view == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
			
				$this->view_data['tab'] = "index";
				/* -------TO SHOW THE PROGRESS OF DEALERSHIP REVIEW ---------- */
				$checklist = Checklist::find_by_dealership_id($dealership->id);
				$total_score = 0;
				$perc_done = 0;
				if($checklist) {
					/////SETUP
					$total_checks = 15;	
					$total_score = $checklist->app_received + $checklist->folder_setup + $checklist->flood_maps + $checklist->google_earth_check_for_locations + $checklist->work_in_progress + $checklist->enter_values_in_rating_worksheet + $checklist->losses_on_rating_worksheet + $checklist->file_given_to_uw + $checklist->review_email_to_lex + $checklist->validate_and_enter_losses + $checklist->flood_review + $checklist->deductible_and_limits_checked + $checklist->develop_select_rate + $checklist->save_quote_as_pdf + $checklist->email_quote_to_agent;
					$perc_done = ($total_score/$total_checks) * 100;
				}
				$this->view_data['perc'] = $perc_done;
				/* --------///-----------------*/
				
				break;
		}
		
		//$ques = Dealershipsquestionnaire::find_by_q_id(1);
		
		//print_r($questionaire);
		$this->view_data['questionaire'] = $questionaire;
		$this->view_data['ques_data'] = $ques_data;
		//Send information about this dealership and associated locations into view_data so it can be accessed by the view.
		$this->view_data['dealership'] = $dealership;
		$this->view_data['locations'] = $locations;
		
		
	}
	
	/**
	 * Add a new dealership into the database using information sent from POST form submission.
	 * If no form is submitted, nothing will happen here and the "add" view will display as usual.
	 * If POST data is submitted from the form submission, this function will attempt to validate it.
	 *   - If everything validates correctly, it will be sent to the model and added to the database, and user will be redirected
	 *   - If there are errors, the new dealership will not be added and the form to add a new dealership will display again with the errors
	 */
	function add($fein)
	{
	
		if(! preg_match('/^[0-9]{9}$/', $fein)) //if the fein provided isn't 9 digits long
		{
			redirect('dealerships/addfirststep');
		}
		
		$dealership = Dealership::find_by_fein($fein);
		if($dealership) //if the fein provided is already associated with a dealership
		{
			$dealership_created_at = strtotime($dealership->created_at);
			if( time() - $dealership_created_at < (60 * 60 * 24 * 60)  ) //dealership that has this Tax ID was created less than 60 days ago
			{
				redirect('dealerships/addfirststep');
			}
			
		}
		
		$this->view_data['fein'] = $fein;
		$questionaire = $this->dealership_questionaire();
		$this->view_data['questionaire'] = $questionaire;

		
		if($_POST)
		{
			if($_POST['inventory_type'] == 'Other' && isset($_POST['inventory_type_other']) && !empty($_POST['inventory_type_other']) ) {
				$inventory_type = $_POST['inventory_type_other'];
				$inventory_condition = true;
			} elseif($_POST['inventory_type'] == 'Other' && isset($_POST['inventory_type_other']) && empty($_POST['inventory_type_other']) ) {
				$inventory_condition = false;
			} else {
				$inventory_type = $_POST['inventory_type'];
				$inventory_condition = true;
			}
			if(preg_match('/^[0-9]{9}$/', $_POST['fein']) &&
				strlen($_POST['effective_date']) > 0 &&
				strlen($_POST['name']) > 0 &&
				strlen($_POST['address_street']) > 0 &&
				strlen($_POST['address_city']) > 0 &&
				strlen($_POST['address_state']) > 0 &&
				strlen($_POST['address_zip']) > 0 &&
				strlen($_POST['contact_name']) > 0 &&
				strlen($_POST['contact_phone']) > 0 &&
				strlen($_POST['contact_email']) > 0 &&
				strlen($_POST['claim_phone']) > 0 &&
				strlen($_POST['claim_email']) > 0 &&
				strlen($_POST['lienholder_name']) > 0 &&
				strlen($_POST['lienholder_address_street']) > 0 &&
				strlen($_POST['lienholder_address_city']) > 0 &&
				strlen($_POST['lienholder_address_state']) > 0 &&
				strlen($_POST['lienholder_address_zip']) > 0 &&
				strlen($_POST['franchises']) > 0 &&
				$inventory_condition == true &&
				strlen($_POST['parking_garage_num_units']) > 0 &&
				strlen($_POST['parking_garage_max_inventory']) > 0 &&
				strlen($_POST['current_insurance_carrier']) > 0 &&
				strlen($_POST['expiring_deductibles']) > 0 &&
				strlen($_POST['expiring_weather_deductibles']) > 0 &&
				is_numeric($_POST['target_premium'])
			){
				$dealership = new Dealership();
				$dealership->user_id = $this->LOGGED_IN_USER->id;
				$dealership->fein = $_POST['fein'];
				$dealership->effective_date = $_POST['effective_date'];
				$dealership->name = $_POST['name'];
				$dealership->address_street = $_POST['address_street'];
				$dealership->address_city = $_POST['address_city'];
				$dealership->address_state = $_POST['address_state'];
				$dealership->address_zip = $_POST['address_zip'];
				$dealership->contact_name = $_POST['contact_name'];
				$dealership->contact_phone = $_POST['contact_phone'];
				$dealership->contact_email = $_POST['contact_email'];
				$dealership->claim_phone = $_POST['claim_phone'];
				$dealership->claim_email = $_POST['claim_email'];
				$dealership->lienholder_name = $_POST['lienholder_name'];
				$dealership->lienholder_address_street = $_POST['lienholder_address_street'];
				$dealership->lienholder_address_city = $_POST['lienholder_address_city'];
				$dealership->lienholder_address_state = $_POST['lienholder_address_state'];
				$dealership->lienholder_address_zip = $_POST['lienholder_address_zip'];
				$dealership->franchises = $_POST['franchises'];
				$dealership->inventory_type = $inventory_type;
				$dealership->over250k = $_POST['over250k'];
				$dealership->is_allianz_renewal = $_POST['is_allianz_renewal'];
				$dealership->parking_garage_num_units = $_POST['parking_garage_num_units'];
				$dealership->parking_garage_max_inventory = $_POST['parking_garage_max_inventory'];
				$dealership->current_insurance_carrier = $_POST['current_insurance_carrier'];
				$dealership->expiring_deductibles = $_POST['expiring_deductibles'];
				$dealership->expiring_weather_deductibles = $_POST['expiring_weather_deductibles'];
				$dealership->target_premium = $_POST['target_premium'];
				$dealership->notes = $_POST['notes'];
				$dealership->save();
				
				if($dealership->id) { //after saving dealership we are going to save dealership questionnaire
					$questions_data = array();
					$last_pointer = '';
					foreach ($_POST as $post_key => $value) {
						//strspn($underwriter, "Tr", 0, 2);
						if (strspn($post_key,'q', 0, 1) == 1) {//we need the key which starts with q
						//if (strpos($post_key,'q') !== false) { //we need the values where the key containes q in it
							if (strpos($post_key,'_') !== false) {
								$type = explode('_', $post_key);
								$type = $type[1];
							} else {
								$type = 'boolean';
							}
							$q_no = $this->getNumericValue($post_key);
							$questions_data[trim($q_no)][$type] = $value; 
						}
					}
					foreach($questions_data as $qNo => $qDetail) {
						foreach($qDetail as $key => $value){
							$dealerships_questionnaire = new Dealershipsquestionnaire();
							$dealerships_questionnaire->dealership_id = $dealership->id;
							$dealerships_questionnaire->q_id = $qNo;
							$dealerships_questionnaire->attribute = $key;
							$dealerships_questionnaire->value = $value;
							$dealerships_questionnaire->save();
						}
					}

					
				}
				
				$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
				redirect('dealerships/view/' . $dealership->id);
			}
		}
		
	}
	
	/**The first step of adding a new dealership is to get the Tax ID Number. The tax ID number must be valid or else the agent can not proceed to the next screen.
	 * A tax ID number can be invalid for 1 of the 2 following reasons
	 * 1) It's not 9 digits long
	 * 2) It's already in use by another agent.
	 */
	function addfirststep()
	{
		if($_POST)
		{
			if(preg_match('/^[0-9]{9}$/', $_POST['fein']))
			{
				//fein valid so now check to ensure that it's not already in use by another agent/dealership
				
				$dealership = Dealership::find_by_fein($_POST['fein']);
				
				if($dealership) //dealership already exists. can't add this record
				{
					$dealership_created_at = strtotime($dealership->created_at);
					if( time() - $dealership_created_at < (60 * 60 * 24 * 60)  ) //dealership that has this Tax ID was created less than 60 days ago
					{
						$this->view_data['already_exists'] = TRUE;
					}
					else //the dealership with this tax ID was created more than 60 days ago
					{
						redirect('dealerships/add/' . $_POST['fein']);
					}
					
				}
				else //no dealership exists with this TAX ID.
				{
					redirect('dealerships/add/' . $_POST['fein']);
				}
			}
			else
			{
				$this->view_data['not_valid'] = TRUE; //not valid so tell the agent on the next screen
			}
			

		}
	}
	
	/**
	 * Display the printer friendly version of a dealership record.
	 * It will be outputted on a different layout than the usual one, so that it is more printer friendly.
	 * Permission MUST be checked for first to ensure the logged in user has permission to view this dealership
	 * @param $dealership_id ID of dealership to print information from.
	 */
	function printable($dealership_id)
	{
		//Load this dealership and associated locations into memory
		$dealership = Dealership::find_by_id($dealership_id);
		$locations = Location::find_all_by_dealership_id($dealership_id);
		//fetch question answer data
		$questionaires = Dealershipsquestionnaire::find_all_by_dealership_id($dealership_id);
		
		$ques_data = array();
		foreach($questionaires as $que) {
			//$ques = (array)$ques;
			$ques_data[$que->q_id]['q_id'] = $que->q_id;
			if($que->attribute == 'boolean') {
				$ques_data[$que->q_id]['boolean'] = $que->value;
			}
			if($que->attribute == 'text') {
				$ques_data[$que->q_id]['text'] = $que->value;
			}
			if($que->attribute == 'a') {
				$ques_data[$que->q_id]['a'] = $que->value;
			}
			if($que->attribute == 'b') {
				$ques_data[$que->q_id]['b'] = $que->value;
			}
			if($que->attribute == 'c') {
				$ques_data[$que->q_id]['c'] = $que->value;
			}
			if($que->attribute == 'd') {
				$ques_data[$que->q_id]['d'] = $que->value;
			}
			if($que->attribute == 'option') {
				$ques_data[$que->q_id]['option'] = $que->value;
			}
		}
		//to add questions array
		$questionaire = $this->dealership_questionaire();
		
		/**Determine if the logged in user has permission to view this dealership
		 */
		$has_permission = FALSE;

		if($this->LOGGED_IN_USER->perm_dealership_print == 'all') //Global administrators have all permissions
			$has_permission = TRUE;
		
		if($this->LOGGED_IN_USER->perm_dealership_print == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
			$has_permission = TRUE;
			
		if($this->LOGGED_IN_USER->perm_dealership_print == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
			$has_permission = TRUE;
			
		if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
			$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
			redirect();
		}
	
		$this->view_data['questionaire'] = $questionaire;
		$this->view_data['ques_data'] = $ques_data;
		$this->view_data['dealership'] = $dealership;
		$this->view_data['locations'] = $locations;
		$this->layout_view = 'blank';
	}
	
	/**
	 * Upload a new file to the server. The new file will be associated with the corresponding dealership.
	 * @param @dealership_id ID of dealership this file will be attached to
	 */
	function do_upload($dealership_id)
	{
		//Load dealership into memory
		$dealership = Dealership::find_by_id($dealership_id);
		
		
		//Logged in user MUST have permission to attach files to this dealership.
		$has_permission = FALSE;
		
		if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'all') //Global administrators have all permissions
			$has_permission = TRUE;
		
		if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
			$has_permission = TRUE;
			
		if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
			$has_permission = TRUE;
			
		if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
			$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
			redirect();
		}
		
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|doc|docx|pdf|jpg|jpeg|tif|bmp|gif|png';
		$config['max_size']	= '4096'; //in kilobytes
		$config['max_width']  = '2048';
		$config['max_height']  = '1536';
		$config['encrypt_name']  = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) //errors with upload
		{
			$error = array('error' => $this->upload->display_errors());
			
			$this->session->set_flashdata('error', $error);
			
			redirect('dealerships/view/' . $dealership->id . '?tab=files');
		}
		else //file upload success. add entry to database. then redirect.
		{
			$success = array('upload_data' => $this->upload->data()); //Get info about the newly uploaded file
			
			//Add entry about this file to the database
			$fileupload = new Fileupload();
			$fileupload->user_id = $this->LOGGED_IN_USER->id;
			$fileupload->dealership_id = $dealership->id;
			$fileupload->orig_filename = $success['upload_data']['orig_name'];
			$fileupload->file_name = $success['upload_data']['file_name'];
			$fileupload->save();
			
			$this->session->set_flashdata('success', $success); //Add info about this file upload to flashdata to be displayed after the redirect
			
			redirect('dealerships/view/' . $dealership->id . '?tab=files'); //redirect to file upload page for this dealership
		}
	}
	
	/**
	 * Delete a file that was previously uploaded by the "attach files" tab, then redirect back to that tab.
	 * @param $file_id ID corresponding to the Fileupload object to be deleted.
	 */
	function deletefile($file_id = NULL)
	{
		$fileupload = Fileupload::find_by_id($file_id); //Load the Fileupload object into memory based on the ID provided.
		
		if(! $fileupload) //If file can't be found, gracefully redirect to main page.
			redirect();
		
			//Logged in user MUST have permission to attach files to this dealership.
			$has_permission = FALSE;
			
			if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'all') //Global administrators have all permissions
				$has_permission = TRUE;
			
			if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'agency' && $dealership->user->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
				$has_permission = TRUE;
				
			if($this->LOGGED_IN_USER->perm_dealership_attachfiles == 'own' && $dealership->user->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
				$has_permission = TRUE;
				
			if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
				$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
				redirect();
			}
		
		$fileupload->delete();
		
		//$this->session->set_flashdata('success', 'This file has been successfully deleted.'); //Add info about this file upload to flashdata to be displayed after the redirect
		redirect('dealerships/view/' . $fileupload->dealership_id . '?tab=files');
		
	}
	
	/**
	 * Questions to show on dealership form.
	 * @param $q_no Question number to print on add dealership form.
	 */
	function dealership_questionaire($q_no = false)
	{
		$questions = array(
			"1" => array('ques' => 'IS THIS DEALER FRANCHISED?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"2" => array('ques' => 'HOW LONG HAS THE DEALERSHIP OWNER BEEN IN BUSINESS?', 'boolean'=> false, 'detail' => true, 'radios' => false, 
			'checkboxes' => false, 'msg' => '(must be a franchised auto dealer)'),
			"3" => array('ques' => 'DOES THE DEALER DO ANY MANUFACTURING OR UPFITTING OF VEHICLES?', 'boolean'=> true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"4" => array('ques' => 'ARE CUSTOMERS ALLOWED TO TEST DRIVE VEHICLES OVERNIGHT?', 'boolean'=> true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"5" => array('ques' => 'DOES THE SALES STAFF ACCOMPANY PROSPECTIVE CUSTOMERS ON TEST DRIVES? PERCENTAGE OF TIME?', 'boolean'=> true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"6" => array('ques' => 'ARE CUSTOMERS DRIVERS LICENSE VERIFIED FOR VALIDITY AND COPIED PRIOR TO TEST DRIVES?', 'boolean'=> true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"7" => array('ques' => 'ARE THE WORKING SET OF KEYS MAINTAINED IN THE CONTROL OF THE SALESMAN DURING ALL SALES TRANSACTIONS AND TEST DRIVES?', 'boolean'=>true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"8" => array('ques' => 'ARE MOTOR VEHICLE RECORDS AND OR DRIVERS LICENSES OBTAINED ON EMPLOYEES AND REVIEWED ON A YEARLY BASIS?', 'boolean'=> true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"9" => array('ques' => 'DOES THE DEALER FURNISH AUTOMOBILES TO NON-EMPOYEES SUCH AS DEMOS OR CUSTOMER LOANERS?', 'boolean'=> true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"10" => array('ques' => 'DOES THE DEALER PROVIDE DEMONSTRATORS TO EMPLOYEES?  HOW MANY?', 'boolean' => true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"11" => array('ques' => 'IS THE DEALERSHIP EQUIPPED WITH AN ALARM SYSTEM? ', 'boolean' => true, 'detail' => false, 'radios' => array('a' => 'LOCAL', 'b' => 'CENTRAL', 'c' => 'STATION'), 'checkboxes' => false, 'msg' => false),
			"12" => array('ques' => 'SECURITY SYSTEM ON PREMISES?', 'boolean' => true, 'detail' => false, 'radios' => array('a'=>'24 HOURS', 'b'=>'AFTER HOURS', 'c'=>'DRIVE BY SERVICE'), 'checkboxes' => false, 'msg' => false),
			"13" => array('ques' => 'PERIMETER LIGHTING?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"14" => array('ques' => 'WORKING SURVEILLANCE CAMERAS?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"15" => array('ques' => 'MOTION SENSERS ON THE EXTERIOR OF THE DEALERSHIP?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"16" => array('ques' => 'IS LOT FULLY ENCLOSED AFTER BUSINESS HOURS?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"17" => array('ques' => 'ARE GATES LOCKED WHEN BUSINESS IS CLOSED?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"18" => array('ques' => 'IS ON PREMISES SECURITY SERVICE USED? <br> a. IF SO, WHAT ARE THE HOURS?', 'boolean' => true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"19" => array('ques' => 'LOJACK OR BOOMERANG ANTI THEFT SYSTEMS USED? <br> OTHER:', 'boolean' => true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"20" => array('ques' => 'ARE LOCK BOXES USED? <br>a. IF SO ARE KEYS REMOVED FROM BOXES AT NIGHT?', 'boolean' => true, 'detail' => false, 'radios' => array('a' => 'Yes', 'b' => 'NO'), 'checkboxes' => false, 'msg' => false),
			"21" => array('ques' => 'WINDOW ETCHING?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"22" => array('ques' => 'CAN THE PUBLIC ACCESS KEYS TO INVENTORIED VEHICLES?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"23" => array('ques' => 'ARE DESIGNATED INDIVIDUALS GIVEN THE RESPONSIBILITY TO DISPENSE KEYS?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"24" => array('ques' => 'ARE ELECTRONIC KEY MACHINE REPORTS / LOGS REVIEWED AND RECONCILED AT THE END OF EACH BUSINESS DAY?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"25" => array('ques' => 'DESCRIBE KEY SECURITY, KEY MACHINE MODLE ETC... HOW ARE KEYS RETURNED TO CABINET?  WHO IS RESPONSIBLE?', 'boolean' => false, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"26" => array('ques' => 'HAS ANY PART OF YOUR DEALERSHIP OR STORAGE LOTS EVER BEEN FLOODED?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"27" => array('ques' => 'IS YOUR DEALERSHIP LOCATED IN A 100 YEAR FLOOD PLAIN?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"28" => array('ques' => 'IS THERE A FLOOD PROTECTION PLAN IN PLACE? (ATTACH)', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"29" => array('ques' => 'ARE HAIL NETS USED?  IF SO, AGE OF CONSTRUCTION OR LAST UPDATED? ', 'boolean' => true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"30" => array('ques' => 'IS THERE A HAIL PROTECTION PLAN IN PLACE?(ATTACH)', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"31" => array('ques' => 'ARE ANY OF YOUR NEW / USED INVENTORY VEHICLES PARKED UNDER PROTECTIVE COVER?  PERCENTAGE?', 'boolean' => true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"32" => array('ques' => 'PERCENTAGE OF UNITS IN PARKING GARAGE ON AVERAGE?', 'boolean' => false, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"33" => array('ques' => 'PERCENTAGE OF UNITS IN PARKING GARAGE MAX?', 'boolean' => false, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"34" => array('ques' => 'IS THERE A FORMALIZED LOSS PREVENTION PROGRAM THAT HAS BEEN INSTITUTED AT THE DEALERSHIP?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"35" => array('ques' => 'ARE VEHICLE HISTORY REPORTS OBTAINED FOR ALL USED AUTOS PURCHASED OR TAKEN IN TRADE? PERCENTAGE OF TIME:', 'boolean' => true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"36" => array('ques' => 'ARE ALL CHECKS, DRAFTS AND FINANCIAL INSTRUMENTS VERIFIED PRIOR TO VEHICLE DELIVERY?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"37" => array('ques' => 'IS THERE AN IDENTITY THEFT PROCEDURE IN PLACE?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"38" => array('ques' => 'WHAT IS THE MAXIMUM VALUE OF ANY ONE VEHICLE?', 'boolean' => false, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"39" => array('ques' => 'DOES DEALER PROVIDE SHOP LOANERS OR SHOP RENTALS? <br>a. IF SO HOW MANY VEHICLES ARE DESIGNATED FOR SHOP LOANER OR SHOP RENTAL?
', 'boolean' => true, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"40" => array('ques' => 'FOR EACH LOCATION: DESCRIBE EXTENT OF FENCE, POSTS, CHAINS, BARRICADES AND GATES AROUND PREMISES:', 'boolean' => false, 'detail' => true, 'radios' => false, 'checkboxes' => false, 'msg' => false),
			"41" => array('ques' => 'DOES DEALER OWN A BODY SHOP?', 'boolean' => true, 'detail' => false, 'radios' => false, 'checkboxes' => false, 'msg' => false)
		);
		
		if($q_no) {
			return $questions[$q_no];
		}
		return $questions;
	}
	
	/*
	 * Fetch numeric values from a given string
	 * @param: $string required to fetch numeric values in it
	 * @return: Numeric string
	 */
	function getNumericValue($string) {
		$chars = '';
		$nums = '';
		for ($index=0; $index<strlen($string); $index++) { 
			if( ctype_digit($string[$index]) ){
				$nums .= $string[$index];
			 }
		} 
		return $nums;
	}
	
}