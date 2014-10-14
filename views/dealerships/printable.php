<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-us">
<head>
	<title>Dealership Application</title>
	<style type="text/css">
		body {
			font-family: Calibri,Verdana,Lucida Sans,Trebuchet MS,Georgia;
			font-size: 14px;
			width: 800px;
		}
		.center {
			text-align: center;
		}
		.bold {
			font-weight: bold;
			font-size: 1.1em;
		}
		
		
		.tabTable {
			border: 2px #000000 solid;
			width: 100%;
		}
		.tabTable tr td {
			padding:4px;
		}
		.tabTable tr .borderBottom {
			border-color: #000000;
			border-style: solid;
			border-width:0px 0px 1px 0px;
		}
		.tabTable tr .borderBottomRight {
			border-color: #000000;
			border-style: solid;
			border-width:0px 1px 1px 0px;
		}
		
	</style>
</head>
<body>

<table style="width: 100%;">
	<tr>
		<td rowspan="5" valign="top">
			<img src="<?=site_url('images/logo.png')?>"><br />
			18 Augusta Pines Drive, Suite 220<br />
			Spring, Texas 77389
		</td>
		<td style="width:220px; text-align:right; padding-right:10px;">Agency:</td>
		<td style="width:360px; text-align:center;"><tt><?=$dealership->user->agency->name?></tt></td>
	</tr>
	<tr>
		<td style="text-align:right; padding-right:10px;">Producer:</td>
		<td style="text-align:center;"><tt><?=$dealership->user->first_name . ' ' . $dealership->user->last_name?></tt></td>
	</tr>
	<tr>
		<td style="text-align:right; padding-right:10px;">Phone Number:</td>
		<td style="text-align:center;"><tt><?=$dealership->user->phone?></tt></td>
	</tr>
	<tr>
		<td style="text-align:right; padding-right:10px;">Date Application Created:</td>
		<td style="border-bottom:2px #000000 solid; text-align:center;"><tt><?=!empty($dealership->created_at) ? $dealership->created_at->format('M j, Y') : ''?></tt></td>
	</tr>
	<tr>
		<td style="text-align:right; padding-right:10px;">PROPOSED EFFECTIVE DATE:</td>
		<td style="border-bottom:2px #000000 solid; text-align:center;"><tt><?php
		 	echo $dealership->effective_date;
			/*$pos = strpos($dealership->effective_date, '/'); 
			if ($pos === false) {
				$retrieved = $dealership->effective_date;
				$date = date('M j, Y', strtotime($retrieved));	
			} else {
				$retrieved = str_replace('/', '-', $dealership->effective_date);
				$date = date('M j, Y', strtotime($retrieved));
			}
			echo $date;*/
			?></tt></td>
	</tr>
</table>

<center style="margin:15px 0; font-weight:bold;">Dealers Questionnaire and Verification Form</center>

<table style="width:100%; border:2px #000000 solid;" cellspacing="0">
	<tr>
		<td style="border-color:#000000;" colspan="5">Dealership Name (Legal Entity):</td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;" colspan="5"><?=$dealership->name?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px; width:200px;" rowspan="2">Mailing Address:</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px;"><?=$dealership->address_street?></td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px;"><?=$dealership->address_city?></td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px;"><?=$dealership->address_state?></td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px;"><?=$dealership->address_zip?></td>
	</tr>
	<tr>
		<td style="font-size:10px; font-weight:bold;">Street Address</td>
		<td style="font-size:10px; font-weight:bold;">City</td>
		<td style="font-size:10px; font-weight:bold;">State</td>
		<td style="font-size:10px; font-weight:bold;">Zip</td>
	</tr>
</table>

<table style="width:100%; margin-top:16px; border:2px #000000 solid;" cellspacing="0">
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px; width:140px;" rowspan="2">Dealership Contact:</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Contact Name: <?=$dealership->contact_name?></td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->contact_email?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px;">Telephone #: <?=$dealership->contact_phone?></td>
		<td style="text-align:center; font-size:10px; font-weight:bold;">Email Address</td>
	</tr>
</table>

