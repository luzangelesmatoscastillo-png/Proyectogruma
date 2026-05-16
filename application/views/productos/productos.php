<section class="productos">

<h2 style="text-align:center;margin:40px 0;color:#007A3D;">
    Productos
</h2>

<div class="productos-container">

<?php foreach($marcas as $m): ?>

    <?php foreach($m->productos as $p): ?>

    <div class="producto-card">

        <img src="<?= base_url('assets/img/productos/'.$p->id_imagen) ?>">

        <h3><?= $p->nombre ?></h3>

        <p class="precio">
            $<?= number_format($p->precio,2) ?>
        </p>

        <select class="cantidad-select">

            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>

        </select>

        <button class="btn-carrito"

            data-id="<?= $p->id ?>"
            data-nombre="<?= $p->nombre ?>"
            data-precio="<?= $p->precio ?>"
            data-imagen="<?= $p->id_imagen ?>"

            onclick="agregarCarrito(this)">

            Agregar al carrito

        </button>

    </div>

    <?php endforeach; ?>

<?php endforeach; ?>

</div>

<a href="<?= base_url('index.php/productos/carrito') ?>" class="btn-ver-carrito">

    Ver carrito

</a>

</section>

<style>

.productos{
    padding:40px;
}

.productos-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:30px;
}

.producto-card{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    text-align:center;
}

.producto-card img{
    width:100%;
    height:220px;
    object-fit:contain;
}

.precio{
    color:#007A3D;
    font-size:24px;
    font-weight:bold;
}

.cantidad-select{
    width:100%;
    padding:10px;
    margin-top:10px;
}

.btn-carrito{
    width:100%;
    margin-top:15px;
    padding:14px;
    border:none;
    background:#007A3D;
    color:white;
    border-radius:10px;
    cursor:pointer;
}

.btn-ver-carrito{
    display:inline-block;
    margin-top:40px;
    background:#FFD100;
    padding:15px 30px;
    border-radius:10px;
    text-decoration:none;
    color:#007A3D;
    font-weight:bold;
}

</style>

<script>

function agregarCarrito(btn){

    const card = btn.closest('.producto-card');

    const cantidad = card.querySelector('.cantidad-select').value;

    fetch('<?= base_url('index.php/productos/agregar_carrito') ?>',{

        method:'POST',

        headers:{
            'Content-Type':'application/x-www-form-urlencoded'
        },

        body:

        'id=' + btn.dataset.id +
        '&nombre=' + encodeURIComponent(btn.dataset.nombre) +
        '&precio=' + btn.dataset.precio +
        '&cantidad=' + cantidad +
        '&imagen=' + btn.dataset.imagen

    })

    .then(r=>r.json())

    .then(data=>{

        btn.innerHTML = '✅ Agregado';

        setTimeout(()=>{

            btn.innerHTML = 'Agregar al carrito';

        },1500);

    });

}

</script>