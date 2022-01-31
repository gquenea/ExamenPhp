<div class="row mt-3 mb-3 bg-warning">

    <h2><?= $velo->getName() ?></h2>
    <p><?= $velo->getDescription() ?></p>
    <img src="images/<?= $velo->getImage() ?>" style="max-width:200px" alt="">
    <p><?= $velo->getPrice() ?> €</p>
    <form action="?type=velo&action=delete&id=" method="post">
        <button class="btn btn-danger" type="submit" name="id" value="<?= $velo->getId() ?>">Supprimer</button>
    </form>

    <h4>Ajouter un commentaire :</h4>
    <form class="mt-3 mb-5" action="?type=avis&action=new&id=.php" method="post">
        <div class="form-group"><input placeholder="Votre nom" type="text" name="author" id=""></div>
        <div class="form-group"><textarea placeholder="Votre commentaire" type="text" name="content" id=""></textarea></div>
        <div class="form-group"><button type="submit" class="btn btn-success" name="id" value="<?= $velo->getId() ?>">Poster</button></div>
    </form>


    <?php foreach ($avis as $avi) { ?>
        <div class=" bg-success mt-2 mb-2">
            <h3><strong><?= $avi->getAuthor() ?></strong></h3>
            <p class="ms-5"><?= $avi->getContent() ?></p>
            <form action="?type=avis&action=delete" method="post">
                <button class="btn btn-danger" name="id" value="<?= $avi->getId() ?>">Supprimer</button>
                <input type="hidden" name="veloId" value="<?= $velo->getId() ?>">
            </form>
        </div>
    <?php } ?>




</div>