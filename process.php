<?php
session_start();

$users = [
    'admin' => '12345'
];

function validateLogin($username, $password) {
    global $users;
    return isset($users[$username]) && $users[$username] === $password;
}

// Cek apakah diblokir
if (isset($_SESSION['blocked_until']) && time() < $_SESSION['blocked_until']) {
    $sisa = $_SESSION['blocked_until'] - time();
    $_SESSION['error']="Akun diblokir sementara. Coba lagi dalam $sisa detik.";
    header("Location: index.php");
    exit;
}
    
    

// Reset blokir jika waktu sudah lewat
if (isset($_SESSION['blocked_until']) && time() >= $_SESSION['blocked_until']) {
    unset($_SESSION['blocked_until']);
    $_SESSION['attempts'] = 0;
}

// Proses validasi login
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    echo "Silakan masukkan username dan password.";
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

if (validateLogin($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['attempts'] = 0;
    header("Location: dashboard.php");
    exit;
} else {
    $_SESSION['attempts']++;

    if ($_SESSION['attempts'] >= 3) {
        $_SESSION['blocked_until'] = time() + 10; // kamu bisa ubah 3 ke 300 untuk 5 menit
        $_SESSION['error'] = "Terlalu banyak percobaan. Akun diblokir.";
    } else {
        $_SESSION['error'] = "Login gagal. Percobaan ke-" . $_SESSION['attempts'];
    }

    header("Location: index.php");
    exit;
}
