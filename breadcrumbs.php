<?php

// Constants
define('CSV_FILE', 'data.csv');

// Load CSV data
$data = loadCsvData(CSV_FILE);

// Generate breadcrumbs
$output = generateBreadcrumbs($data);

// Initialize an empty array to store CSV data
    $data = [];

    // Open the CSV file for reading
    $fh = fopen($file, 'r') or die("Error opening $file");

    // Loop through each line in the CSV file
    while (($row = fgetcsv($fh)) !== false) {
        // Check if the row has at least three columns (ID, Parent ID, Name)
        if (count($row) < 3) {
            continue; // Skip rows with insufficient data
        }

        // Extract ID, Parent ID, and Name from the current row
        $id = $row[0];
        $data[$id] = [
            'parent_id' => $row[1],
            'name' => $row[2]
        ];
    }

    // Close the CSV file
    fclose($fh);

    // Return the loaded CSV data
    return $data;
}


// Generate breadcrumb trails
function generateBreadcrumbs($data) {
    // Initialize an empty array to store breadcrumb trails
    $output = [];

    // Loop through each item in the $data array
    foreach ($data as $id => $dept) {
        // Initialize an empty array to store the breadcrumb trail for the current item
        $trail = [];
        $current = $id;

        // Continue looping until reaching the root (when $current is falsy)
        while ($current && isset($data[$current])) {
            // Extract the name of the current item
            $name = $data[$current]['name'];
            // Prepend the item's ID and name to the breadcrumb trail
            array_unshift($trail, "[$current] $name");
            // Move to the parent item
            $current = $data[$current]['parent_id'];
        }

        // Store the breadcrumb trail for the current item in the $output array
        $output[$id] = $trail;
    }

    // Return the generated breadcrumb trails
    return $output;
}

// Output breadcrumbs
function outputBreadcrumbs($breadcrumbs) {
    // Loop through each set of breadcrumbs and display them
    foreach ($breadcrumbs as $id => $trail) {
        // Display the breadcrumb trail for each item, separated by ' > '
        echo "<br />";
        echo implode(" > ", $trail) . PHP_EOL;
    }
}
?>
