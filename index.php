

<?php
error_reporting(0);
// define variables and set to empty values
$name=$gender=$birthdate=$username=$password=$password1=$email=$postal="";
$homephone=$cellphone=$card=$cardexpiry=$salary=$gpa=$website="";
$name=$_REQUEST["name"];
$gender=$_REQUEST["gender"];
$birthdate=$_REQUEST["birthdate"];
$username=$_REQUEST["username"];
$password1=$_REQUEST["passwor1"];
$password2=$_REQUEST["password2"];
$email=$_REQUEST["email"];
$postal=$_REQUEST["postal"];
$homephone=$_REQUEST["homephone"];
$cellphone=$_REQUEST["cellphone"];
$card=$_REQUEST["card"];
$cardexpiry=$_REQUEST["cardexpiry"];
$salary=$_REQUEST["salary"];
$gpa=$_REQUEST["gpa"];
$website=$_REQUEST["website"];
$isPost= $_SERVER["REQUEST_METHOD"]=="POST";
$isGet = $_SERVER["REQUEST_METHOD"]=="GET";
$phonePattern='/^[\d]{2}[\s]{0,1}[\d]{7}$/';
$mailPattern='/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
$cardexpiryPattern='/^(([0-2][0-9])|([3][0-1]))[\.]([0-1][0-2])[\.]((?:19|20)\d{2})$/';
$moneyAmountPattern='/^(?=.)(\d{1,3}(,\d{3})*)?(\.\d+)?$/'; 
$moneyAmountPattern1='/^(\d+|\d{1,3}(,\d{3})*)(\.\d+)?$/';
$gpaPattern='/^4\.(50|[0-4][0-9])|[0-3]\.\d{2}$/';
$urlPattern='/(ftp|http|https):\/\/(\w+:{0,1}\	w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/';
$passwordCase1Pattern='/\A(?=\w{6,10}\z)/'; ## the password must have between six and ten word characters \w
$passwordCase2Pattern='/\A(?=\w{6,10}\z)(?=[^a-z]*[a-z])/'; ##at least one lowercase character [a-z]
$passwordCase3Pattern='/\A(?=\w{6,10}\z)(?=[^a-z]*[a-z])(?=(?:[^A-Z]*[A-Z]){3})/'; ##must include at least three uppercase characters [A-Z]
$passwordCase4Pattern='/\A(?=\w{6,10}\z)(?=[^a-z]*[a-z])(?=(?:[^A-Z]*[A-Z]){3})(?=\D*\d)/'; ##must include at least one digit \d
$moneyAmountPattern1='/^(\d+|\d{1,3}(,\d{3})*)(\.\d+)?$/';
	
	$isNameError=$isPost && !preg_match('/[a-z]{2,}/i', $name); 
	$isGenderError=$isPost && !$gender;
	$isBirthdateError=$isPost && !$birthdate;
	$isUsernameError=$isPost && !preg_match('/[\w]{5,}/i', $username);
	$isPasswordError=$isPost && !preg_match('/[\w]{8,}/i', $username); ##check for having min. 8 characters
	$isPasswordError1=  ($password1!=$password2);	
	$isEmailError=$isPost && !preg_match($mailPattern, $email);
	$isPostalError=$isPost && !preg_match('/^[\d]{6}$/', $postal);
	$isPhoneError=$isPost && !preg_match($phonePattern, $homephone);
	$isPhoneError1=$isPost && !preg_match($phonePattern, $cellphone);
	$isCardError=$isPost && !preg_match('/^[\d]{4}[\s]{0,1}[\d]{4}[\s]{0,1}[\d]{4}[\s]{0,1}[\d]{4}$/', $card);
	$isCardExpiryError=$isPost && !preg_match($cardexpiryPattern, $cardexpiry);
	$isMoneyAmountError=$isPost && !preg_match($moneyAmountPattern1, $salary);
	$isGpaError=$isPost &&!preg_match($gpaPattern, $gpa);
	$isWebsiteError=$isPost && !preg_match($urlPattern, $website);
	$isMoneyAmountError=$isPost && !preg_match($moneyAmountPattern1, $salary);
	$isPasswordErrorCase1=$isPost &&!preg_match($passwordCase1Pattern, $password1);
	$isPasswordErrorCase2=$isPost &&!preg_match($passwordCase2Pattern, $password1);
	$isPasswordErrorCase3=$isPost &&!preg_match($passwordCase3Pattern, $password1);
	$isPasswordErrorCase4=$isPost &&!preg_match($passwordCase4Pattern, $password1);
	$passwordErrorName='';
	if($isPasswordError){
	$passwordErrorName="Minimum password length is 8!";}
	if($isPasswordErrorCase1){
	$passwordErrorName="The password must have between six and ten word characters!";}
	if($isPasswordErrorCase2){
	$passwordErrorName="The password must include at least one lowercase character!";}
	if($isPasswordErrorCase3){
	$passwordErrorName="The password must include at least three uppercase characters!";}
	if($isPasswordErrorCase4){
	$passwordErrorName="The password must include at least one digit!";}
	$isFormError=$isNameError || $isGenderError || $isBirthdateError || $isUsernameError || $isPasswordError ||$isPasswordError1 || $isPostalError || $isPhoneError || $isPhoneError1 || $isCardError || $isMoneyAmountError|| $isGpaError||$isPasswordErrorCase1 ||$isPasswordErrorCase2 || $isPasswordErrorCase3 ||$isPasswordErrorCase4;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Registration Forms</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
		<style media="screen">
     	 .error 
     	 {
        color: red;			
      	 }
      	</style>
	</head>
	
	<body>

		<?php if($isPost || $isFormError)  { ?>

		<h1>Registration Form</h1>
		<p>
			<center>This form validates user input and then displays <b>"Thank You"</b> page.</center>
			<hr />
		</p>

		<h2>Please, fill below fields correctly</h2>

		<form action="index.php" method="post">

			<fieldset>
				<legend><b><h3>Some personal info here:</h3></b></legend>

					<input type="text" name="name" value="<?= $name ?>" required> Name <br /> 
					<span class="error"><?= $isNameError?"Name should be at least 2 characters! And non-numeric!" : "" ?></span><br />
					
					<input type="text" name="birthdate" value="<?= $birthdate ?>"> Date of birth<br /> <br />
					Your Gender: 
					<label><input type="radio" name="gender" value="<?=$gender ?>"  required> Male</label>
					<label><input type="radio" name="gender" value="<?=$gender ?>"  required> Female</label> <br /> <br />
					
					Your Marital Status:
					<select name="status" required>
						<option disabled selected value> ***Select an option***</option>
    					<option value="single">Single</option>
   						<option value="married">Married</option>
   						<option value="divorced">Divorced</option>
    					<option value="widowed">Widowed</option>
  					</select> 
					<br /><br />

                   	<input type="text" name="salary" placeholder="UZS 1,000,000.00" value="<?= $salary ?>" required> Monthly Salary in UZS (e.g. 200,000.00)<br />
					<span class="error"><?= $isMoneyAmountError?"Please enter in consistent form" : "" ?></span>
					<br />	


					<input type="text" name="gpa" value="<?= $gpa ?>" required> GPA (Ex. 4.00) Scale between [0-4.50]<br />
					<span class="error"><?= $isGpaError?"Please enter the floating point number in range of 0 to 4.5" : "" ?></span>
					<br />	


  					<input type="text" name="addr" value="<?= $addr ?>" required> Address<br />
					<br />
					<input type="text" name="city" value="<?= $city ?>" required> City<br />
					<br />
					<input type="text" name="postal" value="<?= $postal ?>" required> Postal Code (Ex.100174 )<br />
					<span class="error"><?= $isPostalError?"It is not a valid postal code! Please enter digits(6) only" : "" ?></span>
					<br />





			</fieldset>

				&nbsp;
			
			<fieldset>	<legend><b><h3> Username & Password:</h3></b></legend>

					<input type="text" name="username" value="<?= $username?>"  required> Username<br />
					<span class="error"><?= $isUsernameError?"It has to contain at least 5 characters!" : "" ?></span>
					<br />
					
					<input type="password" name="password1" value="<?= $password1 ?>"  required> Password<br />
					<span class="error"><?= $passwordErrorName ?></span> <br />

					<input type="password" name="password2" value="<?= $password2 ?>"  required> Confirm Password<br />
					<span class="error"><?= $isPasswordError1?"Passwords don't match!" : "" ?></span> <br />

					<input type="text" name="email" placeholder="example@company.com" value="<?= $email ?>" required> Email<br />
					<span class="error"><?= $isEmailError?"It is not a valid email!" : "" ?></span> <br />
					
					<input type="text" name="website" placeholder="http://example.com" value="<?= $website ?>" required> Website<br />
					<span class="error"><?= $isWebsiteError?"It is not a valid URL!" : "" ?></span> <br />


			</fieldset>
				<br />


			<fieldset>
					<legend><b><h3> Phone Numbers & Payment Information</h3></b></legend>
					<input type="text" name="homephone" value="<?= $homephone ?>" required> Home Phone number (e.g. 99 8881411)<br />
					<span class="error"><?= $isPhoneError?"It is not a valid phone number! Please enter in 9-digit form" : "" ?></span>
					<br />

					<input type="text" name="cellphone" value="<?= $cellphone ?>" required> Mobile Phone number (e.g. 99 8881411)<br />
					<span class="error"><?= $isPhoneError1?"It is not a valid phone number! Please enter in 9-digit form" : "" ?></span>
					<br />

					<input type="text" name="card" value="<?= $card ?>" required> Credit Card Number (e.g. 1234 1234 1234 1234)<br />
					<span class="error"><?= $isCardError?"It is not a valid credit card number! Please enter in 16-digit form" : "" ?></span>
					<br />
					

					<input type="text" name="cardexpiry" placeholder="DD.MM.YYYY" value="<?= $cardexpiry ?>" required> Credit Card Expiry Date (e.g. 20.03.2019)<br />
					<span class="error"><?= $isCardExpiryError?"It is not a valid date! Please enter valid expiry date" : "" ?></span>
					<br />

			</fieldset>					


            <input type="submit" name="Submit" value="Submit">
		</form>

<?php } 
	if($isGet)
 { 
   ?>
	<h1>Thank you for your submission. Your info as following</h1>
	<ul>
		<li> Your Name:  <?=  $name ?></li>
		<li> Your Gender:  <?=  $gender ?></li>
		<li> Your Birthdate:  <?=  $birthdate ?></li>
		<li> Your Email:  <?=  $email ?></li>
	</ul>
	
    
    <?php } ?>	
		
</body>
</html>		
		
		