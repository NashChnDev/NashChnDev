<?php

require 'phpmailer/phpmailer/PHPMailerAutoload.php';
	     $DB_SERVER = "localhost";//"localhost";//
		 $DB_USER = "root";
		 $DB_PASSWORD = "";//"root";//
		 $DB = "nash_gauge_track";
$a = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD);
$connectDB = mysqli_select_db($a,$DB);

if($connectDB)
{
	
	$mail = new PHPMailer;                              
	$mail->isSMTP();                                      
	$mail->Host = 'smtp.gmail.com'; 
	$mail->SMTPAuth = true;                               
	$mail->Username = 'ambalavanan2424@gmail.com';  //'noreply@mazeworks.com';                 
	$mail->Password = 'ifvbdqecesjanlei';	//'mazeworks@1955';                          
	$mail->SMTPSecure = 'tls';                           
	$mail->Port = '587'; 
	$mail->setFrom('ambalavanan2424@gmail.com', 'ambalavanan2424@gmail.com');  //setFrom('noreply@jkfenner.com', 'JK Fenner - ZingHr');
	
	$sms_apikey = "Ab4dfa17e803050efa6d2abb88518f94e";
	$sms_senderid = "MAZEWS";
	   
	
$currentDate = date('Y-m-d');

$getData = array();


	/*  GET DEVICE ALERT NOTIFICATION DATA  - START */ 
 
$sqlche1=mysqli_query($a,"SELECT * FROM devices where (alert_remaindate = '$currentDate') AND (expirydate >= '$currentDate') AND (status != 'Scraped')");

$sqlche2=mysqli_query($a,"SELECT * FROM devices where (alert_remaindate < '$currentDate') AND (expirydate >= '$currentDate') AND (status != 'Scraped')");


if(mysqli_num_rows($sqlche1) > 0)
{
	$DeviceAlertData = $sqlche1;
}
elseif(mysqli_num_rows($sqlche2) > 0)
{
	$DeviceAlertData = $sqlche2;
}	

/*  GET DEVICE ALERT NOTIFICATION DATA  - END */ 


	/*  GET DEVICE ALERT ESCALATION NOTIFICATION DATA  - START */ 
 
$getEscalationdata1 = mysqli_query($a,"SELECT * FROM devices where (expirydate = '$currentDate') AND (status != 'Scraped')");

$getEscalationdata2 = mysqli_query($a,"SELECT * FROM devices where (alert_remaindate < '$currentDate') AND (expirydate < '$currentDate') AND (status != 'Scraped')");


if(mysqli_num_rows($getEscalationdata1) > 0)
{
	$DeviceEscalationAlertData = $getEscalationdata1;
}
elseif(mysqli_num_rows($getEscalationdata2) > 0)
{
	$DeviceEscalationAlertData = $getEscalationdata2;
}	

/*  GET DEVICE ALERT ESCALATION NOTIFICATION DATA  - END */ 


					/* 	Device Alert Notification Part    */ 
				
if(mysqli_num_rows($DeviceAlertData) > 0)
{	

$getData=array();
while($getValue = mysqli_fetch_array($DeviceAlertData))
{
$getData[] = $getValue;
								
}

    $messageBody     = array();
    $DeviceMail_To   = array();
    $DeviceMail_CC   = array();
    $DeviceMail_BCC  = array();
  
	$messageHeader = '<font face="Times New Roman" size="4"  >Dear Sir,</font><br/><br/>
			  <font face="Times New Roman" size="4" > <b> Your Device is going to Expire.<br><br>
	
	<table border="1">
	<thead>
	<tr>
	<th>S.No</th>
	<th>Device ID</th>
	<th>Device Name</th>
	<th>Device catagory</th>
	<th>Device ERP Code</th>
	<th>Remaining Date</th>
	<th>Expiry Date</th>
	<th>Status</th>
	</tr>
	</thead>
	<tbody>';
	
	 foreach ($getData as $key => $value) 
	 {
		 
	 	$deviceID               = $value['devices_id'];
		$devices_description    = $value['devices_description'];
		$device_scategory       = $value['device_scategory'];
		$device_sasseterpcode   = $value['device_sasseterpcode'];
		$alert_remaindate       = $value['alert_remaindate'];
		$expirydate             = $value['expirydate'];
		$status     			= "Approach Calibration";
		$plant  				= $value['plant_id'];
					
	$messageBody[]='
	<tr>
	<td>'.($key+1).'</td>
	<td>'.$deviceID.'</td>
	<td>'.$devices_description.'</td>
	<td>'.$device_scategory.'</td>
	<td>'.$device_sasseterpcode.'</td>
	<td>'.$alert_remaindate.'</td>
	<td>'.$expirydate.'</td>
	<td>'.$status.'</td>
	<tr>';
	
	$DBMail_To   =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'mailto') AND (plant_id = '$plant')");
	$DBMail_CC   =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'mailcc') AND (plant_id = '$plant')");
	$DBMail_BCC  =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'mailbcc') AND (plant_id = '$plant')");
	
	if(mysqli_num_rows($DBMail_To) > 0)
	{	
	
	while($mailto = mysqli_fetch_array($DBMail_To))
	{
		$DeviceMail_To[] = $mailto;			
	}
	
	while($mailcc = mysqli_fetch_array($DBMail_CC))
	{
		$DeviceMail_CC[] = $mailcc;			
	}
	
	while($mailbcc = mysqli_fetch_array($DBMail_BCC))
	{
		$DeviceMail_BCC[] = $mailbcc;			
	}
	}
	
	 }
	 
	$messageFooter= '</tbody></table> <br><font face="Times New Roman" size="4"><b>Thank you!!!</b></font><br/><br/>';
	
	$messageBody = implode($messageBody,'');
		
	$message = ($messageHeader.$messageBody.$messageFooter);
	
	if(mysqli_num_rows($DBMail_To) > 0)
	{	
	foreach($DeviceMail_To as $key => $valueMailTo)
	{
		$mail->addAddress($valueMailTo['optionvalue'],$valueMailTo['optionvalue']);
	}
	
	foreach($DeviceMail_CC as $key => $valueMailCC)
	{
		$mail->addCC($valueMailCC['optionvalue'],$valueMailCC['optionvalue']);
	}
	
	foreach($DBMail_BCC as $key => $valueMailBCC)
	{
		$mail->addBCC($valueMailBCC['optionvalue'],$valueMailBCC['optionvalue']);
	}
	}
	

	$subject='System Alert! - Tool Gauge Application '.date("Y-m-d").' ';
	$body = $message; 
	$mail->Subject = $subject;
	$mail->Body    = $body;
	$mail->IsHTML(true);
	$sendSuccess = $mail->send();
	
	if(!$sendSuccess) 
	{
		$myfile = fopen("mailsmsLog.txt", "w") or die("Unable to open file!");
		$txt = "------------------------------------------------------------\n Device Alert E-mail Not sent - ".date('Y-m-d H:s:i');
		fwrite($myfile, $txt);
		fclose($myfile);
	}

		
	 

}


					/* 	Device Alert Escalation  Notification Part    */ 


