<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="<?= site_url('create')?>" method="post">
                <h3 class="text-center mb-5">Création d'une carte cadeau</h3>
                <div class="container ">
                    <div class="row ">
                        <div class="form-group w-75 col-4 offset-3">
                            <h4>Offert par :</h4>
                        </div>
                        <div class="form-group w-75 col-4">
                            <h4>Cadeau pour :</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group w-75 col-4 offset-2">
                            <label for="lastname" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Nom" name="user_lastname" value="<?= set_value('lastname') ?>">
                            </div>
                        </div>
                        <div class="form-group w-75 col-4 ">
                            <label for="lastname" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Nom" name="client_lastname" value="<?= set_value('lastname') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group w-75 col-4 offset-2">
                            <label for="firstname" class="col-sm-2 col-form-label">Prenom</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Prénom" name="user_firstname" value="<?= set_value('firstname') ?>">
                            </div>
                        </div>
                        <div class="form-group w-75 col-4">
                            <label for="firstname" class="col-sm-2 col-form-label">Prenom</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Prénom" name="client_firstname" value="<?= set_value('firstname') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group w-75 col-4 offset-2">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" placeholder="Email" name="user_email" value="<?= set_value('user_email') ?>">
                            </div>
                        </div>
                        <div class="form-group w-75 col-4">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" placeholder="Email" name="client_email" value="<?= set_value('client_email') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group w-75 col-4 offset-2">
                            <label for="address" class="col-sm-6 col-form-label">Adresse</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control " placeholder="Adresse" name="user_address" value="<?= set_value('user_address') ?>">
                            </div>
                        </div>
                        <div class="form-group w-75 col-4">
                            <label for="address" class="col-sm-6 col-form-label">Adresse</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control " placeholder="Adresse" name="client_address" value="<?= set_value('client_address') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group w-75 col-4 offset-2">
                            <label for="phone" class="col-sm-6 col-form-label">N° de téléphone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="N° de téléphone" name="user_phone" value="<?= set_value('user_phone') ?>">
                            </div>
                        </div>
                        <div class="form-group w-75 col-4">
                            <label for="phone" class="col-sm-6 col-form-label">N° de téléphone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="N° de téléphone" name="client_phone" value="<?= set_value('client_phone') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center col-8 offset-2">
                        <div class="form-group w-50">
                            <div class="input-group">
                                <label for="value" class="col-sm-6 col-form-label">Valeur de la carte</label>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="value">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif;
                    if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($table)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <?= $table ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="form-group">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-secondary" name="submit">Création</button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group">
                                <div class="col-12">
                                    <a href="<?= site_url('dashboard')?>">Retour au tableau de bord</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>