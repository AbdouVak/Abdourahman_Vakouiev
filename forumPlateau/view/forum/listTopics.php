<?php

$categories = $result["data"]["categories"];
$topics = $result["data"]["topics"];
$category = $result["data"]["category"];

if($category){
    ?><h1>liste topics <?= $category->getCategorie()?></h1><?php
}

foreach($categories as $categorie){?>  
    <a href='index.php?ctrl=forum&action=listTopicsByCategorie&id=<?=$categorie->getID()?>'><?=$categorie->getCategorie()?></a><?php
}

if(isset($topics)){
    foreach($topics as $topic){ ?>
            <div>
                <a href="index.php?ctrl=post&action=listPostByTopic&id=<?=$topic->getID()?>">
                
                <p><?=$topic->getTitle()?></a> 

                - Date de creation : <?=$topic->getCreationdate()?> 
                
                <?php if($topic->getStatus() == "Close"){
                    echo "Status :".$topic->getStatus() ;
                }?></p>

                <?php
                if(App\Session::getUser() && (App\Session::getUser() == $topic->getUser() || App\Session::isAdmin())) { ?>
                    <a href="index.php?ctrl=security&action=changeStatusTopic&id=<?=$topic->getID()?>">Changer status</a>
                    <a href="index.php?ctrl=security&action=deleteTopic&id=<?=$topic->getID()?>">supprimer</a>
                    <a href="index.php?ctrl=security&action=editTopicView&id=<?=$topic->getID()?>">modifier</a><?php 
                } ?>
                
            </div><?php
    }
}

?>
    <p> -------------------------------------------------------------------------------------------- </p><?php

if(App\Session::getUser()) { ?>

    <form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>" method='POST'id="submit" >

    <label for="title">Titre:</label>
    <input type="text" name="title"size="10"><br>

    <label for="post">Post:</label><br>
    <textarea name="post"rows="6" cols="50"></textarea><br>
    
    <input type="submit" name="submit" value="submit">

    
    </form><?php } else {
        echo "<p>Vous devez être connecté pour créer un nouveau topic !</p>";
}
