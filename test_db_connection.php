<?php
// Test Database Connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing Database Connection</h2>";

// Test connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'cendana_travel';

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("<p style='color: red;'>Connection FAILED: " . $conn->connect_error . "</p>");
}

echo "<p style='color: green;'>✓ MySQL connection successful</p>";

// Check if database exists
$result = $conn->query("SHOW DATABASES LIKE '$dbname'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✓ Database '$dbname' exists</p>";
    
    // Connect to database
    $conn->select_db($dbname);
    
    // Check tables
    $tables = ['banners', 'transportation', 'gallery', 'faq', 'company_info'];
    echo "<h3>Checking Tables:</h3><ul>";
    
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows > 0) {
            $count = $conn->query("SELECT COUNT(*) as cnt FROM $table")->fetch_assoc()['cnt'];
            echo "<li style='color: green;'>✓ Table '$table' exists ($count rows)</li>";
        } else {
            echo "<li style='color: red;'>✗ Table '$table' NOT FOUND</li>";
        }
    }
    echo "</ul>";
    
} else {
    echo "<p style='color: red;'>✗ Database '$dbname' NOT FOUND</p>";
    echo "<p>Creating database...</p>";
    
    if ($conn->query("CREATE DATABASE $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
        echo "<p style='color: green;'>✓ Database created successfully</p>";
    } else {
        echo "<p style='color: red;'>Failed to create database: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
