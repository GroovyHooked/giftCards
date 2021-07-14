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
</div>
<div class="container mt-4">
    <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center">
                    <div class="col-12">
                        <label for="avatar">Accédez à votre appareil photo</label>
                    </div>
                    <div class="col-12">
                        <input type="file" id="avatar" name="avatar" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="<?= base_url('dashboard') ?>">Retour au tableau de bord</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="width: 500px" id="reader"></div>