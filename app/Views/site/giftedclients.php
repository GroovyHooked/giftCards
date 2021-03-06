<div style="overflow-x:auto;">
    <div class="container mt-5">
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
                <h3 class="text-center">Cartes offertes pour:</h3>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>tel</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clients as $row) { ?>
                    <tr>
                        <th scope="row"><?= $row['id'] ?></th>
                        <td><?= $row['firstname'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a>  </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal<?= $row['id'] ?>">
                                +
                            </button>

                            <!-- Modal -->
                            <div class="modal" id="modal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Modal">Informations supplémentaires</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-10 offset-2">
                                                        <p><a href="tel:<?= $row['phone'] ?>"><?= $row['phone'] ?></a></p>
                                                        <p><?= $row['address'] ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                    data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-1">
                <?= $pager->links() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!--<p>Nb total de résulats: ?= count($totalGifteds)?></p>-->
            </div>
        </div>
    </div>
</div>