if(mysqli_num_rows($DeviceEscalationAlertData) > 0)
{	

$getData=array();
while($getValue = mysqli_fetch_array($DeviceEscalationAlertData))
{
$getData[] = $getValue;
								
}

	  
    $messageBody     = array();
    $DeviceMail_To   = array();
    $DeviceMail_CC   = array();
    $DeviceMail_BCC  = array();
  
	$messageHeader = '<font face="Times New Roman" size="4"  >Dear Sir,</font><br/><br/>
			  <font face="Times New Roman" size="4" > <b> Your Device is Expired.<br><br>
	
	<table border="1">
	<thead>
	<tr>
	<th>S.No</th>
	<th>Device ID</th>
	<th>Device Name</th>
	<th>Device catagory</th>
	<th>Device ERP Code</th>
	<th>Remaining Date</th>
	<th>Expiry Date</th>
	<th>Status</th>
	</tr>
	</thead>
	<tbody>';
	
	 foreach ($getData as $key => $value) 
	 {
		 
	 	$deviceID               = $value['devices_id'];
		$devices_description    = $value['devices_description'];
		$device_scategory       = $value['device_scategory'];
		$device_sasseterpcode   = $value['device_sasseterpcode'];
		$alert_remaindate       = $value['alert_remaindate'];
		$expirydate             = $value['expirydate'];
		$status     			= "Expired";
		$plant  				= $value['plant_id'];
					
	$messageBody[]='
	<tr>
	<td>'.($key+1).'</td>
	<td>'.$deviceID.'</td>
	<td>'.$devices_description.'</td>
	<td>'.$device_scategory.'</td>
	<td>'.$device_sasseterpcode.'</td>
	<td>'.$alert_remaindate.'</td>
	<td>'.$expirydate.'</td>
	<td>'.$status.'</td>
	<tr>';
	
	$DBMail_To   =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'escalationmailto') AND (plant_id = '$plant')");
	$DBMail_CC   =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'escalationmailcc') AND (plant_id = '$plant')");
	$DBMail_BCC  =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'escalationmailbcc') AND (plant_id = '$plant')");
	
	if(mysqli_num_rows($DBMail_To) > 0)
	{	
	
	while($mailto = mysqli_fetch_array($DBMail_To))
	{
		$DeviceMail_To[] = $mailto;			
	}
	
	while($mailcc = mysqli_fetch_array($DBMail_CC))
	{
		$DeviceMail_CC[] = $mailcc;			
	}
	
	while($mailbcc = mysqli_fetch_array($DBMail_BCC))
	{
		$DeviceMail_BCC[] = $mailbcc;			
	}
	}
	
	 }
	 
	$messageFooter= '</tbody></table> <br><font face="Times New Roman" size="4"><b>Thank you!!!</b></font><br/><br/>';
	
	$messageBody = implode($messageBody,'');
		
	$message = ($messageHeader.$messageBody.$messageFooter);
	
	if(mysqli_num_rows($DBMail_To) > 0)
	{	
	foreach($DeviceMail_To as $key => $valueMailTo)
	{
		$mail->addAddress($valueMailTo['optionvalue'],$valueMailTo['optionvalue']);
	}
	
	foreach($DeviceMail_CC as $key => $valueMailCC)
	{
		$mail->addCC($valueMailCC['optionvalue'],$valueMailCC['optionvalue']);
	}
	
	foreach($DBMail_BCC as $key => $valueMailBCC)
	{
		$mail->addBCC($valueMailBCC['optionvalue'],$valueMailBCC['optionvalue']);
	}
	}
	

	$subject='System Alert! - Tool Gauge Application '.date("Y-m-d").' ';
	$body = $message; 
	$mail->Subject = $subject;
	$mail->Body    = $body;
	$mail->IsHTML(true);
	$sendSuccess = $mail->send();
	
	if(!$sendSuccess) 
	{
		$myfile = fopen("mailsmsLog.txt", "w") or die("Unable to open file!");
		$txt = "------------------------------------------------------------\n Device Alert Escalation E-mail Not sent - ".date('Y-m-d H:s:i');
		fwrite($myfile, $txt);
		fclose($myfile);
	}

		
	 

}

	/* 	Device Alert SMS  Notification Part    */
	
