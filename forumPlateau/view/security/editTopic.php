<?php

$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];
?>

<form action="index.php?ctrl=security&action=editTopic&id=<?= $topic->getId()?>" method='POST' id="submit" >
    
    <label for="title">Titre:</label>
    <input type="text" name="title"size="10" value="<?= $topic->getTitle()?>"><br><?php

    foreach($posts as $post){?>
        
        <label for="post">Post:</label><br>
        <textarea name="post" rows="6" cols="50"><?= $post->getTexte()?></textarea><br><?php
    }?>

    <input type="submit" name="submit" value="submit">

</form>
