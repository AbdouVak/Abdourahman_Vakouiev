<?php

$categories = $result["data"]["categories"];
$topics = $result["data"]['topics'];

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
foreach($topics as $topic){
    ?>  
    <div>
        <p><?=$topic->getTitle()?> - <?=$topic->getCreationdate()?></p>
    </div>
    <?php
}


  
