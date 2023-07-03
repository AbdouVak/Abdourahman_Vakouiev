
<?php
$pseudo = $result["data"]["pseudo"];
$email = $result["data"]["email"];
$topics = $result["data"]["topics"];

?>
<h2><?= $pseudo?></h2><?php 

if($email != null){?>
    <h3>Email: <?= $email?></h3> <?php
}?>


<?php

if($topics != null){
    foreach($topics as $topic){

        if($topic->getTitle() != null){?>
            <div>
                <a href="index.php?ctrl=post&action=listPostByTopic&id=<?=$topic->getID()?>"><p><?=$topic->getTitle()?> - <?=$topic->getCreationdate()?></p></a>
            </div><?php
        }
        
    }
}

