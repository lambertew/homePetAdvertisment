<?php

    session_start();
    session_cache_expire(30);
    include_once('database/dbPetPost.php');
    include_once('domain/PetPost.php');
?>


<head>
	<link rel="stylesheet" href="styles.css" type="text/css" />
</head>
<body>
<div id="container">
	<?php include('header.php')?>
	<div id="content">
		<center>
			<form action="" method="POST" name="">
				<select name="pettype">
					<option value="Dog">Dog</option>
					<option value="Cat">Cat</option>
					<option value="Other">Other</option>
				</select>
				<input type="submit" name="submit" value="Select" />
			</form>
		</center>
		<?php 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  $type = $_POST['pettype'];
		  $petposts = retrieve_petpost_by_pettype($type);
		  if (!$petposts) {
		      echo "No results found";
		  } else {
		      for ($x = 0; $x < sizeof($petposts); $x++) {
		          $approval = $petposts[$x]->get_approved();
		          $petname = $petposts[$x]->get_pet_name();
		          $petstory = $petposts[$x]->get_pet_story();
		          $petpicture = $petposts[$x]->get_pet_picture();
		          if ($approval == 1) {?>
		          	<fieldset style="text-align:center";>
		          		<legend><b><?php echo $petname ?></b></legend>
		          		<div style="display:inline-block; margin:auto;">
		          			<br><img src="<?php echo htmlspecialchars($petpicture); ?>" alt="test" width="200" height="200"/>
		            		<p style="text-align:center";><?php echo $petstory?></p>
		          		</div>
		          	</fieldset>
		          <?php
		          } else {
		              continue;
		          }
		      }
		  }
		}
		?>
	</div>
</div>
<?php include_once('footer.inc')?>
</body>
