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
			<form action="" method="GET" name="">
				<table>
					<tr>
						<td><input type = "text" name="k" placeholder="Search Pet Posts" autocomplete="off"></td>
						<td><input type = "submit" name="" value="Search"></td>
					</tr>
				</table>
			</form>
		</center>
		<?php
		if (isset($_GET['k']) && $_GET['k'] != '') {
		    $name = $_GET['k'];
		    $petposts = retrieve_petpost_by_petname($name);
		    if (!$petposts) {
		        echo "No Results Found";
		    } else {
		        for ($x = 0; $x < sizeof($petposts); $x++) {
		          $ownerid = $petposts[$x]->get_owner_id();
		          $petname = $petposts[$x]->get_pet_name();
		          $pettype = $petposts[$x]->get_pet_type();
		          $petstory = $petposts[$x]->get_pet_story();
		          $petpicture = $petposts[$x]->get_pet_picture();
		          echo "$ownerid, $petname, $pettype, $petstory\n";
		        }
		        ?>
		        <html>
		        <div>
		        	<img src="<?php echo htmlspecialchars($petpicture); ?>" alt="test" width="200" height="200"/>
		        </div>
		        </html>
		        <?php
		    }
		} else {
		    echo "No Results Found";
		}
		?>
	</div>
</div>
<?php include_once('footer.inc')?>
</body>
