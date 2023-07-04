<?php
$url = "https://dev.to/sh20raj/webscrapperjs-get-contenthtml-of-any-website-without-being-blocked-by-cors-even-using-javascript-by-whollyapi-42l7";

$content = file_get_contents($url);

if ($content === false) {
    // Error handling if the content retrieval fails
    echo "Failed to retrieve the content.";
} else {
    // Display the retrieved content
    echo $content;
}
?>
