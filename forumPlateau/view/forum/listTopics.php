<?php

$categories = $result["data"]["categories"];
$topics = $result["data"]['topics'];

?>

<h1>liste topics</h1>

<form >
    <select name="categorie" id='cateorie'>
        <option value="">--Catégorie--</option><?php
        foreach($categories as $categorie){?>

                <option value="<?= $categorie->getCategorie();?>"> <?= $categorie->getCategorie();?></option>

            <?php

        }?>
    </select>
    <input type="submit" value="Recherche">
</form>
<?php
foreach($topics as $topic){
    ?>  
    <div>
        <a href="index.php?ctrl=topics&action=topics"><p><?=$topic->getTitle()?> - <?=$topic->getCreationdate()?></p></a>
    </div>
    <?php
}


  
