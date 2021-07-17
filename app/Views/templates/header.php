<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('/favicon/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('/favicon/site.webmanifest') ?>">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/style.css') ?>"/>
    <title><?= $title ?></title>
</head>

<body>
<div id="page-container">
    <div id="content-wrap" class="sousBody">
        <div id="header" class="header-top">
            <nav class="navbar navbar-light  pt-3 pb-3">
                <div class="container">
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <a class="text-white" href="<?= site_url('dashboard') ?>"><img
                                    src="<?= base_url('/assets/images/Logo.jpeg') ?>" alt="LOGO"></a>
                    <?php else : ?>
                        <a class="text-white" href="<?= site_url('/') ?>"><img
                                    src="<?= base_url('/assets/images/Logo.jpeg') ?>" alt="LOGO"></a>
                    <?php endif; ?>

                    <?php if (session()->get('isLoggedIn')) : ?>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-light btn-dark1 justify-content-end"
                                    id="btn-dark1"><img
                                        src="<?= base_url('/favicon/torch-32x32.png') ?>" class="headerIcon" id="myImg">
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-dark btn-outline-secondary dropdown-toggle"
                                    type="button" id="dropdownMenu1" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <?= session()->get('firstname') ?> <?= session()->get('lastname') ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item " href="<?= base_url('dashboard') ?>">Accueil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('create') ?>">Créer</a>
                                <a class="dropdown-item" href="<?= base_url('read') ?>">Scanner</a>
                                <a class="dropdown-item" href="<?= base_url('created') ?>">Cartes</a>
                                <a class="dropdown-item" href="<?= base_url('used') ?>">Utilisées</a>
                                <a class="dropdown-item" href="<?= base_url('pending') ?>">En Attente</a>
                                <a class="dropdown-item" href="<?= base_url('giftedclients') ?>">Béneficiaies</a>
                                <a class="dropdown-item" href="<?= base_url('clients') ?>">Clients</a>
                                <a class="dropdown-item" href="<?= base_url('accounting') ?>">Comptabilité</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('myaccount') ?>">Mon Compte</a>
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">Deconnexion</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-light btn-dark1" id="btn-dark1"><img
                                        src="<?= base_url('/favicon/torch-32x32.png') ?>" class="headerIcon" id="myImg">
                            </button>
                            <!--  <button type="button" class="btn btn-outline-light" id="btn-dark2"><img
                                    src="<?= base_url('/favicon/controller-32x32.png') ?>" class="headerIcon" id="myImg">
                        </button> -->
                        </div>
                        <div class="" id="navcol-1">
                            <ul class="nav navbar-nav">
                                <li class="nav-item" role="presentation"><a class="nav-link text-white"
                                                                            href="<?= base_url('register') ?>">Inscription</a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        </div>