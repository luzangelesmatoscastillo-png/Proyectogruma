
<!-- NUEVO ESTILO PARA FILOSOFÍA Y VALORES -->
<link rel="stylesheet" href="<?= base_url('assets/css/filosofia-valores-nuevo.css') ?>">
<section class="valores">

<div class="valores-header">

<span class="valores-tag">VALORES</span>

<h2>Nuestra Filosofía</h2>

<p class="valores-frase">
Esfuerzo, Compromiso, Perseverancia y Trascendencia
</p>

<p class="valores-sub">
Los principios que definen quiénes somos y cómo trabajamos cada día.
</p>

</div>

<div class="valores-linea"></div>

<div class="valores-container">

<?php foreach($valores as $v){ ?>

<div class="valor-card">

<h4><?= $v->titulo ?></h4>

<p><?= $v->descripcion ?></p>

</div>

<?php } ?>

</div>

</section>