<?
	$error = 0;
include('check.php'); // Se verifica daca utilizatorul este conectat.
	
include('db.php');

$user = $_SESSION['id']; // user ia valoarea din sesiune

if(isset($_FILES['file']['name'])){


		$name = $_FILES['file']['name'];
        $target_dir = "img";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // selecteaza tipul fisierului
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // extesnsii de fisier valide ex: nume.jpg/png/gif
        $extensions_arr = array("jpg","jpeg","png","gif");

        // verifica daca extensia fisierului corespunde cu extensiile impunse
        if( in_array($imageFileType,$extensions_arr) ){
            
			//redenumesc numele fisierului in unul random
			$temp = explode(".", $_FILES["file"]["name"]); //sterge numele fisierului pana la punct
			$newfilename = mt_rand() . '.' . end($temp); //redenumeste fisierul cu valori numerice random
            move_uploaded_file($_FILES['file']['tmp_name'],'img/'.$newfilename); //muta fisierul redenumit in folderul img
			
			$date = date("Y-m-d H:i:s"); //preia data curenta cu ora si secunda
           
            // introduce imaginea in baza de date
            $query = "INSERT INTO `photos` (`id`, `user_id`, `photo`, `upload_date`) VALUES (NULL, '".$user."', '".$newfilename."', '".$date."'); ";
           
            mysqli_query($con,$query) or die(mysqli_error($con));
			
			
	$error=1; // imaginea a fost incarcata
		}


}
	
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

<body onload='Success()'>

<ul>
  <li><a href="./main.php">Acasa</a></li>  
  
  <li style="float:right"><a class="active" href="./logout.php">Log out</a></li>
</ul>



<br>
<br>
<?
					$poze = ("SELECT * FROM photos WHERE user_id='$user'"); //cauta in baza de date dupa poze
					$result_poze = mysqli_query($con, $poze);
					
					$nr_poze = mysqli_num_rows($result_poze); //numar cate poze are utilizatorul
					
					if(!isset($nr_poze) ||  $nr_poze == 0) //verifica daca exista poze
					{
						print "Nu aveti fotografi incarcate";
						}
				
	?>
	<hr>
<p>Galeria ta contine <? print $nr_poze; ?> incarcari.</p>

<hr>
<center>
	Incarcare imagine<br><br>
<form name="registration" action="" method="post" enctype='multipart/form-data' autocomplete="off">
	<input type="file" id="file" name='file' onchange="form.submit()">
	
	</form>
	<? if($error == 1) print "<b><p id='success'>Imaginea a fost incarcata!</p></b>"; ?>
	</center>
<hr>
<div class="row">
		<?			while($data_poze = mysqli_fetch_array($result_poze)){ // afisez fotografiile
	
?>


  <div class="column">
    <div class="card">
      <img src="./img/<? print $data_poze['photo']; ?>" height="106" width="405" onmouseover= "this.src='./img/<? print $data_poze['photo'];?>';this.width=445;this.height=110;" onmouseout="this.width=405;this.height=106"/>
      <p>Incarcata la : <? print $data_poze['upload_date'] ?></p>
      <p>URL direct: <input type="text" value="./proiect_edw/img/<? print $data_poze['photo']?>" id="adresa_url">
<button onclick="copiere_link()">Copiaza link</button></p>
    </div>
  </div>

  



	<script>
	function Success() {
  document.getElementById("success").style.color = "green"; 
setTimeout(function(){  document.getElementById("success").innerHTML = ""; }, 3000);
 
  
}
	
function copiere_link() {
  var copyText = document.getElementById("adresa_url");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Adresa a fost copiata");
}
</script>				<?}?>
</div>
</body>