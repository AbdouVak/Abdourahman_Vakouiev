<?php

$categories = $result["data"]["categories"];
$topics = $result["data"]["topics"];
$addTopic = $result["data"]["addTopic"];
$IDCategorie = $result["data"]["IDCategorie"];
$categoryNames = $result["data"]["categoryNames"];

if($categoryNames != null){
    foreach($categoryNames as $categoryName){?>  
        <h1>liste topics <?= $categoryName->getCategorie()?></h1><?php
    }
}


foreach($categories as $categorie){?>  
    <a href='index.php?ctrl=forum&action=listTopicsByCategorie&id=<?=$categorie->getID()?>'><?=$categorie->getCategorie()?></a><?php
}

if(isset($topics)){
    foreach($topics as $topic){

        if($topic->getTitle() != null){?>
            <div>
                <a href="index.php?ctrl=post&action=listPostByTopic&id=<?=$topic->getID()?>"><p><?=$topic->getTitle()?> - <?=$topic->getCreationdate()?></p></a>
            </div><?php
        }
        
    }
}else if($addTopic){?>

    <p>Pas de topic pour cette categorie</p><?php

}

if($addTopic){?>
    <p> -------------------------------------------------------------------------------------------- </p>

    <form action="index.php?ctrl=forum&action=addTopic&id=<?= $IDCategorie ?>" method='POST'id="submit" >

    <label for="title">Titre:</label>
    <input type="text" name="title"size="10"><br>

    <label for="post">Post:</label><br>
    <textarea name="post"rows="6" cols="50"></textarea><br>
    
    <input type="submit" name="submit" value="submit">

    
    </form><?php
}?>
