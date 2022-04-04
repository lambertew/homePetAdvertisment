<?php
/**
 * Simple Templating function
 *
 * @param $pet_img   - Path to the PHP file that acts as a template.
 * @param $content   - Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 */
function petPostTemplate( $pet_img, $content ){
  // ensure the file exists
  if ( !file_exists( $pet_img ) ) {
    return '';
  }

  // Commenting this out until we have a set format for pulling the pet posts from the database, might actually do that in this file
  // Make values in the associative array easier to access by extracting them
  // if ( is_array( $content ) ){
  //   extract( $content );
  // }

  ob_start();
  echo '<fieldset>
      <legend>Featured Pet</legend>
        <table height="auto" width="600" style="margin-left:auto; margin-right:auto">
        <tr>
          <td rel="stylesheet" href="styles.css">
            <img src="'.$pet_img.'" width="auto"; height = "500"; margin = "auto"; />
          </td>
          <td class="td">
            <table>
              <tr>
                <td>
                '.$content.'
              </td>
            </tr>
              <tr>
                <td>
                This is emma, she turns 2 in may, she is a heffa. Also
                frick bagel
              </td>
            </tr>
            </table>
          </td>
        </tr>
      </legend>
  </fieldset>';
}
?>