<?php 

$categories = $result["data"]["categories"];
$topics = $result["data"]["topics"];

?>


<select name="categorie" id='cateorie'>
    <option value="">--Catégorie--</option><?php
    foreach($categories as $categorie){?>

            <option value="<?= $categorie->getCategorie();?>"> <?= $categorie->getCategorie();?></option>

        <?php

    }?>
</select>

<?php

