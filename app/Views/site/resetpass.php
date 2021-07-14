<div class="container">
    <div class="row">
        <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pb-3 form-wrapper pt-4">
            <div class="container">
                <h3 class="text-center">Modification du mot de passe</h3>
                <?php if (isset($token)) : ?>
                <form class="" action="<?= base_url('resetpass?token='.$token['token'])?>" method="post">
                <?php else : ?>
                <form class="" action="<?= base_url('resetpass')?>" method="post">
                <?php endif; ?>

                    <div class="form-group">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="text" class="form-control" name="password" id="password" value="">
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Ressaisissez votre mot de passe</label>
                        <input type="text" class="form-control" name="passwordConfirm" id="passwordConfirm" value="">
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
                            <a href="<?= base_url('public') ?>">Page de connexion</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
            if (isset($messageAlert)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $messageAlert ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
            if (isset($message)) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

