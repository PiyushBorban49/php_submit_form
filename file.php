<?php
// Initialize result and color variables
$result = "";
$color = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected country value from the form
    $country = $_POST['Countries'];
    
    // Set the result message and color based on the selected country
    if ($country == 1) {
        $result = "Visa required for most applicants.";
        $color = "green";
    } elseif ($country == 2) {
        $result = "Visa required unless you have an eTA.";
        $color = "green";
    } elseif ($country == 3) {
        $result = "Visa required before travel.";
        $color = "green";
    } elseif ($country == 4) {
        $result = "Visa depends on the duration of stay.";
        $color = "green";
    } elseif ($country == 5) {
        $result = "eVisa available for eligible travelers.";
        $color = "green";
    } elseif ($country == 6) {
        $result = "Please select a country.";
        $color = "red";
    } else {
        $result = "Please select a country.";
        $color = "red";
    }
    echo "<div class='result' style='color: $color;'>$result</div>";
}
?>