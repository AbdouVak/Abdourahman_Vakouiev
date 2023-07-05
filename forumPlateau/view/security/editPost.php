<?php

$posts = $result["data"]["posts"];

?>

<form action="index.php?ctrl=security&action=editPost&id=<?= $topic->getId()?>" method='POST' id="submit" ><?php

    foreach($posts as $post){?>
        
        <label for="post">Post:</label><br>
        <textarea name="post" rows="6" cols="50"><?= $post->getTexte()?></textarea><br><?php
    }?>

    <input type="submit" name="submit" value="submit">

</form>
