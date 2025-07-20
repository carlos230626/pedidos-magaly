<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function get_platos() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM platos ORDER BY tipo, nombre");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_telefono() {
    global $pdo;
    $stmt = $pdo->query("SELECT telefono FROM contactos LIMIT 1");
    return $stmt->fetchColumn();
}

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>