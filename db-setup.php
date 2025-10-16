<?php
/**
 * Database setup and compatibility script for WordPress on Render
 * This script helps handle database connection issues
 */

// Check if we're running on Render
if (getenv('RENDER')) {
    // Log database connection details for debugging
    error_log("Database connection attempt:");
    error_log("DB_HOST: " . getenv('DATABASE_HOST'));
    error_log("DB_NAME: " . getenv('DATABASE_NAME'));
    error_log("DB_USER: " . getenv('DATABASE_USER'));
    error_log("DB_PORT: " . getenv('DATABASE_PORT'));
    
    // Test database connection
    $host = getenv('DATABASE_HOST');
    $port = getenv('DATABASE_PORT') ?: 5432; // PostgreSQL default port
    $dbname = getenv('DATABASE_NAME');
    $user = getenv('DATABASE_USER');
    $password = getenv('DATABASE_PASSWORD');
    
    // Try to connect to PostgreSQL first
    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        error_log("PostgreSQL connection successful");
        
        // Check if we need to install PG4WP (PostgreSQL for WordPress)
        if (!file_exists('/var/www/html/wp-content/pg4wp')) {
            error_log("PostgreSQL detected but PG4WP not found. WordPress needs MySQL/MariaDB or PG4WP plugin.");
        }
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
    }
}
?>