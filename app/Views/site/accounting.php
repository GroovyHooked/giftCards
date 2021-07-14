<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <div class="retourAccueil">
                <?php if (session()->get('isLoggedIn')) : ?>
                    <a href="<?= base_url('dashboard') ?>">
                        <div id="triangle"></div>
                        <div class="triangleBis">Accueil</div>
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('index') ?>">
                        <div id="triangle"></div>
                        <div class="triangleBis">Accueil</div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3 class="text-center mt-4">Comptabilité</h3>
            <table class="table mt-5">
                <thead class="thead-light">
                <tr>
                    <th class="text-center">Total</th>
                    <th class="text-center">Utilisées</th>
                    <th class="text-center">Circulantes</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($total as $row) {
                        if (isset($row->value)) {
                            ?>
                            <th class="text-center"><?= number_to_currency($row->value, 'EUR', 'fr', 2) ?></th>
                            <?php
                        } else {
                            ?>
                            <th class="text-center">0€</th>
                        <?php }
                    }
                    foreach ($totalUsed as $row) {
                        if (isset($row->value)) {
                            ?>
                            <th class="text-center"><?= number_to_currency($row->value, 'EUR', 'fr', 2) ?></th>
                            <?php
                        } else {
                            ?>
                            <th class="text-center">0€</th>
                        <?php }
                    }
                    foreach ($totalPending as $row) {
                        if (isset($row->value)) {
                            ?>
                            <th class="text-center"><?= number_to_currency($row->value, 'EUR', 'fr', 2) ?></th>
                        <?php } else {
                            ?>
                            <th class="text-center">0€</th>
                        <?php }
                    } ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <?php foreach ($nbOfCards as $row) {
                if ($row->user_email != 0) {
                    ?>
                    <p class="text-center d-block mb-0">Vous avez vendu un total de <?= $row->user_email ?> cartes cadeau</p>
                <?php } else { ?>
                    <p class="text-center">Vous n'avez pas encore généré de cartes cadeau</p>
                <?php }
            }
            foreach ($total as $row) {
                if ($row->value != null) {
                    ?>
                    <p class="text-center">qui vous ont permis de
                        générer <span id="sales">0</span> de chiffre
                        d'affaire supplémentaire.</p>
                <?php } else { ?>
                    <p class="text-center"></p>
                <?php }
            } ?>
        </div>
    </div>
</div>
<script>
    const salesDisplay = document.getElementById('sales');
    const value = <?= $row->value ?>;
    let counter = 0;

    function myFunction() {
        setInterval(function() {
            counter++;
            if (counter <= value) {
                salesDisplay.innerText = counter + ' €';
            }
        }, .01)
    }
    myFunction();
</script>