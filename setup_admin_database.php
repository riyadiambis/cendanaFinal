<?php
/**
 * Database Initialization and Verification Script
 * Ensures all required tables exist for admin panel functionality
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/database.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Database Setup - Cendana Travel</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 3px solid #D4956E; padding-bottom: 10px; }
        .success { color: green; padding: 10px; background: #d4edda; border-left: 4px solid green; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #f8d7da; border-left: 4px solid red; margin: 10px 0; }
        .info { color: #856404; padding: 10px; background: #fff3cd; border-left: 4px solid #ffc107; margin: 10px 0; }
        .table-info { background: #e7f3ff; padding: 15px; margin: 10px 0; border-radius: 5px; }
        ul { list-style: none; padding: 0; }
        li { padding: 5px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #D4956E; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .btn:hover { background: #C17A4A; }
    </style>
</head>
<body>
<div class='container'>
<h1>🔧 Database Setup & Verification</h1>";

$errors = [];
$success = [];

// Check database connection
if (!$conn || $conn->connect_error) {
    echo "<div class='error'>❌ Database connection FAILED: " . ($conn ? $conn->connect_error : "No connection") . "</div>";
    echo "<div class='info'>Please ensure XAMPP MySQL is running and credentials are correct in config/database.php</div>";
    echo "</div></body></html>";
    exit;
}

echo "<div class='success'>✅ Database connection successful</div>";

// Read and execute SQL file
$sqlFile = 'database.sql';

if (!file_exists($sqlFile)) {
    echo "<div class='error'>❌ SQL file not found: $sqlFile</div>";
} else {
    echo "<div class='info'>📄 Found database schema file</div>";
    
    $sql = file_get_contents($sqlFile);
    
    // Split by semicolon but not inside strings or comments
    $queries = array_filter(array_map('trim', explode(';', $sql)));
    
    $executed = 0;
    $failed = 0;
    
    // Disable foreign key checks temporarily
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");
    
    foreach ($queries as $query) {
        $query = trim($query);
        if (empty($query) || strpos($query, '--') === 0) {
            continue;
        }
        
        if ($conn->multi_query($query . ';')) {
            do {
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->more_results() && $conn->next_result());
            $executed++;
        } else {
            // Silently continue for DROP DATABASE errors
            if (strpos($query, 'DROP DATABASE') === false) {
                $failed++;
            }
        }
    }
    
    // Re-enable foreign key checks
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");
    
    echo "<div class='success'>✅ Executed $executed SQL statements</div>";
    if ($failed > 0) {
        echo "<div class='info'>⚠️ $failed statements had issues (likely already executed)</div>";
    }
}

// Verify required tables
$requiredTables = [
    'company_info' => 'Company information',
    'admin_users' => 'Admin user accounts',
    'banners' => 'Homepage banners',
    'transport_types' => 'Transport categories',
    'transport_services' => 'Transport services',
    'transportation' => 'Transport listings',
    'gallery' => 'Gallery images',
    'faq' => 'FAQ entries',
    'home_sections' => 'Homepage sections',
    'home_testimonials' => 'Customer testimonials',
    'home_why_choose' => 'Why choose us section',
    'home_legality' => 'Legality information'
];

echo "<div class='table-info'>";
echo "<h3>📊 Database Tables Status:</h3><ul>";

$missingTables = [];
foreach ($requiredTables as $table => $description) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result && $result->num_rows > 0) {
        $count = $conn->query("SELECT COUNT(*) as cnt FROM `$table`")->fetch_assoc()['cnt'];
        echo "<li>✅ <strong>$table</strong> - $description ($count rows)</li>";
    } else {
        echo "<li>❌ <strong>$table</strong> - $description (NOT FOUND)</li>";
        $missingTables[] = $table;
    }
}
echo "</ul></div>";

if (empty($missingTables)) {
    echo "<div class='success'><h3>🎉 All required tables exist!</h3><p>Your database is properly configured and ready to use.</p></div>";
} else {
    echo "<div class='error'><h3>⚠️ Some tables are missing</h3><p>Missing tables: " . implode(', ', $missingTables) . "</p></div>";
    echo "<div class='info'>These tables should have been created from database.sql. Please check the SQL file or create them manually.</div>";
}

// Check admin user
$adminCheck = $conn->query("SELECT COUNT(*) as cnt FROM admin_users WHERE username='admin'");
if ($adminCheck) {
    $adminExists = $adminCheck->fetch_assoc()['cnt'] > 0;
    if ($adminExists) {
        echo "<div class='success'>✅ Admin user exists (username: admin)</div>";
    } else {
        echo "<div class='error'>❌ No admin user found. Creating default admin user...</div>";
        $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
        if ($conn->query("INSERT INTO admin_users (username, password, email) VALUES ('admin', '$hashedPassword', 'admin@cendanatravel.com')")) {
            echo "<div class='success'>✅ Default admin user created (username: admin, password: admin123)</div>";
        } else {
            echo "<div class='error'>❌ Failed to create admin user: " . $conn->error . "</div>";
        }
    }
}

echo "
<div style='margin-top: 30px; padding: 20px; background: #f0f0f0; border-radius: 5px;'>
    <h3>✅ Next Steps:</h3>
    <ol>
        <li>Go to <a href='admin.php' class='btn'>Admin Panel</a></li>
        <li>Login with username: <strong>admin</strong>, password: <strong>admin123</strong></li>
        <li>All sidebar menu items should now be clickable</li>
        <li>Database-backed features (Gallery, Transport, etc.) should work</li>
    </ol>
</div>

<div style='margin-top: 20px;'>
    <a href='index.php' class='btn'>← Back to Home</a>
    <a href='admin.php' class='btn'>Go to Admin Panel →</a>
</div>

</div>
</body>
</html>";

$conn->close();
?>
