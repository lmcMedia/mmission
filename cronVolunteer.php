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
	$today = date("Y-m-d");
	$yesterday = date("Y-m-d", strtotime("-1 day"));
	
	$query = "SELECT wp_posts.* FROM wp_posts WHERE wp_posts.post_type = 'volunteer' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND wp_posts.post_date > '".$yesterday." 00:00:00' AND wp_posts.post_date < '".$today." 00:00:00'";

	$fieldsResult = @mysql_query( $query, $dbh );
	
	$records= array();
	$numRecords = 0;
	
	while ( $row = @mysql_fetch_object( $fieldsResult ) ) {
		$records[] =  get_object_vars( $row ) ;
		$numRecords ++;
	}
	
	$bodyContent = "Hello Midnight Mission, <br/><br/>";
	$bodyContent .= "Here is your Daily Report for the Volunteer section of your website <br/>";
	
	$bodyContent .= '<table border="1"><tr>';
	$bodyContent .= '<th>Number</th>';
	$bodyContent .= '<th>Title</th>';
	$bodyContent .= '<th>Content</th>';
	$bodyContent .= '</tr>';
	
	$numberItems = 1;
	foreach($records as $record)
	{
		$bodyContent .= "<tr> <td>$numberItems</td>";
		$bodyContent .= "<td>{$record['post_title']}</td>";
		$bodyContent .= "<td>{$record['post_content']}</td>";
		$bodyContent .= "</tr>";
		$numberItems++;	
	}
	$bodyContent .= '</table>';
	
	require 'class.phpmailer.php';
	
	$mail = new PHPMailer();
	
	$mail->isHTML(true);
	$mail->SetFrom('noreply@midnightmission.org', 'Midnight Mission');
	$mail->AddAddress('soney@midnightmission.org');	
	//$mail->AddAddress('chris@liquidmindcreative.com', "Chris");
	//$mail->AddAddress('cann@liquidmindcreative.com', 'Can');
	
	$mail->Subject = '[Midnight Mission] Volunteer Daily Report '. $yesterday;
	if($numberItems == 1) {
		$mail->Body    = "There are no items to display for today's daily report.";
	} else {
		$mail->Body    = $bodyContent;
	}
	
	if(!$mail->Send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
	
	echo 'Message has been sent';	
}
?>