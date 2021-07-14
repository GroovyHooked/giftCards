<?php
use App\Models\Cards;
?>
<div style="overflow-x:auto;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="retourAccueil">
                    <a href="<?= base_url('dashboard') ?>">
                        <div id="triangle"></div>
                        <div class="triangleBis">Accueil</div>
                    </a>
                </div>
            </div>
        </div>
        <pre>
            <?php
            /*if (isset($test)){
                var_dump($test);

            }
            */
            ?>
        </pre>
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <?php
                    if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Cartes créées</h3>
            </div>
        </div>
        <div class="row">
            <div class="table table-striped">
                <div >
                <div class="d-flex flex-row justify-content-around">
                    <div></div>
                    <div>Nom</div>
                    <div>Prénom</div>
                    <div>Montant</div>
                </div>
                </div>
                <div>
                <?php foreach ($users

                as $row) { ?>
                <form action="<?= base_url('created') ?>" method="post">
                    <div class="d-flex flex-row justify-content-around">
                        <div class="col">
                            <?= $row['id'] ?>
                        </div>
                        <div class="col">
                            <?= $row['giftedFirstname'] ?>
                            <input type="hidden" name="giftedFirstname" value="<?= $row['giftedFirstname'] ?>">
                        </div>
                        <div class="col">
                            <?= $row['giftedLastname'] ?>
                            <input type="hidden" name="giftedLastname" value="<?= $row['giftedLastname'] ?>">
                        </div>
                        <div class="col">
                            <?= number_to_currency($row['value'], 'EUR', 'fr', 2) ?>
                            <input type="hidden" name="value"
                                   value="<?= number_to_currency($row['value'], 'EUR', 'fr', 2) ?>">
                            <input type="hidden" name="gifted_email"
                                   value="<?= $row['gifted_email'] ?>">
                            <input type="hidden" name="client_email"
                                   value="<?= $row['client_email'] ?>">
                            <input type="hidden" name="id"
                                   value="<?= $row['id'] ?>">
                        </div>
                        <div class="col">
                            <?php
                            $bdd = new Cards();
                            $sentStatus = $bdd->isSentInfo($row['id']);
                            //var_dump($bdd->isSentInfo($row['id']));
                            if($sentStatus == false ){
                                ?>
                                <button type="submit" class="btn btn-primary btn-sm" value="<?= $row['id'] ?>"
                                        name="personnalId">Send
                                </button>
                            <?php } elseif ($sentStatus == true){ ?>
                                <button type="submit" class="btn btn-primary btn-sm" value="<?= $row['id'] ?>"
                                        name="personnalId" disabled="disabled">Done
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm" value="<?= $row['id'] ?>"
                                        name="personnalId">@
                                </button>
                            <?php } ?>
                        </div>
                        <div class="col">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal<?= $row['id'] ?>">
                                +
                            </button>
                            <!-- Modal -->
                            <div class="modal" id="modal<?= $row['id'] ?>" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Modal">Informations supplémentaires</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-10 offset-2">
                                                        <p class="text-dark"><?= $row['giftedPhone'] ?></p>
                                                        <p class="text-dark">Carte achetée par:</p>
                                                        <p class="text-dark">Mr ou Mme <?= $row['clientLastname'] ?></p>
                                                        <p class="text-dark"><?= $row['clientAddress'] ?> </p>
                                                        <p class="text-dark">
                                                            <a href="tel:<?= $row['clientPhone'] ?>"><?= $row['clientPhone'] ?></a>
                                                        </p>
                                                        <p>
                                                            <a href="mailto:<?= $row['client_email'] ?>"> <?= $row['client_email'] ?> </a>
                                                        </p>
                                                        <img src="<?= $row['card_url'] ?>" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    </div>
                </form>
            </div>
            <?= $pager->links() ?>
        </div>
    </div>
</div>


