
<!-- NUEVO ESTILO PARA FILOSOFÍA Y VALORES -->
<link rel="stylesheet" href="<?= base_url('assets/css/filosofia-valores-nuevo.css') ?>">
<section class="filosofia">

    <div class="filosofia-header">

        <h2>Filosofía corporativa</h2>

        <h3>Misión, Visión y Objetivo</h3>

        <p>Los pilares que guían cada decisión y cada producto que llevamos a tu mesa.</p>

    </div>

    <div class="filosofia-container">

        <?php foreach($pilares as $p){ ?>

            <div class="filosofia-card">

                <h4><?= $p->titulo ?></h4>

                <img 
                    src="<?= base_url($p->url . $p->nombre_archivo) ?>"
                    alt="<?= $p->titulo ?>"
                    width="200"
                >

                <p><?= $p->descripcion ?></p>

            </div>

        <?php } ?>

    </div>

</section>