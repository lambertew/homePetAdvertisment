<?php
/**
 * Simple Templating function
 *
 * @param $pet_img   - Path to the PHP file that acts as a template.
 * @param $content   - Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 */

include_once('database/dbPetPost.php');
include_once('domain/PetPost.php');

function petPostTemplate( $pet, $postDesc ){
  // ensure the file exists
  $petname = $pet->get_pet_name();
  $pettype = $pet->get_pet_type();
  $petstory = $pet->get_pet_story();
  $petpicture = $pet->get_pet_picture();


  // Commenting this out until we have a set format for pulling the pet posts from the database, might actually do that in this file
  // Make values in the associative array easier to access by extracting them
  // if ( is_array( $content ) ){
  //   extract( $content );
  // }

  ob_start();
  echo '
    <div class="mySlides fade">
      <fieldset>
        <legend>'.$postDesc.'</legend>
          <table height="auto" width="auto" style="margin-left:auto; margin-right:auto">
          <tr>
            <td rel="stylesheet" href="styles.css">
              <img src="'.$petpicture.'" width="auto"; height = "500"; margin = "auto"; />
            </td>
            <td class="td">
              <table>
                <tr>
                  <td>
                    <h1 style="font-size: 40px;"> Pet Name: '.$petname.'</h1>
                    <h2 style="font-size: 20px;"> Pet Type: '.$pettype.'</h2>
                    <h2 style="font-size: 20px;"> Pet Story: </h2> 
                    <p style="font-size: 20px;">'.$petstory.'</p>
                </td>
              </table>
            </td>
          </tr>
        </table>  
        </legend>
    </fieldset>
    </div>'
    ;
}
?>