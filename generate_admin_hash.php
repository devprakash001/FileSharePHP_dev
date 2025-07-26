<?php
// Run this script in your browser or CLI to get a bcrypt hash for 'admin'
$hash = password_hash('admin', PASSWORD_DEFAULT);
echo 'Bcrypt hash for "admin":<br><pre>' . htmlspecialchars($hash) . '</pre>'; 