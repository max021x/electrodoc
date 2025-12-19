<?php

require_once 'bootstrap.php';

use Core\App;

$db = App::get('database');

$schemaFile = 'database/schema.sql';
$sql = file_get_contents($schemaFile);

//down 
try {
    $tables = ['contactmessages', 'comments', 'posts', 'categories', 'users'];
    foreach ($tables as $table) {
        $db->query("DROP TABLE IF EXISTS $table");
    }
    echo "Dropped all tables\n";
} catch (\Exception $e) {
    echo "Error loading schema: " . $e->getMessage() . "\n";
}



// up 
try {
    $parts = array_filter(explode(';', $sql));

    foreach ($parts as $sqlPart) {
        $db->query($sqlPart);
    }

    echo "Schema loaded successfully\n";
} catch (Exception $e) {
    echo "Error loading schema: " . $e->getMessage() . "\n";
}
