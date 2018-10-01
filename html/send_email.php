<?php  
   

/*  

 *  Specify the field names that are in the form. This is meant  

 *  for security so that someone can't send whatever they want  

 *  to the form.  

 */ 

$allowedFields = array(  

    'f_name', 'l_name', 'email', 'user_type', 'phone', 'contractor', 'supervisor', 'tasks'    

);  

   

// Specify the field names that you want to require...  

$requiredFields = array(  


    'f_name', 'l_name', 'email', 'user_type', 'phone', 'tasks' 


);  

   

// Loop through the $_POST array, which comes from the form...  

$errors = array();  

foreach($_POST AS $key => $value)  

{  

    // first need to make sure this is an allowed field  

    if(in_array($key, $allowedFields))  

    {  

        $$key = $value;  

   

        // is this a required field?  

        if(in_array($key, $requiredFields) && $value == '') $errors[] = "The field $key is required.";  


    } 

}  

   



// were there any errors?  

if(count($errors) > 0)  

{  

    $errorString = '<p style="font-family:verdana;color:red;">There was an error processing the form.</p>';  

    $errorString .= '<ul>';  

    foreach($errors as $error)  

    {  

        $errorString .= "<li>$error</li>";  

    }  

    $errorString .= '</ul>';  

   

    // display the previous form  

    include 'tots_access_form.html';  

 } 

else 
 


	{

date_default_timezone_set('America/New_York');


$subject = "TOTS Access Request Submitted by ".$_POST['f_name']. " " .$_POST['l_name']."";
$to_mail = 'scitechpmo@gst.com,mhanderhan@meesha.net';

$uploadedFile = $urlPath . $uniqVar;

$email_message = "<b>Full Name:</b> ".$_POST['f_name']. " " .$_POST['l_name']."<br>";
$email_message .= "<b>Email:</b> ".$_POST['email']."<br>";
$email_message .= "<b>Telephone:</b> ".$_POST['phone']."<br>";
$email_message .= "<b>User Type:</b> ".$_POST['user_type']."<br>";
$email_message .= "<b>If sub-contractor, company's name:</b> ".$_POST['contractor']."<br>";
$email_message .= "<b>Supervisor:</b> ".$_POST['supervisor']."<br>";
$email_message .= "<b>Tasks:</b><br> ";

 $aCountries = $_POST['tasks'];
 $nCountries = count($aCountries);

    for($i=0; $i < $nCountries; $i++)
    {
		$email_message .= $aCountries[$i] . "<br>";

    }



$email_message .= "<br><br>INTERNAL DATA (fill out and forward to TECH ADMIN):<br> Approved/Denied by: <br> Approved/Denied date: <br>If approved, list TASKS/SUBTASKS:<br>If denied, explain:<br><br>";


$headers = 'From: scitechpmo@gst.com' . "\r\n" .
    'Reply-To: scitechpmo@gst.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . "\r\n" . 'Content-Type: text/html; charset=\"iso-8859-1\"';


@mail($to_mail, $subject, $email_message, $headers);
						
							  
header ("location:thank_you.html");
	}

 ?> 
