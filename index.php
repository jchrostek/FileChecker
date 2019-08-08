<?php
/**
 * FileChecker
 * 
 * With FileChecker, you can quickly check if a file exists - even if there are many,
 * e.g. by preparing data for importing products into WooCommerce.
 * 
 * Before running the script, define the $files_list variable.
 * Sample data entry key:
 * string 'http://domain.com/image.jpg;http://domain.com/image2.jpg'
 * 
 * @author Jakub Chrostek
 * @version 0.1
 */
//file list to check
$files_list = '';

//you can change data separator on any character
$file_array = explode(";", $files_list);

echo 'I start check '.count( $file_array ).' files<br/><br/>';

$good_file = 0;
$wrong_file = 0;
$all_file = 0;

foreach( $file_array as $key => $file_url ):
  $all_file++;
  if( does_url_exists( $file_url ) ):
    $good_file++;
  else:
    $wrong_file++;
    echo 'ERROR: file ['.($key + 1).'] '.$file_url.' do not exists<br/>';
  endif;
endforeach;

echo '<br/>I checked '.$all_file.' files, '.$good_file.' files are a good and <strong>'.$wrong_file.'</strong> files do not exist.';

function does_url_exists($url) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_exec($ch);
  $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  if ($code == 200) {
      $status = true;
  } else {
      $status = false;
  }
  curl_close($ch);
  return $status;
}
?>