<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agents extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->check_login();
	}
	
	function index(){}
	
	function view($agent_id = NULL)
	{
		$agent = User::find_by_id($agent_id);
		/* There are 3 reasons why the Agent might not be found from the ID provided:
		 * 1. No agent exists that corresponds to the ID provided
		 * 2. The agent that corresponds to the given ID was deleted (in which case that Agent will not exist)
		 * 3. The ID provided was invalid, such as if a string was passed or if no ID was provided (in which case it would be NULL)
		 * To best handle this, set an error message and redirect to home page
		 */
		if(!$agent)
		{
			$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'We could not find an agent with this ID.'));
			redirect();
		}
			
		$this->view_data['agent'] = $agent;
		$this->view_data['dealerships'] = Dealership::find_all_by_user_id($agent->id);
		
		if($agent_id === NULL)
		{
			$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'We could not find an agent with this ID.'));
			redirect();
		}
		
	
		//Determine what tab to display in the output page based on HTTP GET. If none is set in HTTP GET, default to index.
		$tab = isset($_GET['tab']) ? $_GET['tab'] : '';
		switch($tab)
		{
			case 'dealerships':
			
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_dealership_view == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_dealership_view == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_dealership_view == 'own' && $agent->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
			
				$this->view_data['tab'] = "dealerships";
				break;
				
			case 'export_dealerships':
			
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_export_dealer_list == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_export_dealer_list == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_export_dealer_list == 'own' && $agent->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
			
				$this->view_data['tab'] = "export_dealerships";
				
				$dealerships = Dealership::find_all_by_user_id($agent->id);
				
				$data = array(
					1 => array('This spreadsheet document was created on ' . date('m/d/y') . '.'),
					array('Proprietary information of ABC/XYZ Insurance Facilities'),
					array('18 Augusta Pines Drive, Suite 220W'),
					array('Spring, TX 77389'),
				);
				$data[] = array('Tax ID Number:', 'Effective Date:', 'Dealership Name:', 'Mailing Address:', 'Contact Name:', 'Contact Phone:', 'Contact Email:');
				foreach ($dealerships as $dealership) {
					//$data[] = array('');
					$data[] = array($dealership->fein, 
									$dealership->effective_date, 
									$dealership->name, 
									$dealership->address_street . '; ' . $dealership->address_city . ', ' . $dealership->address_state . ' ' . $dealership->address_zip, 
									$dealership->contact_name, 
									$dealership->contact_phone, 
									$dealership->contact_email);
					/*$data[] = array('Tax ID Number: ', $dealership->fein);
					$data[] = array('Effective Date: ', $dealership->effective_date);
					$data[] = array('Dealership Name: ', $dealership->name);
					$data[] = array('Mailing Address: ', $dealership->address_street . '; ' . $dealership->address_city . ', ' . $dealership->address_state . ' ' . $dealership->address_zip);
					$data[] = array('Contact Name: ', $dealership->contact_name);
					$data[] = array('Contact Phone: ', $dealership->contact_phone);
					$data[] = array('Contact Email: ', $dealership->contact_email);*/
				}
				
				$this->load->library('php_excel');
				$this->php_excel->initialize('UTF-8', false, 'Dealerships Information');
				$this->php_excel->addArray($data);
				$this->php_excel->generateXML('dealership-' . $agent->first_name);
				
				die(); //Kill script so download will happen.
			break;
			case 'edit':
			
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_agent_edit == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_agent_edit == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_agent_edit == 'own' && $agent->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				$this->view_data['tab'] = "edit";
				
				if($_POST)
				{
					if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
						strlen($_POST['first_name']) > 0 &&
						strlen($_POST['last_name']) > 0 &&
						strlen($_POST['address_street']) > 0 &&
						strlen($_POST['address_city']) > 0 &&
						strlen($_POST['address_zip']) > 0 &&
						strlen($_POST['phone']) > 0
					){
						$agent = User::find_by_id($agent_id);
						$agent->email = $_POST['email'];
						$agent->password = $this->encrypt_password($_POST['password']);
						$agent->first_name = $_POST['first_name'];
						$agent->last_name = $_POST['last_name'];
						$agent->address_street = $_POST['address_street'];
						$agent->address_city = $_POST['address_city'];
						$agent->address_state = $_POST['address_state'];
						$agent->address_zip = $_POST['address_zip'];
						$agent->phone = $_POST['phone'];
						$agent->save();
						
						$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
						redirect('agents/view/' . $agent_id);
					}
				}
				
				break;
			case 'permissions':
			
				//CHECK to ensure the logged in user is allowed to edit agent permissions. 
				if(! $this->LOGGED_IN_USER->perm_edit_permissions)
				{
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				//form has been submitted so update permissions
				if($_POST)
				{
					$agent->perm_agency_view = $_POST['perm_agency_view'];
					$agent->perm_agency_edit = $_POST['perm_agency_edit'];
					$agent->perm_agency_delete = $_POST['perm_agency_delete'];
					$agent->perm_export_agency_list = $_POST['perm_export_agency_list'];
					
					$agent->perm_agent_view = $_POST['perm_agent_view'];
					$agent->perm_agent_edit = $_POST['perm_agent_edit'];
					$agent->perm_agent_delete = $_POST['perm_agent_delete'];
					$agent->perm_export_agent_list = $_POST['perm_export_agent_list'];
					$agent->perm_edit_password = $_POST['perm_edit_password'];
					
					$agent->perm_dealership_view = $_POST['perm_dealership_view'];
					$agent->perm_dealership_edit = $_POST['perm_dealership_edit'];
					$agent->perm_dealership_attachfiles = $_POST['perm_dealership_attachfiles'];
					$agent->perm_dealership_downloadxls = $_POST['perm_dealership_downloadxls'];
					$agent->perm_dealership_emailforreview = $_POST['perm_dealership_emailforreview'];
					$agent->perm_dealership_print = $_POST['perm_dealership_print'];
					$agent->perm_dealership_delete = $_POST['perm_dealership_delete'];
					$agent->perm_dealership_agentchange = $_POST['perm_dealership_agentchange'];
					$agent->perm_dealership_checklist = $_POST['perm_dealership_checklist'];
					$agent->perm_export_dealer_list = $_POST['perm_export_dealer_list'];
					
					$agent->perm_location_view = $_POST['perm_location_view'];
					$agent->perm_location_edit = $_POST['perm_location_edit'];
					$agent->perm_location_delete = $_POST['perm_location_delete'];
					
					$agent->perm_agency_notes_view = $_POST['perm_agency_notes_view'];
					$agent->perm_agency_notes_edit = $_POST['perm_agency_notes_edit'];
					$agent->perm_agency_notes_delete = $_POST['perm_agency_notes_delete'];
					
					$agent->perm_agent_notes_view = $_POST['perm_agent_notes_view'];
					$agent->perm_agent_notes_edit = $_POST['perm_agent_notes_edit'];
					$agent->perm_agent_notes_delete = $_POST['perm_agent_notes_delete'];
					
					$agent->perm_dealer_notes_view = $_POST['perm_dealer_notes_view'];
					$agent->perm_dealer_notes_edit = $_POST['perm_dealer_notes_edit'];
					$agent->perm_dealer_notes_delete = $_POST['perm_dealer_notes_delete'];
					
					$agent->save();
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Permissions for this user have been saved.'));
					redirect('agents/view/' . $agent->id . '?tab=permissions');
				}
			
				$this->view_data['tab'] = "permissions";
				break;
			case 'change_password':
				//Logged in user MUST have permission
				$has_permission = FALSE;
				$require_old_password = TRUE;
				
				if($this->LOGGED_IN_USER->perm_edit_password == 'all') { //Global administrators have all permissions
					$has_permission = TRUE;
					$require_old_password = FALSE;
				}
				
				if($this->LOGGED_IN_USER->perm_edit_password == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_edit_password == 'own' && $agent->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				if($agent->id == $this->LOGGED_IN_USER->id) { //If an admin is editing his own password, he needs to give his old password
					$require_old_password = TRUE;
				}
				
				$this->view_data['tab'] = "change_password";
				$this->view_data['require_old_password'] = $require_old_password;
				//die('this feature not currently implemented.');
				
				if($_POST) //Form was submitted for password change.
				{
				
					//New password must be same as old one, and new password must be valid
					if($require_old_password) { //if old password field is not empty
						if($this->validate_password($this->LOGGED_IN_USER->password, $_POST['old_password']) &&
							preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $_POST['new_password']) &&
							$_POST['new_password'] == $_POST['new_password_confirmation']
						){
							$user = User::find_by_id($this->LOGGED_IN_USER->id);
							$user->password = $this->encrypt_password($_POST['new_password']);
							$user->save();
							
							$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
							redirect('agents/view/' . $agent_id);
						}
						else if($this->validate_password($this->LOGGED_IN_USER->password, $_POST['old_password'])){ //if the password is invalid, create a variable to sent to the view to display this error
							$this->view_data['old_password_invalid'] = TRUE;
						}
					} else {
						
						if(preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $_POST['new_password']) &&
							$_POST['new_password'] == $_POST['new_password_confirmation']
						){
							$user = User::find_by_id($agent_id);
							$user->password = $this->encrypt_password($_POST['new_password']);
							$user->save();
							
							$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
							redirect('agents/view/' . $agent_id);
						}
					}
				}
				
				break;
			case 'delete':
				
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_agent_delete == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_agent_delete == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_agent_delete == 'own' && $agent->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				$this->view_data['tab'] = "delete";
				
				$agent = User::find_by_id($agent_id);
				if(isset($_POST['confirm'])) //confirm deletion
				{
					//first we need to get all dealerships to delete them
					$dealerships = Dealership::find_all_by_user_id($agent->id);
					foreach($dealerships as $dealership)
					{
						//now we need to get all locations to delete them
						$locations = Location::find_all_by_dealership_id($dealership->id);
						foreach($locations as $location)
						{
							$location->delete();
						}
						$dealership->delete();
					}
					$agent->delete();
					
					if($this->LOGGED_IN_USER->id == $agent->id) //If user is deleting his own account, log him out
						redirect('users/logout');
					
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
					redirect();
				}
				
				if(isset($_POST['cancel'])) //Cancel deletion
				{
					redirect('agents/view/' . $agent_id);
				}
				
				break;
			case 'notes':
			
				//Determine if the logged in user has permission
				$has_permission = FALSE;

				if($this->LOGGED_IN_USER->perm_agent_notes_view == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_agent_notes_view == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_agent_notes_view == 'own' && $agent->id == $this->LOGGED_IN_USER->id) //most regular agents will not be able to do this.
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				
				
			
				$this->view_data['tab'] = "notes";
				$this->load->helper('timeago'); //load helper function to convert date into time ago
				
				$sql = "SELECT * FROM notes WHERE parent_id = '".$agent->id."' and type = 'Agent' ORDER BY created_at DESC";
				$notes  = Note::find_by_sql($sql); //get the full list
				$this->view_data['notes'] = $notes;
				
				if(isset($_POST['confirm']))
				{
					if(strlen($_POST['note']) > 0 ) {
						$notes = new Note();
						$notes->parent_id = $agent->id;
						$notes->user_id = $this->LOGGED_IN_USER->id;
						$notes->type = 'Agent';
						$notes->note = $_POST['note'];
						$notes->created_at = date('Y-m-d h:i:s');
						$notes->updated_at = date('Y-m-d h:i:s');
						$notes->save();
						
						$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Form has been successfully submitted.'));
						redirect('agents/view/' . $agent_id.'?tab=notes');
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
					redirect('agents/view/' . $agent_id.'?tab=notes');
				}
				if(isset($_GET['delete']))
				{
					$id = $_GET['delete'];
					
					$notes = Note::find_by_id($id);
					$notes->delete();
					
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('success', 'Note successfully deleted.'));
					redirect('agents/view/' . $agent_id.'?tab=notes');
				}
				
				if(isset($_POST['cancel']))
				{
					redirect('agents/view/' . $agent_id);
				}
				
				break;
			default: //view this agent
				
				//Logged in user MUST have permission
				$has_permission = FALSE;
				
				if($this->LOGGED_IN_USER->perm_agent_view == 'all') //Global administrators have all permissions
					$has_permission = TRUE;
				
				if($this->LOGGED_IN_USER->perm_agent_view == 'agency' && $agent->agency_id == $this->LOGGED_IN_USER->agency_id) //Agency administrators have permission within all dealership records of their entire agency
					$has_permission = TRUE;
					
				if($this->LOGGED_IN_USER->perm_agent_view == 'own' && $agent->id == $this->LOGGED_IN_USER->id) //Regular agents only have permission to their own records
					$has_permission = TRUE;
					
				if(! $has_permission) { //If user doesn't have permission, restrict his access to be here.
					$this->session->set_flashdata('cryptbox_message', $this->generate_cryptbox_message('error', 'You do not have permission to do that.'));
					redirect();
				}
				
				$this->view_data['tab'] = "index";
				$agency = Agency::find_by_id($agent->agency_id);
				$this->view_data['agency'] = $agency;
				break;
		}
		
		
	}
	
	
	/**
	 * This is the page to add a new agent, where it asks for the agency.
	 */
	function adminaddstart()
	{
		if(! $this->LOGGED_IN_USER->group_id == 1)
		{
			redirect(); //must be a Global Administrator to be here!!!
		}
		
		if($_POST)
		{
			redirect('agents/adminadd/' . $_POST['agency_id']);
		}
		
		$this->view_data['agencies'] = Agency::find('all');
	}
	
	
	function adminadd($agency_id)
	{
		if(! $this->LOGGED_IN_USER->group_id == 1)
		{
			redirect(); //must be a Global Administrator to be here!!!
		}
		
		$agency = Agency::find_by_id($agency_id);
		
		if(! $agency) //if for some reason the agency can not be found
		{
			redirect('agents/adminaddstart');
		}
		
		
		if($_POST) //add this new agent to database!!!
		{
			//Check to make sure all input data is valid before adding this agent.
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
				preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $_POST['password']) &&
				$_POST['password'] == $_POST['password_confirmation'] &&
				strlen($_POST['first_name']) > 0 &&
				strlen($_POST['last_name']) > 0 &&
				strlen($_POST['address_street']) > 0 &&
				strlen($_POST['address_city']) > 0 &&
				strlen($_POST['address_zip']) > 0 &&
				strlen($_POST['phone']) > 0
			){
				$user = new User();
				$user->agency_id = $agency_id;
				$user->password = $this->encrypt_password($_POST['password']);
				$user->email = $_POST['email'];
				$user->first_name = $_POST['first_name'];
				$user->last_name = $_POST['last_name'];
				$user->address_street = $_POST['address_street'];
				$user->address_city = $_POST['address_city'];
				$user->address_state = $_POST['address_state'];
				$user->address_zip = $_POST['address_zip'];
				$user->phone = $_POST['phone'];
				$user->save();
				
				//if($user->errors->on('email')){ //I couldn't think of any other way to ensure that only unique email are added. If this is not here, errors will occur if the agent tries to register with an email that is already in use.
				//	die('This email address ' . $_POST['email'] . ' is already in use by another user. If you already have an account please log in under that account and do not create another one. If you forgot your login information, contact us for assistance. Press back on your web browser and try again.');
				//}
				redirect('agents/register_success');
			}
		}
		
		
		$this->view_data['agency'] = Agency::find_by_id($agency_id);
	}
	
	
	
	/**
	 * Encrypt a plaintext password into a secure 128 byte string.
	 * The first 64 bytes of the output will be the salt.
	 * The second 64 bytes of the output will be the sha256 hash of the salt concatenated with the plaintext password
	 * The result is the salt concatenated with the sha256 salt/plaintext password encryption
	 * **NOTE: Due to sheer laziness (actually I'm not sure how to share this function properly), this entire function is duplicated in the agents controller. If any changes are made to this, also make the changes there too!**
	 */
	private function encrypt_password($password)
	{
        $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)); //returns a 64 byte string
        $hash = hash('sha256', $salt . $password); //returns a 64 byte string
		
		return $salt . $hash;
	}
	
	
}