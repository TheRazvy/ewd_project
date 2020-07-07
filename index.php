<?
session_start();

require("db.php");

$error=0; // 1 User/parola gresita. 
    
	
if (isset($_POST['email']) && isset($_POST['password']))
{
	$password = md5($_POST['password']);
	$email = $_POST['email']; 
	
		$query_user = "SELECT email, password, id FROM `user` WHERE email='$email' limit 1";
		$result_user = mysqli_query($con,$query_user) or die(mysqli_error($con));
		$data_user = $result_user->fetch_array(MYSQLI_ASSOC);
	
	
	if ($data_user['password'] == $password )// verifica daca parola introdusa de utilizator este aceeasi cu cea din baza de date
	{
		$_SESSION['id'] = $data_user['id']; // Creez sesiunea ID care va lua valorea id-ului utilizatorului din baza de date
		
		header("Location: main.php"); // redirectionez utilizatorul catre galerie
		
		
		
		}else {$error = 1;} // daca nu este buna parola atunci afisez mesaj de eroare
		if(!isset($data_user)){$error =1;} // daca nu este gasit utilizatorul in baza de date afisez o eroare
		
	
}
	
	
    
    
    
    
?>


<head>
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
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
  width: 50%;
  margin: auto;
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










</head>
<body>
<!-- meniul -->
<ul>
  <li><a href="./index.php">Acasa</a></li>
 
  <li><a href="./register">Inregistrare</a></li>
 
</ul>

<!-- end meniu -->






<?php
$mesaj = " ";

if($error==1) // afisez eroarea
	$mesaj = "<b><font color='red'>Email sau prola incorecta</font></b><hr>";


	
?>







<form action="" method="post" style="border:1px solid #ccc">
  <div class="container">
   <center> <h1>Conectare</h1>
    <p>Inainte de a putea folosi serviciile de gazduire imagini trebuie sa te inregistrezi sau sa te conectezi.</p>
    <hr>
	<?print $mesaj;?>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    
    <p>Conectanadu-ma sunt deacord sa folosesc serviciul in scop propriu si declar ca nu voi incarca continut inadecvat.</p>

    <div class="clearfix">
      <button type="button" onclick="redirectionare()" class="cancelbtn">Inregistrare</button>
      <button type="submit" class="signupbtn">Conectare</button>
    </div>
 </center> </div>
</form>






<script>
	function redirectionare() {
  location.replace("./proiect_edw/register")
}
</script>






</body>
</html>