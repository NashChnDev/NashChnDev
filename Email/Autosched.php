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
	
$currentDate = date('Y-m-d');

$getData = array();
 
$sqlche1=mysqli_query($a,"SELECT * FROM devices where (alert_remaindate = '$currentDate') AND (expirydate >= '$currentDate') AND (status != 'Scraped')");

$sqlche2=mysqli_query($a,"SELECT * FROM devices where (alert_remaindate < '$currentDate') AND (expirydate >= '$currentDate') AND (status != 'Scraped')");

if(mysqli_num_rows($sqlche1) > 0)
{
	$data = $sqlche1;
}
elseif(mysqli_num_rows($sqlche2) > 0)
{
	$data = $sqlche2;
}
	

if(mysqli_num_rows($data) > 0)
{	

$getData=array();
while($getValue = mysqli_fetch_array($data))
{
$getData[] = $getValue;
								
}

	 foreach ($getData as $key => $value) 
	 {
		 
	 	$deviceID               = $value['devices_id'];
		$devices_description    = $value['devices_description'];
		$device_scategory       = $value['device_scategory'];
		$device_sasseterpcode   = $value['device_sasseterpcode'];
		$alert_remaindate       = $value['alert_remaindate'];
		$expirydate             = $value['alert_remaindate'];
		$status     			= "Approach Calibration";
		
			   
	$mail = new PHPMailer;                              
	$mail->isSMTP();                                      
	$mail->Host = 'smtp.gmail.com'; 
	$mail->SMTPAuth = true;                               
	$mail->Username = 'ambalavanan2424@gmail.com';  //'noreply@jkfenner.com';                 
	$mail->Password = 'ifvbdqecesjanlei';	//'F3nn3r@1955';                          
	$mail->SMTPSecure = 'tls';                           
	$mail->Port = '587'; 
	$mail->setFrom('ambalavanan2424@gmail.com', 'ambalavanan2424@gmail.com');  //setFrom('noreply@jkfenner.com', 'JK Fenner - ZingHr');
	   
	   
		$mail->addAddress('ambalavanan@mazeworkssolutions.com', 'Ambalavanan N'); 
		
	
			
	$message='
	<font face="Times New Roman" size="4"  >Dear Sir,</font><br/><br/>
	
	<font face="Times New Roman" size="4" > <b> Your Device ('.$value['devices_id'].') is going to expire. <br/><br/>
	
	<table>
	<thead>
	<tr>
	<th>Device ID</td>
	<th>Device Name</td>
	<th>Device catagory</td>
	<th>Device ERP Code</td>
	<th>Remaining Date</td>
	<th>Expiry Date</td>
	<th>Status</td>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td>'.$deviceID.'</td>
	<td>'.$devices_description.'</td>
	<td>'.$device_scategory.'</td>
	<td>'.$device_sasseterpcode.'</td>
	<td>'.$alert_remaindate.'</td>
	<td>'.$expirydate.'</td>
	<td>'.$status.'</td>
	</tr>
	</tbody>
	
	
	</table> <br>
	
	 Thank you!!!</b></font><br/><br/>
	
	';
	
	$subject='System Alert! - Tool Gauge Application '.date("Y-m-d").' ';
	$body = $message; 
	$mail->Subject = $subject;
	$mail->Body    = $body;
	$mail->IsHTML(true);
	$sendSuccess = $mail->send();
	
	if($sendSuccess) 
		 
	  {
		 echo "SMS sent";
		 

				}
				else
				{
					echo "SMS could not be sent";
				}

		
	} 

}
							
							
}
?>
	