<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/upload.php';

if (!is_logged_in()) {
    redirect('login.php');
}

$telefono = get_telefono();
$platos = get_platos();

$mensaje = '';
$error = '';

// Procesar formulario de nuevo plato
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_plato'])) {
    $nombre = sanitize_input($_POST['nombre']);
    $descripcion = sanitize_input($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $critica = sanitize_input($_POST['critica']);
    $tipo = $_POST['tipo'];
    
    $imagen = null;
    
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $upload_result = upload_image($_FILES['imagen']);
        if ($upload_result['success']) {
            $imagen = $upload_result['filename'];
        } else {
            $error = $upload_result['error'];
        }
    }
    
    if (!$error) {
        try {
            $stmt = $pdo->prepare("INSERT INTO platos (nombre, descripcion, precio, critica, tipo, imagen) 
                                   VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $descripcion, $precio, $critica, $tipo, $imagen]);
            $mensaje = 'Plato agregado exitosamente!';
            $platos = get_platos(); // Actualizar lista
        } catch (PDOException $e) {
            $error = 'Error al agregar el plato: ' . $e->getMessage();
        }
    }
}

// Procesar formulario de contacto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contacto'])) {
    $nuevoTelefono = sanitize_input($_POST['telefono']);
    
    try {
        $stmt = $pdo->prepare("UPDATE contactos SET telefono = ?");
        $stmt->execute([$nuevoTelefono]);
        $mensaje = 'Teléfono actualizado exitosamente!';
        $telefono = $nuevoTelefono;
    } catch (PDOException $e) {
        $error = 'Error al actualizar el teléfono: ' . $e->getMessage();
    }
}

// Eliminar plato
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    
    try {
        // Obtener imagen para eliminar
        $stmt = $pdo->prepare("SELECT imagen FROM platos WHERE id = ?");
        $stmt->execute([$id]);
        $imagen = $stmt->fetchColumn();
        
        // Eliminar de la base de datos
        $stmt = $pdo->prepare("DELETE FROM platos WHERE id = ?");
        $stmt->execute([$id]);
        
        // Eliminar archivo de imagen
        if ($imagen && file_exists("../uploads/$imagen")) {
            unlink("../uploads/$imagen");
        }
        
        $mensaje = 'Plato eliminado exitosamente!';
        $platos = get_platos(); // Actualizar lista
    } catch (PDOException $e) {
        $error = 'Error al eliminar el plato: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Comida Magaly</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-panel {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 250px;
            background-color: var(--dark);
            color: var(--light);
            padding: 20px 0;
        }

        .admin-logo {
            text-align: center;
            padding: 0 15px 20px;
            border-bottom: 1px solid #444;
            margin-bottom: 20px;
        }

        .admin-logo .logo-circle {
            margin: 0 auto;
            width: 80px;
            height: 80px;
        }

        .admin-logo h3 {
            margin-top: 10px;
            color: var(--white);
        }

        .admin-sidebar nav ul {
            list-style: none;
            padding: 0;
        }

        .admin-sidebar nav li {
            margin-bottom: 5px;
        }

        .admin-sidebar nav a {
            display: block;
            padding: 12px 20px;
            color: #ddd;
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-sidebar nav a:hover, .admin-sidebar nav a.active {
            background-color: #444;
            color: var(--white);
        }

        .admin-content {
            flex: 1;
            padding: 30px;
            background-color: var(--light);
            overflow-y: auto;
        }

        .admin-platos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .admin-plato-form, .admin-plato-list {
            background-color: var(--white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .admin-plato-item {
            background-color: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .plato-image-admin {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .plato-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-edit, .btn-delete {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 5px;
        }

        .btn-edit {
            color: var(--primary);
        }

        .btn-delete {
            color: #e74c3c;
        }

        .admin-contact-section {
            background-color: var(--white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            margin-top: 40px;
        }
        
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="admin-panel">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <div class="logo-circle">
                    <img src="../images/logo.png" alt="Logo Comida Magaly">
                </div>
                <h3>Hola, Magaly</h3>
            </div>
            
            <nav>
                <ul>
                    <li><a href="#" class="active"><i class="fas fa-utensils"></i> Menú del Día</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>
        
        <main class="admin-content">
            <h1><i class="fas fa-utensils"></i> Actualizar Menú del Día</h1>
            
            <?php if ($mensaje): ?>
                <div class="success-message"><?= $mensaje ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>
            
            <div class="admin-platos">
                <div class="admin-plato-form">
                    <h2>Agregar Nuevo Plato</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombre">Nombre del Plato:</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="precio">Precio (S/):</label>
                            <input type="number" id="precio" name="precio" step="0.01" min="0" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="critica">Tu crítica/recomendación:</label>
                            <textarea id="critica" name="critica" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="tipo">Tipo de plato:</label>
                            <select id="tipo" name="tipo" required>
                                <option value="principal">Plato Principal</option>
                                <option value="sopa">Sopa</option>
                                <option value="refresco">Refresco</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="imagen">Imagen del Plato:</label>
                            <input type="file" id="imagen" name="imagen" accept="image/*">
                        </div>
                        
                        <button type="submit" name="submit_plato" class="btn-submit">Guardar Plato</button>
                    </form>
                </div>
                
                <div class="admin-plato-list">
                    <h2>Platos del Día</h2>
                    <div class="plato-list-container">
                        <?php foreach ($platos as $plato): ?>
                            <div class="admin-plato-item">
                                <?php if ($plato['imagen']): ?>
                                    <img src="../uploads/<?= $plato['imagen'] ?>" alt="<?= $plato['nombre'] ?>" class="plato-image-admin">
                                <?php endif; ?>
                                <div class="plato-info">
                                    <h3><?= $plato['nombre'] ?></h3>
                                    <p><?= $plato['descripcion'] ?></p>
                                    <p class="plato-meta"><strong>Precio:</strong> S/ <?= number_format($plato['precio'], 2) ?></p>
                                    <p class="plato-critica">"<?= $plato['critica'] ?>"</p>
                                    <p><strong>Tipo:</strong> <?= $plato['tipo'] === 'principal' ? 'Plato Principal' : ($plato['tipo'] === 'sopa' ? 'Sopa' : 'Refresco') ?></p>
                                </div>
                                <div class="plato-actions">
                                    <a href="?eliminar=<?= $plato['id'] ?>" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar este plato?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div class="admin-contact-section">
                <h2><i class="fas fa-phone"></i> Actualizar Teléfono de Contacto</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="telefono-contacto">Nuevo Número:</label>
                        <input type="tel" id="telefono-contacto" name="telefono" value="<?= $telefono ?>" required>
                    </div>
                    <button type="submit" name="submit_contacto" class="btn-submit">Actualizar Teléfono</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>