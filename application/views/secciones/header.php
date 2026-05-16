<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/estilos.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/menu-lateral.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/marcas.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/historia.css?v=1.1'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/filosofia.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/productos.css'); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

<header class="navbar">

<a href="<?php echo base_url(); ?>" class="logo">
    <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Gruma">
</a>

<div class="menu-toggle" id="menu-toggle">
☰
</div>

<nav>
<ul class="menu">


<li class="<?= ($this->uri->segment(2) == 'productos') ? 'activo' : '' ?>">
<a href="<?= base_url('productos') ?>">Productos</a>
</li>

<li class="<?= ($this->uri->segment(2) == 'inversionistas') ? 'activo' : '' ?>">
<a href="<?= base_url('productos/inversionistas') ?>">Inversionistas</a>
</li>

<li class="<?= ($this->uri->segment(2) == 'innovacion') ? 'activo' : '' ?>">
<a href="<?= base_url('productos/innovacion') ?>">Innovación</a>
</li>

<li class="<?= ($this->uri->segment(2) == 'sustentabilidad') ? 'activo' : '' ?>">
<a href="<?= base_url('productos/sustentabilidad') ?>">Sustentabilidad</a>
</li>

<li class="<?= ($this->uri->segment(2) == 'prensa') ? 'activo' : '' ?>">
<a href="<?= base_url('productos/prensa') ?>">Sala de Prensa</a>
</li>

<li class="<?= ($this->uri->segment(2) == 'contacto') ? 'activo' : '' ?>">
<a href="<?= base_url('productos/contacto') ?>">Contáctanos</a>
</li>

<!-- LOGIN -->
<li>
    <a href="<?= base_url('login') ?>" style="color: white;">
        <i class="fa-solid fa-user"></i> Iniciar Sesión
    </a>
</li>

<!-- BOTON CARRITO -->
<li class="<?= ($this->uri->segment(2) == 'carrito') ? 'activo' : '' ?>">
    <a href="<?= base_url('productos/carrito') ?>" style="color: #FFD100; font-weight: bold;">
        <i class="fa-solid fa-cart-shopping"></i> Carrito
    </a>
</li>

</ul>
</nav>

<div class="menu-lateral" id="menu-lateral">

<div class="menu-top">

<a href="<?= base_url(); ?>" class="menu-logo-link">
<img src="<?= base_url('assets/img/logo.png') ?>" class="menu-logo">
</a>

<button class="menu-close" id="menu-close">✕</button>

</div>

<ul class="menu-links">


<li><a href="<?= base_url('productos') ?>">Productos</a></li>

<li><a href="<?= base_url('productos/inversionistas') ?>">Inversionistas</a></li>

<li><a href="<?= base_url('productos/innovacion') ?>">Innovación</a></li>

<li><a href="<?= base_url('productos/sustentabilidad') ?>">Sustentabilidad</a></li>

<li><a href="<?= base_url('index.php/productos/prensa') ?>">Sala de Prensa</a></li>

<li><a href="<?= base_url('productos/contacto') ?>">Contacto</a></li>

<!-- LOGIN MENU LATERAL -->
<li>
    <a href="<?= base_url('login') ?>">
        <i class="fa-solid fa-user"></i> Iniciar Sesión
    </a>
</li>

<!-- CARRITO MENU LATERAL -->
<li>
    <a href="<?= base_url('productos/carrito') ?>">
        <i class="fa-solid fa-cart-shopping"></i> Carrito
    </a>
</li>

</ul>

</div>

<div class="overlay" id="overlay"></div>

</header>