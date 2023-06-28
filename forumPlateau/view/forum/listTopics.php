<?php

$categories = $result["data"]["categories"];
$topics = $result["data"]['topics'];


?>

<h1>liste topics</h1>


<?php


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
}else{?>

    <p>Pas de topic pour cette categorie</p><?php

}?>
<p>----------------------------------------------------------</p>

<form>

    <label for="name">Titre:</label>
    <input type="text" id="name" name="name" required
        minlength="4" maxlength="8" size="10"> <?= date('d-m-y h:i:s');?><br></br>


    <label for="post">Post:</label><br>
    <textarea id="post" name="post"rows="6" cols="50">
    </textarea><br>

    
    <input type="submit">

    
</form>
  
