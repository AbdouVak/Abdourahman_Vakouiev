<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]["categories"];
?>

<h1>liste topics</h1>

<select name="categorie" id='cateorie'>
    <option value="">--Catégorie--</option><?php
    foreach($categories as $categorie){?>

            <option value="<?= $categorie->getCategorie();?>"> <?= $categorie->getCategorie();?></option>

        <?php

    }?>
</select>

<?php
foreach($topics as $topic ){
    ?>
        <p><?=$topic->getTitle()?></p>
    <?php
}


  
