<?php
	
	
	$error=0; // daca este setat la 1 exista un cont cu acest email. Daca este 2 parolele nu corespund.  3 Utilizatorul a fost inregistrat.
	require("db.php");
	
	if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmpassword"])) //verifica daca toate campurile au valoare
	{	
		$ver_email = $_POST["email"];
	
		$query_user = "SELECT email FROM `user` WHERE email='$ver_email'";
		$result_user = mysqli_query($con,$query_user) or die(mysqli_error($con));
		$data_user = $result_user->fetch_array(MYSQLI_ASSOC);
		
		if (isset($data_user))
		{ $error = 1;	}
		
		if(!isset($data_user))
		{
			
			
			if(md5($_POST['password']) == md5($_POST['confirmpassword'])){
			
			$email = $_POST["email"];
			$password = md5($_POST["password"]);
 				
				////
					$register="INSERT INTO `user` (`id`, `email`, `password`) VALUES (NULL, '".$email."', '".$password."');";
					mysqli_query($con, $register);
					$error = 3;
				
				
				}
				if(md5($_POST['password']) != md5($_POST['confirmpassword'])){ // compara parolele criptate
				
				$error = 2;
				
				
				}
			
			
			}
	

	}
	
	
	
	
	
	
	
	
	?>


<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}
</style>




<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #fcba03;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>



<ul>
  <li><a href="./index.php">Acasa</a></li>
  <li><a href="./register">Inregistrare</a></li>
 
</ul>




<script>
	
	
	function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Adresa de email este invalida!');
            return false;
        }

        return true;

}
	function redirectionare() {
  location.replace("./proiect_edw")
}
	</script>


<?php
	
	$mesaj=" ";
	if($error==1)
		$mesaj="<b><font color='red'>Un utilizator este inregistrat cu aceasta adresa de email</font></b>";
	if($error==2)
		$mesaj="<b><font color='red'>Parolele nu corespund. Introduceti aceeasi parola!</font></b>";
	if($error==3)
		$mesaj="<b><font color='green'>Ai fost inregistrat cu success! Te poti conecta acum!</font></b>";
	
	
	
	?>




<form action="" method="post" style="border:1px solid #ccc">
  <div class="container">
    <h1>Inregistrare</h1>
    <p>Pentru a putea accesa serviciile noastre trebuie sa te inregistrezi si conectezi!</p>
    <hr>
	<?print $mesaj; //aici am afisat mesajele?>
<hr>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" onblur="validateEmail(this);" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="confirmpassword" required>
    
       
    <p>Prin apasarea butonului de inregistrere, esti de acord cu urmatoarele: <br>- Nu voi posta imagini cu tenta explicita.<br>- Voi folosi serviciul doar in sopul in care a fost propus. <br>- Am sa folosesc serviciul doar in scopuri proprii.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn" onclick="redirectionare()">Conectare</button>
      <button type="submit" class="signupbtn">Inregistrare</button>
    </div>
  </div>
</form>