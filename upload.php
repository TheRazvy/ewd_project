<?
include('check.php'); // Se verifica daca utilizatorul este conectat.
	
require('db.php');

$user = $_SESSION['id']; // user ia valoarea din sesiune
	
?>





<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
</style>

















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



<ul>
  <li><a href="./main.php">Acasa</a></li>  
  <li><a href="./register.php">Inregistrare</a></li>
  <li style="float:right"><a class="active" href="./logout.php">Log out</a></li>
</ul>



<br>
<br>
<?
				
if(isset($_FILES['file']['name'])){


   $name = $_FILES['file']['name'];
        $target_dir = "img";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            
			//rename in random
			$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = mt_rand() . '.' . end($temp);
            move_uploaded_file($_FILES['file']['tmp_name'],'img/'.$newfilename);
			$date = date("Y-m-d H:i:s");
           
            // Insert record
            $query = "INSERT INTO `photos` (`id`, `user_id`, `photo`, `upload_date`) VALUES (NULL, '".$user."', '".$newfilename."', '".$date."'); ";
           
            mysqli_query($con,$query) or die(mysqli_error($con));
			
			
	print "<b>Imaginea a fost incarcata</b>";
		}


}

				
	?>
<form name="registration" action="" method="post" enctype='multipart/form-data' autocomplete="off">
	<input type="file" id="file" name='file' onchange="form.submit()">
	
	</form>