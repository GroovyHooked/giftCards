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
            <img src="<?= base_url('/assets/images/supportBis.png') ?>" alt="dessin de technicien" id="imgContact">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
            if (session()->get('successTelBot')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('successTelBot') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
            if (session()->get('successSentMail')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('successSentMail') ?>
                </div>
            <?php endif; ?>
        </div>
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
    <div class="row">
        <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 pb-3 form-wrapper" id="contactForm">
            <div class="container">
                <div class="row justify-content-center">
                    <h3>Formulaire de Contact</h3>
                    <?= form_open('contact', 'class="helpForm border pt-3 pl-3 pr-3" id="helpFormId"') ?>
                    <div class="form-group">
                        <p class="text-center">Indiquez l'origine de votre problème </p>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-10 col-lg-8">
                                    <?php
                                    $data1 = [
                                        'class' => 'custom-select'
                                    ];
                                    $options = [
                                        'conexion' => 'Problèmes de connexion',
                                        'email' => 'Problème lié au emails',
                                        'codeqr' => 'Problème lié aux codes QR',
                                        'other' => 'Autre'
                                    ];
                                    echo form_dropdown('problem', $options, 'other');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center mt-3">
                                <p class="text-center">Saississez votre numéro de téléphone  </p>
                                <div class="col-8 col-lg-6">
                                    <?php
                                    $data1 = [
                                        'class' => 'mt-1',
                                        'placeholder' => '060000....'
                                    ];
                                    echo form_input('telnumber', '',$data1, 'number' );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center">Décrivez votre problème:</p>
                                    <?php
                                    $data = [
                                        'name' => 'message',
                                        'id' => 'message',
                                        'class' => 'form-control',
                                    ];
                                    echo form_textarea($data) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 offset-4">
                                <button type="submit" class="btn btn-outline-secondary">Envoyer</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <p class="text-center">Une fois le formulaire soumis, un technicien vous contactera dans les plus brefs délais </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>