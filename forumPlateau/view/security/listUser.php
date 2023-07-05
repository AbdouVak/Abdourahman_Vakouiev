<?php

$user = $result["data"]["user"];

if(isset($user)){
    foreach($user as $user){

        if($user->getPseudo() != null){?>
            <div>
                <a href="index.php?ctrl=forum&action=profilView&id=<?= $user->getId()?>"><p><?=$user->getPseudo()?></p> </a> 
                <a href="index.php?ctrl=security&action=changeStatusUser&id=<?= $user->getId()?>"><p>changer status </p></a>
                
                <p>Status:<?= $user->getStatus()?></p>
            </div><?php
        }
        
    }
}else if($addTopic){?>

    <p>Pas de topic pour cette categorie</p><?php

}