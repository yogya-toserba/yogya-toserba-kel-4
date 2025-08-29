<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_yogya', 'root', '');
$pdo->prepare('INSERT INTO migrations (migration, batch) VALUES (?, 1)')->execute(['2025_08_07_002359_admin']);
echo 'Migration record added successfully!';
