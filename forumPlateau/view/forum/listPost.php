<?php

$posts = $result["data"]['posts'];
$topic =  $result["data"]['topic'];

foreach($topic as $topicName){?>  
    <h1> " <?= $topicName->getTitle()?> "</h1><?php
}
?>

<p> --------------------------------------------------------------------------------------------------------------------- </p>
   
<?php
if(isset($posts)){
    foreach($posts as $post){?>  

        <div>
            <a href="index.php?ctrl=forum&action=profilView&id=<?= $post->getUser()->getId()?>">
            
            <p><?=$post->getUser()->getPseudo()?></a>- <?=$post->getCreationdate()?> -<?php 
            if(App\Session::getUser() && (App\Session::getUser() == $topic->getUser() || App\Session::isAdmin())){?>
                <a href="index.php?ctrl=security&action=deletePost&id=<?=$post->getID()?>">supprimer</a><?php 
            }
            

            if($topic->getStatus() == "Close"){
                echo " Status :".$topic->getStatus() ;
            }?> </p>

            <p><?=$post->getTexte()?></p>
            <p> --------------------------------------------------------------------------------------------------------------------- </p>
    
        </div><?php
    }
}

if($topic->getStatus() == "Open") { 
    if(App\Session::getUser()) { ?>
        <form action="index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>" method='POST'id="submit" >

            <label for="post">Post:</label><br>
            <textarea name="post"rows="6" cols="50"></textarea><br>
                
            <input type="submit" name="submit" value="submit">

        </form><?php 
        }else{
            echo "<p>Vous devez être connecté pour créer un nouveau topic !</p>";
        }
}else{
    echo "<p>Le topic est fermé !</p>";
}

