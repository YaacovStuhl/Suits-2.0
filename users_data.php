<?php
// Simple file-based user storage system
// In a real application, this would be a database

function getUsers() {
    $users_file = 'users.json';
    
    if (file_exists($users_file)) {
        $data = file_get_contents($users_file);
        return json_decode($data, true) ?: [];
    }
    
    return [];
}

function saveUsers($users) {
    $users_file = 'users.json';
    return file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT));
}

function addUser($username, $password, $email, $first_name, $last_name) {
    $users = getUsers();
    
    // Check if username already exists
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return false; // Username already exists
        }
    }
    
    // Add new user
    $users[] = [
        'username' => $username,
        'password' => $password, // In production, this should be hashed
        'email' => $email,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    return saveUsers($users);
}

function validateUser($username, $password) {
    $users = getUsers();
    
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            return $user;
        }
    }
    
    return false;
}

// Initialize with default users if file doesn't exist
if (!file_exists('users.json')) {
    $default_users = [
        [
            'username' => 'admin',
            'password' => 'password123',
            'email' => 'admin@simplysuits.com',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'username' => 'user1',
            'password' => 'userpass1',
            'email' => 'user1@simplysuits.com',
            'first_name' => 'User',
            'last_name' => 'One',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'username' => 'user2',
            'password' => 'userpass2',
            'email' => 'user2@simplysuits.com',
            'first_name' => 'User',
            'last_name' => 'Two',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'username' => 'manager',
            'password' => 'managerpass',
            'email' => 'manager@simplysuits.com',
            'first_name' => 'Manager',
            'last_name' => 'User',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'username' => 'customer',
            'password' => 'customerpass',
            'email' => 'customer@simplysuits.com',
            'first_name' => 'Customer',
            'last_name' => 'User',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ];
    
    saveUsers($default_users);
}
?>
