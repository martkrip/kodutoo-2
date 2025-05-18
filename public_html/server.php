<?php
if(isset($_POST["save"]) && !empty($_POST["save"])){
    saveToFile($_POST["save"]);
}

//chatgpt prompt my database.txt has this:{"content": [{"name":"Martin","score":"3.94"}]}
function saveToFile($jsonString) {
    $newResult = json_decode($jsonString, true);

    // Check if file exists and read current content
    $filePath = "database.txt";
    $results = [];

    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        $decoded = json_decode($fileContent, true);
        if (isset($decoded["content"]) && is_array($decoded["content"])) {
            $results = $decoded["content"];
        }
    }

    // Append new result
    $results[] = $newResult;

    // Wrap results in the correct format
    $finalData = [
        "content" => $results,
        "last_modified" => time()
    ];

    // Save back to file
    file_put_contents($filePath, json_encode($finalData, JSON_PRETTY_PRINT));
}
?>