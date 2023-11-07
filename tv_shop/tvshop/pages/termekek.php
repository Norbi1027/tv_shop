<div class="row">
    <?php
    foreach ($db->osszesTv() as $row) {
        $image = null;
        if (file_exists("./images/" . $row['tv_marka'] . ".jpg")) {
            $image = "./images/" . $row['tv_marka'] . ".jpg";
        } else if (file_exists("./images/" . $row['tv_marka'] . ".jpeg")) {
            $image = "./images/" . $row['tv_marka'] . ".jpeg";
        } else if (file_exists("./images/" . $row['tv_marka'] . ".png")) {
            $image = "./images/" . $row['tv_marka'] . ".png";
        } else {
            $image = "./images/noimage.jpg";
        }
        $card = '<div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['tv_neve'] . '</h5>' .
                '<p class="card-text">Márkája: ' . $row['tv_marka'] . '</p>' .
                '<p class="card-text">Átmérője: ' . $row['tv_atmero'] . '</p>' .
                '<p class="card-text">Kijelző:' . $row['tv_kijelzo'] . '</p>' .
                '<p class="card-text">Felbontás' . $row['tv_felbontas'] . '</p>' .
                '<a href="index.php?menu=home&id=' . $row['tv_id'] . '" class="btn btn-primary">Kiválaszt</a>
                    </div>
                </div>
            ';
        echo $card;
    }
    ?>

</div>