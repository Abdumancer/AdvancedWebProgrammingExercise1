<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'GraduateThesis.php';

function fetchData($number) {
    $url = "https://stup.ferit.hr/zavrsni-radovi/page/$number/";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        die("cURL error: " . curl_error($ch));
    }

    curl_close($ch);

    if (empty($html)) {
        die("Fetched HTML content is empty. Please check the URL.");
    }

    return $html;
}

for ($i = 2; $i <= 6; $i++) {
    $html = fetchData($i);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $posts = $xpath->query("//article[contains(@class, 'fusion-post-medium')]");

    echo "<h2>Page $i Thesis HTML Code:</h2>";
    foreach ($posts as $post) {
        echo "<pre style='white-space: pre-wrap; word-break: break-all; background: #f4f4f4; border:1px solid #ccc; padding:10px;'>";
        echo htmlspecialchars($dom->saveHTML($post));
        echo "</pre>";
    }
}
?>