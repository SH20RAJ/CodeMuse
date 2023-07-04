<?php
if(isset($_GET['p'])){
  echo $_GET['p'];
}
$url = "https://www.sitepoint.com/blog/";

$content = file_get_contents($url);

if ($content === false) {
    // Error handling if the content retrieval fails
    echo "Failed to retrieve the content.";
} else {
    // Display the retrieved content
    echo $content;
}
?>
