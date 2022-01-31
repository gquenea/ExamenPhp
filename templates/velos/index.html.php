<?php foreach ($velos as $velo) { ?>

    <div class="row mt-3 mb-3 bg-warning">

        <h2><?= $velo->getName() ?></h2>
        <p><?= $velo->getDescription() ?></p>
        <img src="images/<?= $velo->getImage() ?>" style="max-width:200px" alt="">
        <p><?= $velo->getPrice() ?> €</p>
        <a class="btn btn-primary" href="?type=velo&action=show&id=<?= $velo->getId() ?>">Voir plus</a>



    </div>

<?php } ?>