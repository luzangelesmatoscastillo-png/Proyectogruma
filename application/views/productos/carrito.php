<?php
// Recibimos los datos del controlador. Si no existen por alguna razón, se inicializan
$productos_carrito = isset($productos_carrito) ? $productos_carrito : [];
$subtotal_general  = isset($subtotal_general) ? $subtotal_general : 0;
$envio             = isset($envio) ? $envio : 0;
$impuesto          = isset($impuesto) ? $impuesto : 0;
$total_general     = isset($total_general) ? $total_general : 0;
?>

<div class="carrito-top-actions">
    <span class="total-items-count"><?= count($productos_carrito) ?> productos</span>
    <div class="actions-links">
        <a href="<?= base_url('productos/carrito') ?>">Actualizar carrito</a>
        <a href="<?= base_url('productos') ?>">Seguir comprando</a>
        <a href="<?= base_url('productos/vaciar_carrito') ?>">Vaciar carrito</a>
    </div>
</div>

<div class="carrito-container">

    <div class="carrito-productos">
        <div class="dropdown-header-pedido">
            <h2>Tu pedido <span><?= count($productos_carrito) ?> productos</span></h2>
            <i class="fa-solid fa-chevron-up"></i>
        </div>

        <div class="tabla-header">
            <span class="th-producto">Producto</span>
            <span class="th-precio">Precio</span>
            <span class="th-cantidad">Cantidad</span>
            <span class="th-subtotal">Subtotal</span>
            <span class="th-accion"></span>
        </div>

        <?php if(!empty($productos_carrito)): ?>
            <?php foreach($productos_carrito as $item): ?>
                <div class="producto">
                    <div class="prod-img-box">
                        <img src="<?= base_url('assets/img/productos/'.$item['imagen']) ?>" alt="<?= $item['nombre'] ?>">
                    </div>

                    <div class="info">
                        <h3><?= $item['nombre'] ?></h3>
                    </div>

                    <div class="precio-unitario">
                        $<?= number_format($item['precio'], 2) ?>
                    </div>

                    <div class="cantidad">
                        <form method="POST" action="<?= base_url('productos/actualizar_cantidad') ?>">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="accion" value="restar">
                            <button type="submit" class="btn-qty">-</button>
                        </form>

                        <span class="qty-number"><?= $item['cantidad'] ?></span>

                        <form method="POST" action="<?= base_url('productos/actualizar_cantidad') ?>">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="accion" value="sumar">
                            <button type="submit" class="btn-qty">+</button>
                        </form>
                    </div>

                    <div class="subtotal">
                        $<?= number_format($item['subtotal_producto'], 2) ?>
                    </div>

                    <div class="eliminar-box">
                        <form method="POST" action="<?= base_url('productos/eliminar_carrito') ?>">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" class="eliminar-btn">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="carrito-vacio">
                <i class="fa-solid fa-basket-shopping" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                <p>Tu carrito está vacío. ¡Agrega productos de Gruma!</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="resumen">
        <h2>Resumen de la compra</h2>
        
        <div class="resumen-row">
            <span>Subtotal</span>
            <span>$<?= number_format($subtotal_general, 2) ?></span>
        </div>
        
        <div class="resumen-row envio-gratis">
            <span>Costo de envío</span>
            <span>$<?= number_format($envio, 2) ?></span>
        </div>
        
        <div class="resumen-row">
            <span>Impuesto</span>
            <span>$<?= number_format($impuesto, 2) ?></span>
        </div>
        
        <hr class="resumen-divider">

        <div class="resumen-row total-row">
            <span>Total del pedido</span>
            <span>$<?= number_format($total_general, 2) ?></span>
        </div>

        <button class="btn-proceder-pago">Proceder al pago</button>
    </div>

</div>
<div id="modal-pago" class="modal-overlay">
    <div class="modal-content">
        <button id="cerrar-modal" class="modal-close-btn">&times;</button>
        
        <div class="modal-body">
            <div class="modal-column columna-nuevo">
                <h2>Pagar como nuevo cliente</h2>
                <p>Crear una cuenta tiene muchos beneficios:</p>
                <ul>
                    <li><i class="fa-solid fa-check"></i> Ver orden y estado de envío</li>
                    <li><i class="fa-solid fa-check"></i> Rastrear historial de orden</li>
                    <li><i class="fa-solid fa-check"></i> Comprar más rápidamente</li>
                </ul>
                <a href="<?= base_url('login') ?>" class="btn-modal btn-crear-cuenta">Crea una cuenta</a>
            </div>

            <div class="modal-divider-vertical">
                <span>O</span>
            </div>

            <div class="modal-column columna-login">
                <h2>Pagar usando su cuenta</h2>
                
                <form action="<?= base_url('login/validar') ?>" method="POST">
                    <div class="form-group">
                        <label>Dirección de correo electrónico <span class="required">*</span></label>
                        <input type="email" name="correo" required placeholder="ejemplo@gruma.com">
                    </div>
                    
                    <div class="form-group">
                        <label>Contraseña <span class="required">*</span></label>
                        <input type="password" name="contrasena" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn-modal btn-iniciar-sesion">Iniciar sesión</button>
                </form>

                <div class="login-footer-links">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

