<?php
// Simple Deployment Script
// Call this via https://connekoptic.ca/deploy.php?key=ChangeThisSecretKey

$secret_key = 'ChangeThisSecretKey';

if (!isset($_GET['key']) || $_GET['key'] !== $secret_key) {
    http_response_code(403);
    die('Access Denied');
}

echo "<h2>Starting Deployment...</h2><pre>";

// Navigate to project root (one level up from public)
// And run git pull. 
// Note: SSH keys must be configured for the www-data/user running PHP, 
// OR use HTTPS with token in remote URL (which we configured previously).
$output = shell_exec('cd .. && git pull origin main 2>&1');
echo htmlspecialchars($output);

// Optional: Install dependencies if package.json changed
// $output_npm = shell_exec('cd .. && npm install 2>&1');
// echo htmlspecialchars($output_npm);

// Optional: Build (WARNING: Heavy on shared hosting)
// $output_build = shell_exec('cd .. && npm run build 2>&1');
// echo htmlspecialchars($output_build);

echo "</pre><h2>Done!</h2>";
