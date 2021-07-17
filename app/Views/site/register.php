<div class="container mt-3 mb-3 mw-75">
    <div class="row ml-1 mr-1 pt-3">
        <div class="col-12">
            <form action="<?= base_url('register') ?>" method="POST">
                <div class="container">
                    <h3 class="text-center">Inscription</h3>
                    <div class="form-group">
                        <label for="company" class="offset-1 col-form-label">Nom de l'établissement</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Nom de l'établissement" name="company" value="<?= set_value('company') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="offset-1 col-form-label">Nom</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Nom" name="lastname" value="<?= set_value('lastname') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="offset-1 col-form-label">Prenom</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Prénom" name="firstname" value="<?= set_value('firstname') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="offset-1 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ?>">
                        </div>
                    </div>
                    <div class="form-group passwdTooltip">
                        <label for="password" class="offset-1 col-form-label">Mot de passe</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control " placeholder="Mot de passe" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password2" class="offset-1 col-form-label">Ressaisissez votre mot de passe</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Mot de passe" name="password2" value="">
                        </div>
                    </div>
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="form-group">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-secondary" name="submit">Inscription</button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group">
                                <div class="col-12">
                                    <a href="<?= base_url('index') ?>">Je possède déjà un compte</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>