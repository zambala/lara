<?php
$servername = "localhost";
$username = "alex";
$password = "salvis";
$dbname = "Transactions";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Specify the path to your CSV file
$csvFile = 'sample.csv';

// Open the CSV file for reading
$file = fopen($csvFile, 'r');

// Read and process each line in the CSV file
while (($data = fgetcsv($file, 1000, ',')) !== false) {
    // Assuming the first row contains column headers
    $date = $data[0];
    $checkNumber = $data[1];
    $description = $data[2];
    $amount = $data[3];

    // Replace 'your_table_name' with the actual table name in your database
    // $sql = "INSERT INTO `transactiondata` (Date, `Check #`, Description, Amount) VALUES ('$date', '$checkNumber', '$description', '$amount')";

    // Convert the date format from 'MM/DD/YYYY' to 'YYYY-MM-DD'
$convertedDate = date('Y-m-d', strtotime($date));

// Replace 'your_table_name' with the actual table name in your database
$sql = "INSERT INTO `transactiondata` (Date, `Check #`, Description, Amount) VALUES ('$convertedDate', '$checkNumber', '$description', '$amount')";

    // Execute the query
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the file
fclose($file);

// Close the database connection
$conn->close();