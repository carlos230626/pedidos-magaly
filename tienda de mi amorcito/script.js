// Variables globales
let selectedPlato = null;
const modal = document.getElementById('purchase-modal');
const confirmModal = document.getElementById('confirmation-modal');
const closeBtn = document.querySelector('.close');
const closeConfirmBtn = document.getElementById('btn-close-confirm');
const whatsappBtn = document.getElementById('btn-whatsapp');

// Cargar menú
function loadMenu() {
    // Agregar eventos a los botones de compra
    document.querySelectorAll('.comprar-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const platoId = parseInt(this.getAttribute('data-id'));
            const platoCard = this.closest('.plato-card');
            selectedPlato = {
                id: platoId,
                nombre: platoCard.querySelector('h3').textContent,
                descripcion: platoCard.querySelector('.plato-content p').textContent,
                precio: parseFloat(platoCard.querySelector('.plato-price').textContent.replace('S/ ', ''))
            };
            openModal();
        });
    });
}

// Abrir modal de compra
function openModal() {
    if (selectedPlato) {
        document.getElementById('modal-plato-name').textContent = selectedPlato.nombre;
        document.getElementById('modal-plato-desc').textContent = selectedPlato.descripcion;
        document.getElementById('modal-plato-price').textContent = `S/ ${selectedPlato.precio.toFixed(2)}`;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

// Cerrar modal
function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Abrir modal de confirmación
function openConfirmation() {
    confirmModal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Cerrar modal de confirmación
function closeConfirmation() {
    confirmModal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Obtener ubicación
document.getElementById('btn-ubicacion').addEventListener('click', function() {
    const locationResult = document.getElementById('location-result');
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                
                // Simular obtención de dirección
                setTimeout(() => {
                    locationResult.innerHTML = `<i class="fas fa-check"></i> Ubicación obtenida: Lat ${lat.toFixed(4)}, Lon ${lon.toFixed(4)}`;
                    locationResult.style.display = 'block';
                }, 1000);
            },
            function(error) {
                locationResult.innerHTML = `<i class="fas fa-exclamation-triangle"></i> Error: ${error.message}`;
                locationResult.style.display = 'block';
            }
        );
    } else {
        locationResult.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Geolocalización no soportada en este navegador';
        locationResult.style.display = 'block';
    }
});

// Procesar formulario de pedido
document.getElementById('pedido-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nombre = document.getElementById('nombre').value;
    const telefono = document.getElementById('telefono').value;
    const direccion = document.getElementById('direccion').value;
    const metodoPago = document.querySelector('input[name="metodo_pago"]:checked').value;
    const telefonoContacto = document.getElementById('contact-phone').textContent;
    
    // Crear mensaje para WhatsApp
    let mensaje = `¡Nuevo pedido!%0A%0A`;
    mensaje += `*Cliente:* ${nombre}%0A`;
    mensaje += `*Teléfono:* ${telefono}%0A`;
    mensaje += `*Dirección:* ${direccion}%0A`;
    mensaje += `*Plato:* ${selectedPlato.nombre}%0A`;
    mensaje += `*Precio:* S/ ${selectedPlato.precio.toFixed(2)}%0A`;
    mensaje += `*Método de Pago:* ${metodoPago === 'qr' ? 'QR' : 'Tarjeta'}%0A`;
    
    // Guardar el número de WhatsApp de Magaly
    whatsappBtn.setAttribute('data-href', `https://wa.me/${telefonoContacto.replace(/\D/g, '')}?text=${mensaje}`);
    
    // Cerrar modal de compra y abrir confirmación
    closeModal();
    openConfirmation();
});

// Event Listeners
closeBtn.addEventListener('click', closeModal);
closeConfirmBtn.addEventListener('click', closeConfirmation);
whatsappBtn.addEventListener('click', function() {
    window.open(this.getAttribute('data-href'), '_blank');
    closeConfirmation();
});

// Cerrar modales al hacer clic fuera del contenido
window.addEventListener('click', function(e) {
    if (e.target === modal) {
        closeModal();
    }
    if (e.target === confirmModal) {
        closeConfirmation();
    }
});

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    loadMenu();
});