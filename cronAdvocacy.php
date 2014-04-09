<?php
date_default_timezone_set('America/Los_Angeles');


require 'wp-config.php';

$new_link = defined( 'MYSQL_NEW_LINK' ) ? MYSQL_NEW_LINK : true;
$client_flags = defined( 'MYSQL_CLIENT_FLAGS' ) ? MYSQL_CLIENT_FLAGS : 0;

$dbh = @mysql_connect( DB_HOST, DB_USER, DB_PASSWORD, $new_link, $client_flags );

if(!$dbh) {	
	echo 'Can not connect database';
	die();
}

if ( !@mysql_select_db( DB_NAME, $dbh ) ) {
	echo 'can not select db';
	die();
}else {
	$bodyContent = "Hello Midnight Mission, <br/><br/>";
	$bodyContent .= "Here is your Daily Report for the Advocacy section of your website <br/>";
	
	$bodyContent .= '<table border="1"><tr>';
	$fields = getForm('SELECT * FROM wp_ninja_forms_fields WHERE `form_id` = 2 ORDER BY `order` ASC', $dbh);
	
	$fieldLabelArr = array();
	$bodyContent .= '<th>Number</th>';	
	foreach($fields as $index => $f)
	{
		if($index != count($fields) -1) {
			$fieldLabelArr[$f['id']]['label'] = $f['data']['label'];
			$bodyContent .= '<th>' . str_replace(":", "", $f['data']['label']) . '</th>';
		}		
	}
	$bodyContent .= '</tr>';
	
	$today = date("Y-m-d");
	$yesterday = date("Y-m-d", strtotime("-1 day"));	 
	$records = getForm("SELECT * FROM wp_ninja_forms_subs WHERE `form_id` = 2 AND date_updated > '".$yesterday." 00:00:00' AND date_updated < '".$today." 00:00:00' ORDER BY `date_updated` DESC ", $dbh);

	$fieldDataArr = array();
	foreach($records as $record)
	{
		if($record['action'] == 'submit' && $record['status'] == 1)
		foreach($record['data'] as $item)
		{			
			$fieldDataArr[$record['id']][$item['field_id']] = $item['user_value'];
		}
	}
	
	$numberItems = 1;
	
	foreach($fieldDataArr as $fields)
	{
		$bodyContent .= "<tr> <td>$numberItems</td>";
		foreach($fieldLabelArr as $key => $label)
		{
			$bodyContent .= "<td>";
			if(is_array($fields[$key])) {
				$bodyContent .= implode("<br/>", $fields[$key]);
			} else if($fields[$key] == "checked") {
				$bodyContent .= "Yes";
			} else if($fields[$key] == "unchecked") {
				$bodyContent .= "No";
			} else {
				$bodyContent .= $fields[$key];
			}
			$bodyContent .= "</td>";
		}
		$bodyContent .= "</tr>";
		$numberItems++;
	}
	$bodyContent .= '</table>';
	
	require 'class.phpmailer.php';
	
	$mail = new PHPMailer();
	
	$mail->isHTML(true);
	$mail->SetFrom('noreply@midnightmission.org', 'Midnight Mission');
	$mail->AddAddress('rnavales@midnightmission.org', 'Heather Foran');
	//$mail->AddAddress('chris@liquidmindcreative.com');
	//$mail->AddAddress('cann@liquidmindcreative.com');
	

	$mail->Subject = '[Midnight Mission] Advocacy Daily Report '. $yesterday ;
	if($numberItems == 1) {
		$mail->Body    = "There are no items to display for today's daily report.";
	} else {
		$mail->Body    = $bodyContent;
	}	
	
	// $mail->AddAttachment('/web/mywebsite/public_html/file.zip', 'file.zip');
	
	if(!$mail->Send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
	
	echo 'Message has been sent';
}

function getForm($query, $dbh)
{
	$fieldsResult = @mysql_query( $query, $dbh );
	
	$fields = array();
	$numFields = 0;
	
	while ( $row = @mysql_fetch_object( $fieldsResult ) ) {
		$fields[$numFields] =  get_object_vars( $row ) ;
		$numFields++;
	}
	
	if(is_array($fields) AND !empty($fields)){
		$x = 0;
		$count = count($fields) - 1;
		while($x <= $count){
			$fields[$x]['data'] = unserialize($fields[$x]['data']);
			$x++;
		}
	}
	
	return $fields;
}
?>