<table style="width:100%; margin-top:16px; border:2px #000000 solid;" cellspacing="0">
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px; width:140px;" rowspan="2">Contact For Claims:</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;"></td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->claim_email?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px;">Telephone #: <?=$dealership->claim_phone?></td>
		<td style="text-align:center; font-size:10px; font-weight:bold;">Email Address</td>
	</tr>
</table>

<table style="width:100%; margin-top:16px; border:2px #000000 solid;" cellspacing="0">
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px; font-weight:bold; width:100px;">Franchises:</td>
		<td style="text-align:center;"><?=$dealership->franchises?></td>
	</tr>
    <tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px; font-weight:bold; width:100px;">What type of inventory?:</td>
		<td style="text-align:center;"><?=$dealership->inventory_type?></td>
	</tr>
</table>

<table style="width:100%; margin-top:16px; border:2px #000000 solid;" cellspacing="0">
<?php
foreach($questionaire as $key => $ques) {
	$q_no = "q".$key;
	if($ques['boolean'] && !$ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
		$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? "Yes" : 'N/A';
		$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? "No" : $YNvalue;
		echo '<tr>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">'.$key.'.</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">'.$ques['ques'].'</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$YNvalue.'</td>';
		echo '</tr>';
	} else if($ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
		$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : '' : 'N/A';
		$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? "No" : $YNvalue;
		echo '<tr>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">'.$key.'.</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">'.$ques['ques'].'</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$YNvalue.'</td>';
		echo '</tr>';
	} else if($ques['boolean'] && $ques['detail'] && $ques['radios'] && !$ques['checkboxes']) {
		$options = " ";
		$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 1 ? isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : '' : 'N/A';
		$YNvalue = isset($ques_data[$key]['boolean']) && $ques_data[$key]['boolean'] == 0 ? "No" : $YNvalue;
		foreach ($ques['radios'] as $oKey=>$opt) {
			$selected = isset($ques_data[$key]['option']) && $ques_data[$key]['option'] == $oKey ? $opt : '';
			$options .= " - ".$selected;
			$YNvalue = 'Yes';
		}
		echo '<tr>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">'.$key.'.</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">'.$ques['ques'].'</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$YNvalue.' '.$options.'</td>';
		echo '</tr>';
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
		echo '<tr>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">'.$key.'.</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">'.$ques['ques'].'</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$YNvalue.' '.$options.'</td>';
		echo '</tr>';
	
	}  else if(!$ques['boolean'] && $ques['detail'] && !$ques['radios'] && !$ques['checkboxes']) {
	
		$text = isset($ques_data[$key]['text']) ? $ques_data[$key]['text'] : 'N/A';
		
		echo '<tr>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">'.$key.'.</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">'.$ques['ques'].'</td>';
		echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$text.'</td>';
		echo '</tr>';
	}
}
if(isset($ques_data['42']['boolean'])) {
	$data42 = $ques_data['42']['boolean'] == '1' ? 'Yes' : 'No';
	echo '<tr>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">42.</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">DOES DEALER USES MULTI STORY PARKING STRUCTURE AT ANY LOCATION</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$data42.'</td>';
	echo '</tr>';
	
	if($data42 == 'Yes') {
		if(isset($ques_data['42']['a']) ) {
			echo '<tr>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">42 a.</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">WHEN WAS STRUCTURE BUILT?</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$ques_data['42']['a'].'</td>';
			echo '</tr>';
		}
		if(isset($ques_data['42']['b']) ) {
			$data42b = $ques_data['42']['b'] == '1' ? 'Yes' : 'No';
			echo '<tr>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">42 b.</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">IF BUILT BEFORE 2000, HAS IT BEEN RETROFITTED TO MEET STATE EARTHQUAKE CODES?</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$data42b.'</td>';
			echo '</tr>';
		}
	} //if data42 is Yes
	
} else {
	echo '<tr>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">42.</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">DOES DEALER USES MULTI STORY PARKING STRUCTURE AT ANY LOCATION</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">N/A</td>';
	echo '</tr>';
}
if( isset($ques_data['43']['option']) ) {
		if($ques_data['43']['option'] == 'a') {
			echo '<tr>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">43.</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">SELECT STRUCTURE\'S CONTRUCTION</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">a.	PRECAST CONCRETE SURFACE WITH POURED CONCRETE PILLARS</td>';
			echo '</tr>';
		}
		if($ques_data['43']['option'] == 'b') {
			echo '<tr>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">43.</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">SELECT STRUCTURE\'S CONTRUCTION</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">b.	POURED CONCRETE 100%</td>';
			echo '</tr>';
		}
		if($ques_data['43']['option'] == 'c') {
			echo '<tr>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">43.</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">SELECT STRUCTURE\'S CONTRUCTION</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">c.	'.$ques_data['43']['c'].'</td>';
			echo '</tr>';
			
		}
} else {
	echo '<tr>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">43.</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">SELECT STRUCTURE\'S CONTRUCTION</td>';
			echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">N/A</td>';
	echo '</tr>';
}
echo '<tr>';
echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">44.</td>';
echo '<td colspan="2" style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">PROVIDE EARTHQUAKE LIMITS AND DEDUCTIBLES ON EXPIRING POLICY</td>';
echo '</tr>';
	$data44a = isset($ques_data['44']['a']) ? $ques_data['44']['a'] : 'N/A';
	echo '<tr>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">44 a.</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">LIMITS</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$data44a.'</td>';
	echo '</tr>';
	$data44b = isset($ques_data['44']['b']) ? $ques_data['44']['b'] : 'N/A';
	echo '<tr>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">44 b.</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">DEDUCTIBLE</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;">'.$data44b.'</td>';
	echo '</tr>';
	$data45a = isset($ques_data['45']['a']) ? $ques_data['45']['a'] : 'N/A';
	$data45b = isset($ques_data['45']['b']) ? $ques_data['45']['b'] : 'N/A';
	$data45c = isset($ques_data['45']['c']) ? $ques_data['45']['c'] : 'N/A';
	$data45d = isset($ques_data['45']['d']) ? $ques_data['45']['d'] : 'N/A';
	echo '<tr>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">45.</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Number of people who are allowed to drive company owned vehicle for personal use.</td>';
	echo '<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><table width="100%"><tr><th>Owner</th><th>Family</th><th>Employees</th><th>Other</th></tr><tr><td>'.$data45a.'</td><td>'.$data45b.'</td><td>'.$data45c.'</td><td>'.$data45d.'</td></tr></table></td>';
	echo '</tr>';
