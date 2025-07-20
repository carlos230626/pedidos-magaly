<?php
// index.php
define('ROOT_PATH', dirname(__FILE__));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magaly Comida - Deliciosa comida casera</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Cabecera con logo y navegación -->
    <header>
        <div class="container">
            <div class="logo-container">
                <img src="img/logo.png" alt="Logo Magaly Comida" class="logo">
                <h1>Magaly Comida</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#inicio" class="active">Inicio</a></li>
                    <li><a href="#menu">Menú</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    <li><a href="admin/login.php" class="admin-btn">Admin</a></li>
                </ul>
            </nav>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Sección Hero -->
    <section id="inicio" class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Comida casera hecha con amor</h2>
                <p>Disfruta de los sabores auténticos de la cocina tradicional</p>
                <div class="hero-buttons">
                    <a href="#menu" class="btn">Ver menú</a>
                    <a href="#contacto" class="btn secondary">Hacer pedido</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Especialidades -->
    <section class="specialties">
        <div class="container">
            <h2 class="section-title">Nuestras Especialidades</h2>
            <div class="specialties-grid">
                <div class="specialty-item">
                    <div class="specialty-img" style="background-image: url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80');"></div>
                    <h3>Lomo Saltado</h3>
                    <p>Tradicional plato peruano con carne, papas y arroz</p>
                </div>
                <div class="specialty-item">
                    <div class="specialty-img" style="background-image: url('https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80');"></div>
                    <h3>Ceviche</h3>
                    <p>Pescado fresco marinado en limón con cebolla y ají</p>
                </div>
                <div class="specialty-item">
                    <div class="specialty-img" style="background-image: url('https://images.unsplash.com/photo-1555126634-323283e090fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80');"></div>
                    <h3>Ají de Gallina</h3>
                    <p>Pollo deshilachado en salsa de ají amarillo</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección del Menú -->
    <section id="menu" class="menu">
        <div class="container">
            <h2 class="section-title">Nuestro Menú</h2>
            <div class="menu-tabs">
                <button class="tab-btn active" data-category="entradas">Entradas</button>
                <button class="tab-btn" data-category="platos">Platos Principales</button>
                <button class="tab-btn" data-category="postres">Postres</button>
                <button class="tab-btn" data-category="bebidas">Bebidas</button>
            </div>
            
            <div class="menu-items">
                <div class="menu-category" id="entradas">
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Causa Limeña</h3>
                            <p>Papa amarilla con relleno de pollo o atún</p>
                        </div>
                        <div class="item-price">S/ 18.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Tequeños</h3>
                            <p>Palitos de queso frito con salsa de guacamole</p>
                        </div>
                        <div class="item-price">S/ 15.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Anticuchos</h3>
                            <p>Brochetas de corazón de res con papa y choclo</p>
                        </div>
                        <div class="item-price">S/ 20.00</div>
                    </div>
                </div>
                
                <div class="menu-category" id="platos" style="display:none;">
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Lomo Saltado</h3>
                            <p>Carne de res salteada con cebolla, tomate y papas fritas</p>
                        </div>
                        <div class="item-price">S/ 28.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Arroz con Pollo</h3>
                            <p>Arroz verde con pollo deshilachado y hierbas</p>
                        </div>
                        <div class="item-price">S/ 25.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Seco de Cordero</h3>
                            <p>Guiso de cordero con frijoles y arroz blanco</p>
                        </div>
                        <div class="item-price">S/ 32.00</div>
                    </div>
                </div>
                
                <div class="menu-category" id="postres" style="display:none;">
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Suspiro Limeño</h3>
                            <p>Dulce tradicional de manjar blanco y merengue</p>
                        </div>
                        <div class="item-price">S/ 12.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Mazamorra Morada</h3>
                            <p>Postre de maíz morado con frutas</p>
                        </div>
                        <div class="item-price">S/ 10.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Arroz con Leche</h3>
                            <p>Clásico arroz con leche y canela</p>
                        </div>
                        <div class="item-price">S/ 9.00</div>
                    </div>
                </div>
                
                <div class="menu-category" id="bebidas" style="display:none;">
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Chicha Morada</h3>
                            <p>Refresco de maíz morado con especias</p>
                        </div>
                        <div class="item-price">S/ 8.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Maracuyá Sour</h3>
                            <p>Cóctel de pisco con maracuyá</p>
                        </div>
                        <div class="item-price">S/ 15.00</div>
                    </div>
                    <div class="menu-item">
                        <div class="item-info">
                            <h3>Limonada</h3>
                            <p>Refresco de limón natural con hierbabuena</p>
                        </div>
                        <div class="item-price">S/ 7.00</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Nosotros -->
    <section id="nosotros" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">Nuestra Historia</h2>
                    <p>Magaly Comida nació en el corazón de Lima con la pasión por compartir los sabores auténticos de la cocina peruana. Desde 2010, hemos servido platos tradicionales preparados con ingredientes frescos y recetas transmitidas por generaciones.</p>
                    <p>Nuestro objetivo es llevar a tu mesa la experiencia de una comida casera, con el sabor y el amor que solo Magaly sabe dar.</p>
                    <div class="about-features">
                        <div class="feature">
                            <i class="fas fa-leaf"></i>
                            <p>Ingredientes frescos</p>
                        </div>
                        <div class="feature">
                            <i class="fas fa-heart"></i>
                            <p>Preparado con amor</p>
                        </div>
                        <div class="feature">
                            <i class="fas fa-star"></i>
                            <p>Sabor auténtico</p>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Cocinera preparando comida">
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Contacto -->
    <section id="contacto" class="contact">
        <div class="container">
            <div class="contact-container">
                <div class="contact-info">
                    <h2 class="section-title">Contáctanos</h2>
                    <p>Estamos aquí para servirte. Visítanos o haz tu pedido por teléfono.</p>
                    
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Av. Comida Peruana 123, Lima, Perú</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <p>(01) 123-4567</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <p>pedidos@magalycomida.com</p>
                    </div>
                    
                    <div class="hours">
                        <h3>Horario de Atención</h3>
                        <p>Lunes a Viernes: 11:00 am - 10:00 pm</p>
                        <p>Sábados y Domingos: 12:00 pm - 11:00 pm</p>
                    </div>
                    
                    <div class="qr-container">
                        <p>Escanea para ver ubicación:</p>
                        <img src="img/qr/qr.png" alt="Código QR para ubicación" class="qr-code">
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Haz tu pedido</h3>
                    <form action="includes/upload.php" method="POST">
                        <div class="form-group">
                            <label for="name">Nombre completo</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="order">Tu pedido</label>
                            <textarea id="order" name="order" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn">Enviar pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="img/logo.png" alt="Logo Magaly Comida">
                    <p>Comida casera con sabor a hogar</p>
                </div>
                
                <div class="footer-links">
                    <h3>Enlaces rápidos</h3>
                    <ul>
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#menu">Menú</a></li>
                        <li><a href="#nosotros">Nosotros</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                        <li><a href="admin/login.php">Administrador</a></li>
                    </ul>
                </div>
                
                <div class="footer-social">
                    <h3>Síguenos</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Magaly Comida. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>