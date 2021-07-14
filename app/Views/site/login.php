<div class="container">
    <div class="row">
        <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pb-3 form-wrapper pt-4">
            <div class="container">
                <h3 class="text-center">
                    <span class="ccc ee1">E</span>
                    <span class="ccc es1">s</span>
                    <span class="ccc ep">p</span>
                    <span class="ccc ea">a</span>
                    <span class="ccc ec">c</span>
                    <span class="ccc ee2">e</span>
                    <span class="ccc ml-1 mr-1"></span>
                    <span class="ccc ed">d</span>
                    <span class="ccc ee3">e</span>
                </h3>
                <h3 class="text-center">
                    <span class="ccc cc">C</span>
                    <span class="ccc co1">o</span>
                    <span class="ccc cn1">n</span>
                    <span class="ccc cn2">n</span>
                    <span class="ccc ce">e</span>
                    <span class="ccc cx">x</span>
                    <span class="ccc ci">i</span>
                    <span class="ccc co2">o</span>
                    <span class="ccc cn3">n</span>

                </h3>
                <hr>
                <?php if (session()->get('successRegist')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('successRegist') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->get('successModif')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('successModif') ?>
                    </div>
                <?php endif; ?>
                <?= form_open('index', ['id' => 'loginForm']);?>
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" >
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="text" class="form-control" name="password" id="password" value="">
                    </div>
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-outline-secondary" id="skicka" disabled="disabled">Connexion</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right mt-2">
                            <a href="<?=base_url('register')?>" class="">Pas encore de compte ?</a>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center mt-3 mb-4">
            <div class="col-12 text-center">
                <a href="<?=base_url('forgotPass')?>">Mot de passe oublié</a>
            </div>
        </div>
    </div>
</div>