?>
	<!--<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">1.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Is identification required before releasing vehicle for test drive?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q1 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">2.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does salesperson accompany all test drives?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q2 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">3.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Are employee driving records reviewed at least annually?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q3 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">4.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does dealer use window lockboxes for overnight storage of vehicle keys?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q4 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">5.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Describe system(s) used for key storage.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q5?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">6.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does dealer furnish automobiles to non-employees?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q6 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">7.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does dealer provide demonstrators to employees? If so how many?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q7 == 1 ? 'Yes: ' . $dealership->q7text  : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">8.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Are buildings monitored by central security service and alarms?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q8 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">9.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does dealer use on premises security service during non-business hours?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q9 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">10.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does dealer use surveillance cameras?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q10 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">11.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Do all buildings in which vehicles are stored overnight have security alarms?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q11 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">12.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does dealer have rock aggregate on any building roofs?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q12 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">13.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Are any storage or parking lots in a flood zone? If so, please explain.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q13 == 1 ? 'Yes: ' . $dealership->q13text  : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">14.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Has any portion of dealer's vehicle storage or parking areas ever flooded? If so, please describe.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q14 == 1 ? 'Yes: ' . $dealership->q14text  : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">15.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">Does dealer have written disaster plan for avoiding damage from severe weather storms? </td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q15 == 1 ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px; width:60px; text-align:center;">16.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 1px 0px;">If hail nets, buildings, or other structures will protect vehicles from hail damage, how many cars are protected?</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 0px 1px 0px; text-align:center;"><?=$dealership->q16 == 1 ? 'Yes: ' . $dealership->q16text  : 'No'?></td>
	</tr>
	<tr>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px; width:60px; text-align:center;">17.</td>
		<td style="border-color:#000000; border-style:solid; border-width:0px 1px 0px 0px;">Describe any managerial or loss control improvements in the past 4 years that were implemented as a result of a loss.</td>
		<td style="text-align:center;"><?=$dealership->q17?></td>
	</tr>-->
