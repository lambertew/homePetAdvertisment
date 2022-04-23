<?php

    session_start();
    session_cache_expire(30);
    include_once('database/dbPetPost.php');
    include_once('domain/PetPost.php');
		include ('petPost.php');
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
					<option value="" disabled selected hidden>Select a Pet-Type</option>
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
							$result_string = "Pet ";
							$result_string .= $x + 1;
		          if ($approval == 1) {?>
								<?php petPostTemplate($petposts[$x], $result_string); ?>
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
</body>
