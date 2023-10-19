<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: ../../index.php');
    exit();
}
require_once('../includes/utilitaires.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="../../client/css/styles.css">
    <link rel="stylesheet" href="../../client/utilitaires/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/select/select2.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/select/select2-bootstrap-5-theme.min.css">
</head>

<body class="body-admin">
    <nav class="nav-container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-4">
                <div class="d-flex flex-row align-items-center">
                    <a class="container-logo" href="./index.html">
                        <img src="<?= getURL() ?>/client/images/log.png" />

                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container-menu mt-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="true">Produits</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category-tab-pane" type="button" role="tab" aria-controls="category-tab-pane" aria-selected="true">Catégories</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member-tab-pane" type="button" role="tab" aria-controls="member-tab-pane" aria-selected="false">Membres</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="content-body">
        <div class="tab-content h-100" id="myTabContent">
            <!-- Tab produits -->
            <div class="tab-pane fade show active bg-body-secondary h-100" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                <div class="container">
                    <!-- Liste des produits -->
                    <div class="admin-list d-flex flex-column px-5">
                        <div class="py-4 container-search-admin">
                            <div class="d-flex align-items-center gap-2 content-search-admin">
                                <span><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control input-search-admin" placeholder="Rechercher ..." />
                            </div>
                        </div>
                        <div class="products-container py-3">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-6 d-flex gap-2 align-items-center">
                                            <span><b>Catégorie :</b></span>
                                            <select class="form-control category-admin">
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex gap-2 align-items-center">
                                            <span><b>Trier :</b> </span>
                                            <select class="form-control sort-admin">
                                                <option value="title">Titre</option>
                                                <option value="price">Prix</option>
                                                <option value="quantity">Quantite</option>
                                                <option value="date_ajout">Date ajout</option>                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 d-flex justify-content-end">
                                    <button class="btn btn-primary" id="add-product">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                            <div class="py-4">
                                <div class="admin-products">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire d'ajout d'un produit -->
                    <div class="admin-add flex-column py-5 d-none px-sm-3 px-md-5 px-2">
                        <div class="alert alert-danger error-add d-none" role="dialog"></div>
                        <div class="alert alert-success success-add d-none" role="dialog"></div>
                        <div class="card w-100 d-flex flex-column gap-3 p-3">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-close close-form-add-product" aria-label="Close"></button>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <h1><b class="label-form-add">Ajouter un produit</b></h1>
                            </div>
                            <div class="row px-md-5">
                                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column gap-2 pt-3">
                                    <label for="name-login" class="fw-semibold">Titre</label>
                                    <input type="text" name="title" id="title" class="form-control fw-semibold input-login" placeholder="Titre" />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column gap-2 pt-3">
                                    <label for="name-login" class="fw-semibold">Quantite</label>
                                    <input type="number" min="0" name="quantity" id="quantity" class="form-control fw-semibold input-login" placeholder="Quantite" />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column gap-2 pt-3">
                                    <label for="name-login" class="fw-semibold">Prix</label>
                                    <input type="number" min="0" name="price" id="price" class="form-control fw-semibold input-login" placeholder="Prix" />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column gap-2 pt-3">
                                    <label for="name-login" class="fw-semibold">Categorie</label>
                                    <select class="form-control category-admin" id="categ-add">
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column gap-2 pt-3">
                                    <label for="name-login" class="fw-semibold">Image</label>
                                    <input type="file" name="img-product" id="img-product" class="form-control fw-semibold input-login" placeholder="Image" />
                                </div>
                                <div class="col-12 d-flex flex-column gap-2 pt-3">
                                    <label for="name-login" class="fw-semibold">Description</label>
                                    <textarea rows="4" class="form-control" id="description" placeholder="Description"></textarea>
                                </div>
                                <div class="d-flex align-items-center justify-content-end gap-4 pt-3">
                                    <button type="submit" class="btn btn-dark px-4 btn-cancel">Annuler</button>
                                    <button type="submit" class="btn btn-primary px-4 btn-save">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de modification d'un produit -->
                    <div class="admin-update flex-column py-5 d-none px-sm-3 px-md-5 px-2">
                        <div class="alert alert-danger error-update d-none" role="dialog"></div>
                        <div class="alert alert-success success-update d-none" role="dialog"></div>
                        <div class="card w-100 d-flex flex-column gap-3 p-3">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-close close-form-update-product" aria-label="Close"></button>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <h1><b>Modifier un produit</b></h1>
                            </div>
                            <div class="row px-md-5">
                                <div class="col-4">
                                    <div class="d-flex justify-content-center aligin-items-center p-4">
                                        <img src="https://images-na.ssl-images-amazon.com/images/M/MV5BMTg0MTU1MTg4NF5BMl5BanBnXkFtZTgwMDgzNzYxMTE@._V1_SX300.jpg" class="img-fluid rounded product-img" alt="Image">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6 d-flex flex-column gap-2 pt-3">
                                            <label for="name-login" class="fw-semibold">Titre</label>
                                            <input type="text" name="title" id="title-update" class="form-control input-login" placeholder="Titre" />
                                        </div>
                                        <div class="col-12 col-md-6 d-flex flex-column gap-2 pt-3">
                                            <label for="name-login" class="fw-semibold">Quantite</label>
                                            <input type="number" min="0" name="quantity" id="quantity-update" class="form-control  input-login" placeholder="Quantite" />
                                        </div>
                                        <div class="col-12 col-md-6 d-flex flex-column gap-2 pt-3">
                                            <label for="name-login" class="fw-semibold">Prix</label>
                                            <input type="number" min="0" name="price" id="price-update" class="form-control  input-login" placeholder="Prix" />
                                        </div>
                                        <div class="col-12 col-md-6 d-flex flex-column gap-2 pt-3">
                                            <label for="name-login" class="fw-semibold">Categorie</label>
                                            <select class="form-control category-admin" id="categ-update">
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex flex-column gap-2 pt-3">
                                            <label for="name-login" class="fw-semibold">Image</label>
                                            <input type="file" name="img-product" id="img-product-update" class="form-control  input-login" placeholder="Image" />
                                        </div>
                                        <div class="col-12 d-flex flex-column gap-2 pt-3">
                                            <label for="name-login" class="fw-semibold">Description</label>
                                            <textarea rows="4" class="form-control" id="description-update" placeholder="Description"></textarea>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end gap-4 pt-3">
                                            <button type="submit" class="btn btn-dark px-4 btn-cancel-update">Annuler</button>
                                            <button type="submit" class="btn btn-primary px-4 btn-update-product">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab categories -->
            <div class="tab-pane fade bg-body-secondary h-100" id="category-tab-pane" role="tabpanel" aria-labelledby="category-tab" tabindex="0">
                <div class="container">
                    <!-- Liste des Categories -->
                    <div class="admin-list-categ d-flex flex-column px-5">
                        <div class="py-4 container-search-admin">
                            <div class="d-flex align-items-center gap-2 content-search-admin">
                                <span><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control input-search-admin" placeholder="Rechercher ..." />
                            </div>
                        </div>
                        <div class="products-container py-3">
                            <div class="row align-items-center">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" id="add-categ">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                            <div class="py-4">
                                <div class="admin-categs">
                                    <div class="table-responsive">
                                        <table class="table rounded my-2 bg-white">
                                            <thead>
                                                <tr style="font-size:1.5rem;">
                                                    <th scope="col">ID</th>
                                                    <th scope="col" class="col-9">NOM</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list-categs">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire d'ajout d'une categorie -->
                    <div class="admin-add-categ flex-column py-5 d-none px-sm-3 px-md-5 px-2">
                        <div class="alert alert-danger error-add-categ d-none" role="dialog"></div>
                        <div class="alert alert-success success-add-categ d-none" role="dialog"></div>
                        <div class="card w-100 d-flex flex-column gap-3 p-3">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-close close-form-add-categ" aria-label="Close"></button>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <h1><b>Ajouter un categorie</b></h1>
                            </div>
                            <div class="row px-md-5">
                                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column gap-2 pt-3">
                                    <label for="name-login" class="fw-semibold">Nom</label>
                                    <input type="text" name="title-categ" id="title-categ" class="form-control fw-semibold input-login" placeholder="Nom" />
                                </div>
                                <div class="d-flex align-items-center justify-content-end gap-4 pt-3">
                                    <button type="submit" class="btn btn-dark px-4 btn-cancel-categ">Annuler</button>
                                    <button type="submit" class="btn btn-primary px-4 btn-save-categ">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="member-tab-pane" role="tabpanel" aria-labelledby="member-tab" tabindex="0">...</div>
        </div>
    </div>
    <script src="../../client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/popper.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../client/utilitaires/select/select2.min.js"></script>
    <script src="../../client/js/admin.js"></script>
</body>

</html>