</table>

<table style="width:100%; margin-top:16px; border:2px #000000 solid;" cellspacing="0">
	<tr>
		<td style="text-align:center;" colspan="2">Maximum Per Covered Auto Loss Limit - $250,000</td>
	</tr>
	<tr>
		<td style="text-align:center;">Does the dealer have any vehicles with values in excess of $250,000?</td>
		<td style="width:200px;"><?=$dealership->over250k ? 'Yes' : 'No'?></td>
	</tr>
	<tr>
		<td style="text-align:center;">Is this a ABC/XYZ renewal?</td>
		<td style="width:200px;"><?=$dealership->is_allianz_renewal ? 'Yes' : 'No'?></td>
	</tr>
</table>

<table style="width:100%; margin-top:16px; border:2px #000000 solid;" cellspacing="0">
	<tr>
		<td style="text-align:center; font-weight:bold;" colspan="6">Lienholder</td>
	</tr>
	<tr>
		<td style="width:60px;">Name:</td>
		<td><?=$dealership->lienholder_name?></td>
		<td style="width:80px;">Address:</td>
		<td><?=$dealership->lienholder_address_street?></td>
	</tr>
	<tr>
		<td>City:</td>
		<td><?=$dealership->lienholder_address_city?></td>
		<td>State:</td>
		<td><?=$dealership->lienholder_address_state?></td>
		<td style="width:50px;">Zip:</td>
		<td><?=$dealership->lienholder_address_zip?></td>
	</tr>
</table>



<div style="text-align:center; margin-top:140px; font-weight:bold;">***************PARKING GARAGE***************</div>
<table style="width:100%; margin-top:16px; border:2px #000000 solid;">
	<tr>
		<td>Number of units in parking garage?</td>
		<td><?=$dealership->parking_garage_num_units?></td>
		<td>Maximum inventory values in parking garage?</td>
		<td><?=$dealership->parking_garage_max_inventory?></td>
	</tr>
</table>

<table style="margin-top:16px;" cellspacing="0" class="tabTable">
	<tr>
		<td class="center borderBottom bold" width="50%">COMPREHENSIVE AND COLLISION DEDUCTIBLES:</td>
		<td class="center borderBottom" width="50%">
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
			endswitch;
		?>
		</td>
	</tr>
	<tr>
		<td style="text-align:center;" colspan="2">Comprehensive Deductibles Are Per Covered Auto / Per Loss Aggregate. Collision Coverage Deductibles Are Per Covered Auto. (Per Loss Aggregate Deductibles Do Not Apply to "Weather Deductibles".)</td>
	</tr>
</table>

<table style="margin-top:16px;" class="tabTable" cellspacing="0">
	<tr>
		<td class="center bold borderBottom" width="50%">FLOOD DEDUCTIBLE:</td>
		<td class="center bold borderBottom" width="50%">10% of the amount of loss</td>
	</tr>
	<tr>
		<td colspan="2">
			<span class="bold">FLOOD DEDUCTIBLES - All States</span><br />
			<span style="font-size:.8em;">SUBJECT TO A FLOOD AVOIDANCE PLAN FOR ANY LOCATIONS IN A FLOOD ZONE A, E, OR V AND IF THE FLOOD AVOIDANCE PLAN IS NOT EXECUTED TO A PRE-APPROVED LOCATION AT TIME OF ANY FLOODING EVENT, THEN THAT DEALERSHIP WILL HAVE A 30% DEDUCTIBLE AGAINST THEIR AMOUNT OF LOSS. IF THE FLOOD AVOIDANCE PLAN IS EXECUTED, THEN THE DEDUCTIBLE WILL REVERT TO 10% OF THE AMOUNT OF LOSS.</span>
		</td>
	</tr>
</table>

