<?php

$posts = $result["data"]['posts'];
$IDPost =  $result["data"]['IDPost'];

$topicNames = $result["data"]["topicNames"];

foreach($topicNames as $topicName){?>  
    <h1> " <?= $topicName->getTitle()?> "</h1><?php
}
?>

<p> --------------------------------------------------------------------------------------------------------------------- </p>
   
<?php
foreach($posts as $post){?>  

    <div>
        <p><?=$post->getUser()->getPseudo()?> - <?=$post->getCreationdate()?> </p>
        <p><?=$post->getTexte()?> </p>
        <p> --------------------------------------------------------------------------------------------------------------------- </p>
   
    </div><?php
}

?>

<form action="index.php?ctrl=post&action=addPost&id=<?= $IDPost ?>" method='POST'id="submit" >


    <label for="post">Post:</label><br>
    <textarea name="post"rows="6" cols="50">
    </textarea><br>
        
    <input type="submit" name="submit" value="submit">

</form><?php
?>