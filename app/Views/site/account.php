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
<pre>
    <?php
    if(isset($comp)) {
        var_dump($comp);
        var_dump($last);
        var_dump($first);
        var_dump($mail);
    }
    ?>
</pre>
<div class="h2 text-center text-info accountTitle">Mon Compte</div>
<div class="container acountContainer">
    <form action="myaccount" method="post" class="accountForm">
        <h4> Établissement: </h4>
        <input type="text" name="company" value="<?= $clientInfo['company'] ?>">
        <p> Nom :
            <input type="text" class="firstInputAccount" name="lastName" value="<?= $clientInfo['lastname'] ?>">
        </p>
        <p> Prénom :
            <input type="text" name="firstName" value="<?= $clientInfo['firstname'] ?>">
        </p>
        <p> Email :
            <input type="text" class="emailInput" name="email" value="<?= $clientInfo['email'] ?>">
        </p>
        <button type="submit" class="btn btn-outline-secondary" name="modifier" value="<?= $clientInfo['id'] ?>">
            Modifier
        </button>
    </form>
</div>
<?php if (isset($validation)) : ?>
    <div class="col-12">
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    </div>
<?php endif; ?>