<table style="margin-top:16px;" class="tabTable" cellspacing="0">
	<tr>
		<td>
			<span class="bold">WEATHER DEDUCTIBLES</span><br />
			<span class="bold">Zone 1 & 2 - Weather deductible is 10% of the amount of loss</span><br />
			<span style="font-size: .85em;">Alaska, Arizona, California, Colorado (Western), Connecticut, Delaware, DC, Idaho, Illinois (Eastern), Maine, Maryland, Massachusetts, Michigan, Nevada, New Hampshire, New Mexico (Western), New York, Oregon, Ohio, Rhode Island, Utah, Vermont, Virginia, Washington, West Virginia, Wisconsin, Pennsylvania</span><br />
			<span class="bold">Zone 3 - Weather deductible is 20% of the amount of loss</span><br />
			<span style="font-size: .85em;">Alabama (Northern), Arkansas (Eastern), Georgia, Hawaii, Illinois (Western), Indiana, Kentucky, Mississippi (Northern), North Carolina, South Carolina, Tennessee, Montana, New Jersey</span><br />
			<span class="bold">Zone 4 - Weather deductible is $750 per vehicle</span><br />
			<span style="font-size: .85em;">Alabama (Southern), Iowa, Louisiana (Northern), Minnesota, Mississippi (Southern), Missouri (Eastern), New Mexico (Eastern), Texas (Southern)</span><br />
			<span class="bold">Zone 5 - Weather deductible is $1000 per vehicle</span><br />
			<span style="font-size: .85em;">Arkansas (Western), Colorado (Eastern), Florida, Kansas,  Louisiana (Southern), Missouri (Western), Nebraska, North Dakota, Oklahoma, South Dakota, Texas (Northern), Wyoming</span><br />
		</td>
	</tr>
</table>


<table style="margin-top:16px;" class="tabTable" cellspacing="0">
	<tr>
		<td class="borderBottomRight">Current Insurance Carrier (If Allianz, please provide Policy Number & Expiration Date)</td>
		<td class="borderBottom center" style="width:180px;"><?=$dealership->current_insurance_carrier?></td>
	</tr>
	<tr>
		<td class="borderBottomRight">Expiring Deductibles:</td>
		<td class="borderBottom center"><?=$dealership->expiring_deductibles?></td>
	</tr>
	<tr>
		<td class="borderBottomRight">Expiring Weather Deductibles:</td>
		<td class="borderBottom center"><?=$dealership->expiring_weather_deductibles?></td>
	</tr>
	<tr>
		<td class="borderBottomRight">Target Premium:</td>
		<td class="borderBottom center"><?=$dealership->target_premium?></td>
	</tr>
</table>

<table style="margin-top:16px;" class="tabTable" cellspacing="0">
	<tr>
		<td class="bold">
			PLEASE SIGN AND ACKNOWLEDGE THAT THE ABOVE INFORMATION IS AN ACCURATE AND TRUTHFUL REFLECTION OF YOUR BUSINESS TO THE BEST OF YOUR KNOWLEDGE.  BY YOUR SIGNATURE YOU HEREBY ACKNOWLEDGE THAT IF YOU FALSELY DESCRIBE THE PROPERTY TO THE PREJUDICE OF THE INSURER, OR MISREPRESENT OR FRAUDULENTLY OMIT TO COMMUNICATE ANY CIRCUMSTANCE OR FACT THAT IS MATERIAL TO THE INSURER IN ORDER TO ENABLE THE INSURER TO JUDGE THE RISK TO BE UNDERTAKEN, THE CONTRACT IS VOID AS TO ANY CLAIM OR PROPERTY IN RELATION TO WHICH THE MISREPRESENTATION OR OMISSION IS MATERIAL.
		</td>
	</tr>
</table>

<table style="margin-top:70px; width:100%;" cellspacing="0">
	<tr>
		<td style="border-color: #000000; border-style: solid; border-width:0px 0px 1px 0px;" width="50%"></td>
		<td width="10%"></td>
		<td style="border-color: #000000; border-style: solid; border-width:0px 0px 1px 0px;" width="40%"></td>
	</tr>
	<tr>
		<td>Applicant Signature</td>
		<td></td>
		<td>Date</td>
	</tr>
</table>












<center style="margin-top:120px;" class="bold">
	Location Application Schedule<br />
	<span style="letter-spacing:4px;">Inventory for Last 12 Months</span>
</center>

