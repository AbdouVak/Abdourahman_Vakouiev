<?php

$user = $result["data"]["user"];

if(isset($user)){
    foreach($user as $user){

        if($user->getPseudo() != null){?>
            <div>
                <a href="index.php?ctrl=forum&action=profilView&id=<?= $user->getId()?>"><p><?=$user->getPseudo()?></p> </a> 
                <a href="index.php?ctrl=security&action=ban&id=<?= $user->getId()?>"><p>ban</p></a>
                <a href="index.php?ctrl=security&action=unban&id=<?= $user->getId()?>"><p>Unban</p></a>
                <p>Status:<?php 
                if($user->getStatus()){
                    echo "Actif";
                }else{
                    echo "Banni";
                }?></p>
            </div><?php
        }
        
    }
}else if($addTopic){?>

    <p>Pas de topic pour cette categorie</p><?php

}