body {
    background: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Enlaces superiores */
.carrito-top-actions {
    max-width: 1200px;
    margin: 30px auto 10px auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}
.total-items-count {
    font-size: 14px;
    color: #666;
}
.actions-links a {
    color: #002d85;
    text-decoration: underline;
    font-size: 14px;
    margin-left: 15px;
    font-weight: 500;
}

/* Contenedor Principal */
.carrito-container {
    display: flex;
    max-width: 1200px;
    margin: 0 auto 50px auto;
    gap: 25px;
    padding: 0 20px;
    align-items: flex-start;
}

/* Bloque Izquierdo: Productos */
.carrito-productos {
    flex: 2.5;
    background: white;
    padding: 25px;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.dropdown-header-pedido {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    margin-bottom: 10px;
}
.dropdown-header-pedido h2 {
    font-size: 18px;
    margin: 0;
    font-weight: 600;
}
.dropdown-header-pedido h2 span {
    font-size: 14px;
    color: #777;
    font-weight: normal;
    margin-left: 10px;
}
.dropdown-header-pedido i {
    color: #333;
    font-size: 16px;
}

/* DISTRIBUCIÓN EXACTA DE COLUMNAS (PROPORCIONES) 
   Damos un porcentaje estricto a cada columna para que coincidan arriba y abajo
*/
.th-producto, .col-producto-info {
    flex: 0 0 50%; /* Ocupa el 50% del ancho total */
    display: flex;
    align-items: center;
}
.th-precio, .precio-unitario {
    flex: 0 0 15%; /* Ocupa el 15% */
    text-align: right;
}
.th-cantidad, .cantidad {
    flex: 0 0 15%; /* Ocupa el 15% */
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
}
.th-subtotal, .subtotal {
    flex: 0 0 15%; /* Ocupa el 15% */
    text-align: right;
}
.th-accion, .eliminar-box {
    flex: 0 0 5%; /* Ocupa el 5% restante */
    text-align: right;
}

/* Fila de Encabezados */
.tabla-header {
    display: flex;
    padding: 15px 0;
    font-size: 13px;
    color: #777;
    font-weight: 500;
    border-bottom: 1px solid #eee;
}

/* Tarjetas individuales de cada producto */
.producto {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #f0f0f0;
}

.prod-img-box {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0; /* Evita que la imagen se haga chiquita */
}
.producto img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.info {
    flex: 1; /* Ocupa todo el espacio interno de la celda de información */
}
.info h3 {
    font-size: 14px;
    margin: 0;
    font-weight: 500;
    color: #111;
    line-height: 1.4;
    white-space: normal; /* Permite que el texto salte de línea correctamente sin cortarse */
}

.precio-unitario {
    font-size: 15px;
    font-weight: 500;
    color: #333;
}

/* Controles de Cantidad */
.cantidad form {
    display: inline;
    margin: 0;
}
.btn-qty {
    background: #f8f9fa;
    border: 1px solid #ced4da;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #333;
    transition: all 0.2s;
    padding: 0;
    vertical-align: middle;
}
.btn-qty:hover {
    background: #e9ecef;
}
.qty-number {
    font-size: 14px;
    display: inline-block;
    min-width: 25px;
    text-align: center;
    font-weight: 500;
    vertical-align: middle;
}

/* Subtotal */
.subtotal {
    font-size: 16px;
    font-weight: 600;
    color: #111;
}

/* Botón Eliminar */
.eliminar-btn {
    border: none;
    background: none;
    font-size: 16px;
    color: #888;
    cursor: pointer;
    transition: color 0.2s;
    padding: 0;
}
.eliminar-btn:hover {
    color: #dc3545;
}

/* Bloque Derecho: Tarjeta Resumen */
.resumen {
    flex: 1;
    background: white;
    padding: 25px;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.resumen h2 {
    font-size: 18px;
    margin-top: 0;
    margin-bottom: 25px;
    font-weight: 600;
}
.resumen-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 14px;
    color: #444;
}
.envio-gratis span:last-child {
    color: #28a745;
    font-weight: 600;
}
.resumen-divider {
    border: 0;
    border-top: 1px solid #eee;
    margin: 20px 0;
}
.total-row {
    font-size: 16px;
    font-weight: bold;
    color: #111;
    margin-bottom: 25px;
}

/* Botón Proceder al Pago */
.btn-proceder-pago {
    width: 100%;
    background: #001a72;
    color: white;
    border: none;
    padding: 14px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 25px;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-proceder-pago:hover {
    background: #001147;
}

.carrito-vacio {
    text-align: center;
    padding: 40px 0;
    color: #666;
}
/* --- ESTILOS PARA EL MODAL DE PAGO --- */

/* Fondo oscuro translúcido que cubre toda la pantalla */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Oscurece el fondo */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000; /* Asegura que se sitúe por encima de la navbar */
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

/* Clase activa que se añade con JavaScript para mostrar el modal */
.modal-overlay.mostrar {
    opacity: 1;
    pointer-events: auto;
}

/* Tarjeta Blanca Central */
.modal-content {
    background: white;
    width: 90%;
    max-width: 850px;
    border-radius: 4px;
    padding: 40px;
    position: relative;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    transform: translateY(-20px);
    transition: transform 0.3s ease;
}

.modal-overlay.mostrar .modal-content {
    transform: translateY(0);
}

/* Botón de cerrar (X) */
.modal-close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    font-size: 28px;
    color: #888;
    cursor: pointer;
}
.modal-close-btn:hover {
    color: #333;
}

/* Contenedor Flex de dos columnas */
.modal-body {
    display: flex;
    align-items: stretch;
    gap: 20px;
}

.modal-column {
    flex: 1;
    padding: 10px 20px;
}

.modal-column h2 {
    font-size: 20px;
    color: #444;
    font-weight: 400;
    margin-top: 0;
    margin-bottom: 25px;
}

/* Columna Izquierda (Nuevo) */
.columna-nuevo p {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}
.columna-nuevo ul {
    list-style: none;
    padding: 0;
    margin: 0 0 35px 0;
}
.columna-nuevo ul li {
    font-size: 14px;
    color: #555;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.columna-nuevo ul li i {
    color: #28a745;
    font-size: 12px;
}

/* Divisor Línea Vertical */
.modal-divider-vertical {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    width: 1px;
    background: #e0e0e0;
    margin: 0 10px;
}
.modal-divider-vertical span {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    color: #888;
    font-size: 13px;
}

/* Formularios columna derecha (Login) */
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    font-size: 13px;
    color: #555;
    margin-bottom: 8px;
}
.form-group label .required {
    color: #dc3545;
}
.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}
.form-group input:focus {
    border-color: #001a72;
    outline: none;
}