<?php if(count($locations)): ?>
	
	
	
	<?php
		$counter = 1;
		foreach($locations as $location): ?>
	
		<table style="margin-top:16px; border: 2px #000000 solid; border-bottom:1px #000000 solid; width: 100%;" cellspacing="0">
			<tr>
				<td style="width:140px; border-bottom:1px #000000 solid;">Location #: <?=$counter?></td>
				<td style="border-bottom:1px #000000 solid;" colspan="4">Name (dba): <?=$location->dba_name?></td>
			</tr>
			<tr>
				<td rowspan="2" style="border-right:1px #000000 solid;">Address</td>
				<td style="border-bottom:1px #000000 solid;"><?=$location->address_street?></td>
				<td style="border-bottom:1px #000000 solid;"><?=$location->address_city?></td>
				<td style="border-bottom:1px #000000 solid;"><?=$location->address_state?></td>
				<td style="border-bottom:1px #000000 solid;"><?=$location->address_zip?></td>
			</tr>
			<tr>
				<td><small>Street Address</small></td>
				<td><small>City</small></td>
				<td><small>State</small></td>
				<td><small>Zip</small></td>
			</tr>
		</table>

		<table style="border: 2px #000000 solid; border-top:0; width: 100%;" cellspacing="0">
			<tr>
				<td style="border-bottom:1px #000000 solid;" colspan="6">Federal Tax ID Number: <?=$location->fein?></td>
			</tr>
			<tr>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Maximum New Coll Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Maximum Used Coll Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Average New Coll Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Average Used Coll Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Demo Coll Values</td>
				<td style="text-align:center; border-bottom:1px #000000 solid;">Shop Rental Coll Values</td>
			</tr>
			<tr>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->maximum_new_coll)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->maximum_used_coll)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->average_new_coll)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->average_used_coll)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->demo_coll)?></td>
				<td style="text-align:center; border-bottom:1px #000000 solid;">$<?=number_format($location->shop_rental_coll)?></td>
			</tr>
			<tr>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Maximum New Comp Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Maximum Used Comp Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Average New Comp Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Average Used Comp Values</td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">Demo Comp Values</td>
				<td style="text-align:center; border-bottom:1px #000000 solid;">Shop Rental Comp Values</td>
			</tr>
			<tr>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->maximum_new_comp)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->maximum_used_comp)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->average_new_comp)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->average_used_comp)?></td>
				<td style="text-align:center; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">$<?=number_format($location->demo_comp)?></td>
				<td style="text-align:center; border-bottom:1px #000000 solid;">$<?=number_format($location->shop_rental_comp)?></td>
			</tr>
            <tr>
				<td colspan="6" style="text-align:left; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">
                How many vehicles are parked in/under each of the following structures?<br>
                	<table border="1" cellpadding="3" cellspacing="1"><tr>
                        <th>Multi Story Parking Structure</th>
                        <th>Single Story Building</th>
                        <th>Hail Net / Awning Structure</th>
                        </tr>
                        <tr>
                        <td>
                        <?=isset($location->msps_capacity) ? $location->msps_capacity : ''?>
                        </td>
                        <td>
                        <?=isset($location->ssb_capacity) ? $location->ssb_capacity : ''?>
                        </td>
                        <td>
                        <?=isset($location->hns_capacity) ? $location->hns_capacity : ''?>
                        </td>
                        </tr>
                    </table>
                </td>
            </tr>
             <tr>
				<td colspan="6" style="text-align:left; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">
                 	What is the TOTAL number of vehicles the dealer could protect at this location from hail damage if you had time to move them?  Consider Off site buildings if available.<br>
                 	<strong>Answer:</strong>  <?=isset($location->hail_damage_protection_capacity) ? $location->hail_damage_protection_capacity : ''?>
                </td>
             </tr>
             <tr>
				<td colspan="6" style="text-align:left; border-right:1px #000000 solid; border-bottom:1px #000000 solid;">
                	How long would it take to move this number of vehicles?<br>
                    <strong>Answer:</strong>  <?=isset($location->move_time) ? $location->move_time : ''?>
                </td>
             </tr>
		</table>
		
		
		
	<?php
		$counter++;
		endforeach; ?>

<?php else: ?>
	<div style="cryptbox cryptwarning">No locations added.</div>
<?php endif; ?>





</body>
</html>
