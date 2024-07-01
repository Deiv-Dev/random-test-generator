<?php

namespace training;

use PDO;
use Exception;

$host = '127.0.0.1';
$db = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    die('Could not connect to the database: ' . $e->getMessage());
}

echo "Press \n";
$option = readline("1. Login or 2. Register: ");

try {
    $username = readline("What is your username: ");
    $password = readline("What is your password: ");

    if ($option == 1) {
        login($username, $password, $pdo);
    } elseif ($option == 2) {
        register($username, $password, $pdo);
    } else {
        throw new Exception('Invalid option selected.');
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

function register(string $username, string $password, PDO $pdo): void
{
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$username, $hashedPassword]);
        echo "Registration successful!\n";
    } catch (Exception $e) {
        echo "Error during registration: " . $e->getMessage() . "\n";
    }
}

function login(string $username, string $password, PDO $pdo): void
{
    try {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo "User logged in successfully!\n";
        } else {
            throw new Exception('Invalid username or password.');
        }
    } catch (Exception $e) {
        echo "Error during login: " . $e->getMessage() . "\n";
    }
}
