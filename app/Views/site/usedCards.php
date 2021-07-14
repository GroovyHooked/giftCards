<?php
foreach ($codeqr as $row) {
?>
<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-6 offset-1 offset-sm-3 offset-lg-4">
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">Carte déjà utilisé</h5>
                    <div class="card-body">
                        <p class="card-text">Valeur de la carte: <?= $row->value?></p>
                        <p class="card-text">Propriétaire de la carte: Mr ou Mme <?= $row->giftedLastname?></p>
                        <p class="card-text">ID de la carte: <?= $row->card_uniqid?></p>
                    </div>
                    <a href="<?= site_url('dashboard')?>" ><button type="button" class="btn btn-outline-info m-auto d-block">Tableau de bord</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }