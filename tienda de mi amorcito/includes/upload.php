<?php
function upload_image($file) {
    $target_dir = "uploads/";
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    
    // Verificar si es una imagen real
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return ['success' => false, 'error' => 'El archivo no es una imagen.'];
    }
    
    // Limitar tamaño (2MB)
    if ($file["size"] > 2000000) {
        return ['success' => false, 'error' => 'La imagen es demasiado grande (máximo 2MB).'];
    }
    
    // Permitir ciertos formatos
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if(!in_array($imageFileType, $allowed_types)) {
        return ['success' => false, 'error' => 'Solo se permiten archivos JPG, JPEG, PNG & GIF.'];
    }
    
    // Intentar subir el archivo
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['success' => true, 'filename' => $new_filename];
    } else {
        return ['success' => false, 'error' => 'Hubo un error al subir la imagen.'];
    }
}
?>