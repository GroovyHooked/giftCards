<div class="container mt-2 mt-sm-4 mt-lg-5 mb-2 mb-lg-5">
    <div class="row">
        <div class="col-11 border mt-4 mb-4 ml-2 mr-2">
            <div class="container mt-3 mt-lg-5">
                <div class="row">
                    <div class="col-12 mb-3">
                        <button type="button" class="btn-sm btn-sm-outline-dark" id="helpMe">Aide</button>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <h2 class="text-center border-bottom mt-2">Tableau de bord</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="text-center">New York</div>
                        <div class="text-center myClock mb-4" id="myClockNY"></div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">Paris</div>
                        <div class="text-center myClock mb-4" id="myClock"></div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">Tokyo</div>
                        <div class="text-center myClock mb-4" id="myClockTK"></div>
                    </div>
                </div>
            </div>
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
            <div class="container">
                <div class="row">
                    <div class="col-6 offset-3">
                        <?php
                        if (session()->get('successCard')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->get('successCard') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="row">
                    <div class="col-6 mb-0 hiddenInfos">
                        <p class="text-center">Générer une carte cadeau</p>
                    </div>
                    <div class="col-6 mb-0 hiddenInfos">
                        <p class="text-center">Scanner une carte cadeau</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('create') ?>">
                                    <button type="button"
                                            class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3 dashButton">Générer
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button"
                                            class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3 dashButton">Générer
                                    </button>
                                </a>
                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Générer une carte cadeau
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('read') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Scanner
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Scanner
                                    </button>
                                </a>
                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Scanner une carte cadeau
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="row">
                    <div class="col-6 mb-0 hiddenInfos">
                        <p class="text-center">Bénéficiaires de carte cadeau</p>
                    </div>
                    <div class="col-6 mb-0 hiddenInfos">
                        <p class="text-center">Acquéreurs de carte cadeau</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('giftedclients') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Bénéficiaires
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Bénéficiaires
                                    </button>
                                </a>

                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Bénéficiaires de carte cadeau
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('clients') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Clients
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Clients
                                    </button>
                                </a>
                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Acquéreurs de carte cadeau
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 mb-3 mb-lg-0 col-lg-6 text-center">
                        <div class="col-12 mb-0 hiddenInfosBottom">
                            <p class="text-center">Liste de toutes les cartes</p>
                        </div>
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('created') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">Cartes
                                        émises
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">Cartes
                                        émises
                                    </button>
                                </a>
                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Liste de toutes les cartes
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mt-lg-0 col-lg-6 text-center">
                        <div class="col-12 mb-0 hiddenInfosBottom">
                            <p class="text-center">Liste des cartes utilisées</p>
                        </div>
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('used') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">cartes
                                        utilisées
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">cartes
                                        utilisées
                                    </button>
                                </a>
                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Liste des cartes utilisées
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 mb-3 mb-lg-0 col-lg-6 text-center">
                        <div class="col-12 mb-0 hiddenInfosBottom">
                            <p class="text-center">Liste des cartes non-utilisées</p>
                        </div>
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('pending') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">Cartes
                                        en
                                        circulation
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3 ">Cartes
                                        en
                                        circulation
                                    </button>
                                </a>
                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Liste des cartes non-utilisées
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mt-lg-0 col-lg-6 text-center">
                        <div class="col-12 mb-0 hiddenInfosBottom">
                            <p class="text-center">Informations sur les ventes</p>
                        </div>
                        <div class="dashButtonDiv">
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('accounting') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Comptabilité
                                    </button>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('index') ?>">
                                    <button type="button" class="btn btn-outline-secondary w-100 pt-lg-3 pb-lg-3">
                                        Comptabilité
                                    </button>
                                </a>
                            <?php endif; ?>
                            <div class="prez font-italic font-weight-lighter">
                                Informations sur les ventes
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>