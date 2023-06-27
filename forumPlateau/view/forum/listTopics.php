<?php

$categories = $result["data"]["categories"];
$topics = $result["data"]['topics'];

?>

<h1>liste topics</h1>


<?php
foreach($categories as $categorie){?>  
    <a href='index.php?ctrl=forum&action=listTopics&id=<?=$categorie->getID()?>'><?=$categorie->getCategorie()?></a><?php
}


foreach($topics as $topic){

    if($topic->getTitle() != null){?>
        <div>
            <a href="index.php?ctrl=post&action=topics"><p><?=$topic->getTitle()?> - <?=$topic->getCreationdate()?></p></a>
        </div><?php
    }
}
  
