<?php
if(isset($_GET['p'])){
  die();
}
function replaceAllLinks($html) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Disable error reporting
    $dom->loadHTML($html);
    libxml_clear_errors(); // Clear any existing errors

    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query("//*[@id='main-content']//a");

    foreach ($nodes as $node) {
        $href = $node->getAttribute('href');
        $modifiedUrl =  ltrim($href, '/');
        $node->setAttribute('href', $modifiedUrl);
    }

    $modifiedHtml = $dom->saveHTML();
    return $modifiedHtml;
}

$url = 'https://www.sitepoint.com/blog/';

// Fetch HTML content from the URL
$html = file_get_contents($url);

// Check if HTML content is successfully fetched
if ($html !== false) {
    // Apply replacements
    $modifiedHtml = replaceAllLinks($html);
    
    // Output the modified HTML
    echo $modifiedHtml;
} else {
    // Error handling if fetching HTML content fails
    echo "Failed to fetch HTML content from the URL.";
}
