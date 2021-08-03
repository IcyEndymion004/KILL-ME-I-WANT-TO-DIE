<?php

namespace icyEndymion004;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\server;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\InvMenu;


class main extends PluginBase{ 

    public function onLoad(){
        $this->getLogger()->info("Someone FUCKING KILL ME");

      }
      public function onEnable() : void{
		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
	}
    
      public function onDisable(){
        $this->getLogger()->info("I WANT TO DIE");
      }
      public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        switch($cmd->getName()){
          case "killme":
            if(!$sender instanceof Player){ 
              $sender->sendMessage("FUCK OFF"); 
            }else{ 
                $menu = InvMenu::create(InvMenu::TYPE_CHEST);
                $menu->setListener(function(InvMenuTransaction $transaction) : InvMenuTransactionResult{
	            $player = $transaction->getPlayer();
	            $action = $transaction->getAction();
	            $player->removeWindow($action->getInventory());
	            return $transaction->discard()->then(function(Player $player) : void{
		        $player->sendForm(new class() implements Form{});
	            });
                });
            }
          break;
        }
        return true;
      }
     
}