$sqlcheSMS1=mysqli_query($a,"SELECT * FROM devices where (alert_remaindate = '$currentDate') AND (expirydate >= '$currentDate') AND (status != 'Scraped')");

$sqlcheSMS2=mysqli_query($a,"SELECT * FROM devices where (alert_remaindate < '$currentDate') AND (expirydate >= '$currentDate') AND (status != 'Scraped')");



if(mysqli_num_rows($sqlcheSMS1) > 0)
{
	$DeviceSMSAlertData = $sqlcheSMS1;
}
elseif(mysqli_num_rows($sqlcheSMS2) > 0)
{
	$DeviceSMSAlertData = $sqlcheSMS2;
}	
	
	
if(mysqli_num_rows($DeviceSMSAlertData) > 0)
{
	
$getSMSData=array();
while($getValuess = mysqli_fetch_array($DeviceSMSAlertData))
{
$getSMSData[] = $getValuess;
								
}

	 foreach ($getSMSData as $key => $valueSMSData) 
	 {

	 	$deviceID               = $valueSMSData['devices_id'];
		$devices_description    = $valueSMSData['devices_description'];
		$device_scategory       = $valueSMSData['device_scategory'];
		$device_sasseterpcode   = $valueSMSData['device_sasseterpcode'];
		$alert_remaindate       = $valueSMSData['alert_remaindate'];
		$expirydate             = $valueSMSData['expirydate'];
		$status     			= "Approach Calibration";
		$plant  				= $valueSMSData['plant_id'];
					
    $DeviceData[] = $deviceID.$devices_description.$device_scategory.$device_sasseterpcode.$alert_remaindate.$expirydate.$status; 
	
	$Message = "Dear Sir, the Invoice No. |tn| dated |d| for value Rs. |a| has been raised and your current outstanding is Rs. |OSC|";
	
	$DBSMS_To   =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'alertsms') AND (plant_id = '$plant')");
	
	if(mysqli_num_rows($DBSMS_To) > 0)
	{
	
	while($smsto = mysqli_fetch_array($DBSMS_To))
	{
		$DeviceAlertSMS_To[] = $smsto;			
	}
	
	foreach($DeviceAlertSMS_To as $key => $valueSMSTo)
	{
		 
		$curl=curl_init('https://api-alerts.kaleyra.com/v4/?api_key='.$sms_apikey.'&method=sms&message='.$Message.'&to='.$valueSMSTo['optionvalue'].'&sender='.$sms_senderid);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HEADER, false);
        try{ }
        catch (Exception $e)
        { return $e->getMessage(); }
        
       $res                 = curl_exec($curl);
       $result              = json_decode($res,true);
	   	   	  
	  if($result['status'] == "OK")  
	  {
		$myfile = fopen("mailsmsLog.txt", "w") or die("Unable to open file!");
		$txt = "------------------------------------------------------------\n Device Alert SMS sent - ".$valueSMSTo['optionvalue']." ~ ".date('Y-m-d H:s:i');
		fwrite($myfile, $txt);
		fclose($myfile);
	  }
		else
			{
				$myfile = fopen("mailsmsLog.txt", "w") or die("Unable to open file!");
				$txt = "------------------------------------------------------------\n Device Alert SMS Not sent - ".$valueSMSTo['optionvalue']." ~ ".date('Y-m-d H:s:i');
				fwrite($myfile, $txt);
				fclose($myfile);
			}    
	}
	
	 }
	 }
	 

	 

}
 	


	/* 	Device Alert Escalation  SMS  Notification Part    */
	
