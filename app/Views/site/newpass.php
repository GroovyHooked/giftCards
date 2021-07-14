<div class="container">
    <div class="row">
        <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pb-3 form-wrapper pt-4">
            <div class="container">
                <h3 class="text-center">Mot de passe oublié</h3>
                <form class="" action="<?= base_url('forgotPass') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="text" class="form-control" name="email" id="email"
                               value="<?= set_value('email') ?>">
                    </div>
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <?php
                                if (session()->get('successRest')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->get('successRest') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <?php
                                if (session()->get('fail')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->get('fail') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-outline-secondary">Envoyer</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="<?= base_url('index') ?>">Page de connexion</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>