/* Botones Base del Modal */
.btn-modal {
    display: block;
    width: 100%;
    padding: 12px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    box-sizing: border-box;
}

/* Botón Azul Oscuro estilo Farmacia/Gruma */
.btn-crear-cuenta {
    background: #002d85;
    color: white;
    border: none;
    margin-top: 20px;
}
.btn-crear-cuenta:hover {
    background: #001d54;
}

/* Botón Gris Claro del Login */
.btn-iniciar-sesion {
    background: #f1f3f5;
    color: #333;
    border: 1px solid #ced4da;
}
.btn-iniciar-sesion:hover {
    background: #e2e6ea;
}

.login-footer-links {
    margin-top: 20px;
    text-align: center;
}
.login-footer-links a {
    font-size: 13px;
    color: #002d85;
    text-decoration: none;
}
.login-footer-links a:hover {
    text-decoration: underline;
}

</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionamos los elementos clave
    const btnProceder = document.querySelector('.btn-proceder-pago');
    const modalPago = document.getElementById('modal-pago');
    const btnCerrar = document.getElementById('cerrar-modal');

    // Al hacer clic en "Proceder al pago", abrimos el modal
    if (btnProceder) {
        btnProceder.addEventListener('click', function(e) {
            e.preventDefault(); // Evitamos cualquier acción por defecto
            modalPago.classList.add('mostrar');
        });
    }

    // Al hacer clic en la (X), cerramos el modal
    if (btnCerrar) {
        btnCerrar.addEventListener('click', function() {
            modalPago.classList.remove('mostrar');
        });
    }

    // Si el usuario hace clic fuera de la caja blanca, también se cierra
    window.addEventListener('click', function(e) {
        if (e.target === modalPago) {
            modalPago.classList.remove('mostrar');
        }
    });
});
</script>