$getEscalationdataSMS1 = mysqli_query($a,"SELECT * FROM devices where (expirydate = '$currentDate') AND (status != 'Scraped')");

$getEscalationdataSMS2 = mysqli_query($a,"SELECT * FROM devices where (alert_remaindate < '$currentDate') AND (expirydate < '$currentDate') AND (status != 'Scraped')");




if(mysqli_num_rows($getEscalationdataSMS1) > 0)
{
	$DeviceSMSEscalationAlertData = $getEscalationdataSMS1;
}
elseif(mysqli_num_rows($getEscalationdataSMS2) > 0)
{
	$DeviceSMSEscalationAlertData = $getEscalationdataSMS2;
}	
	
	
if(mysqli_num_rows($DeviceSMSEscalationAlertData) > 0)
{
	
$getSMSEscalationData=array();
while($getValuess = mysqli_fetch_array($DeviceSMSEscalationAlertData))
{
$getSMSEscalationData[] = $getValuess;
								
}

	 foreach ($getSMSEscalationData as $key => $valueSMSEscalationData) 
	 {

	 	$deviceID               = $valueSMSEscalationData['devices_id'];
		$devices_description    = $valueSMSEscalationData['devices_description'];
		$device_scategory       = $valueSMSEscalationData['device_scategory'];
		$device_sasseterpcode   = $valueSMSEscalationData['device_sasseterpcode'];
		$alert_remaindate       = $valueSMSEscalationData['alert_remaindate'];
		$expirydate             = $valueSMSEscalationData['expirydate'];
		$status     			= "Approach Calibration";
		$plant  				= $valueSMSEscalationData['plant_id'];
					
    $DeviceData[] = $deviceID.$devices_description.$device_scategory.$device_sasseterpcode.$alert_remaindate.$expirydate.$status; 
	
	$MessageEscalation = "Dear Sir, the Invoice No. |tn| dated |d| for value Rs. |a| has been raised and your current outstanding is Rs. |OSC|";
	
	$DBSMSEscalation_To   =  mysqli_query($a,"SELECT optionvalue FROM mailsms where (fieldsname = 'escalationalertsms') AND (plant_id = '$plant')");
	
	if(mysqli_num_rows($DBSMSEscalation_To) > 0)
	{
	
	while($smsEscalationto = mysqli_fetch_array($DBSMSEscalation_To))
	{
		$DeviceAlertEscalationSMS_To[] = $smsEscalationto;			
	}
	
	foreach($DeviceAlertEscalationSMS_To as $key => $valueSMSEscalationTo)
	{
		 
		$curl=curl_init('https://api-alerts.kaleyra.com/v4/?api_key='.$sms_apikey.'&method=sms&message='.$MessageEscalation.'&to='.$valueSMSEscalationTo['optionvalue'].'&sender='.$sms_senderid);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HEADER, false);
        try{ }
        catch (Exception $e)
        { return $e->getMessage(); }
        
       $res                 = curl_exec($curl);
       $result              = json_decode($res,true);
	   
	   	  
	  if($result['status'] == "OK")  
	  {
		$myfile = fopen("mailsmsLog.txt", "w") or die("Unable to open file!");
		$txt = "------------------------------------------------------------\n Device Alert Escalation SMS sent - ".$valueSMSEscalationTo['optionvalue']." ~ ".date('Y-m-d H:s:i');
		fwrite($myfile, $txt);
		fclose($myfile);
	  }
		else
			{
				$myfile = fopen("mailsmsLog.txt", "w") or die("Unable to open file!");
				$txt = "------------------------------------------------------------\n Device Alert Escalation SMS Not sent - ".$valueSMSEscalationTo['optionvalue']." ~ ".date('Y-m-d H:s:i');
				fwrite($myfile, $txt);
				fclose($myfile);
			}    
	}
	
	 }
	 }
	 

	 

}
		
							
}
?>
	