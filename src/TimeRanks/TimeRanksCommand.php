<?php

namespace TimeRanks;

use pocketmine\command\CommandSender;
use pocketmine\Player;

class TimeRanksCommand{

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function run(CommandSender $sender, array $args){
        if(!isset($args[0])){
            $sender->sendMessage("§3Time§4Ranks Plugin By KurutaSora");
            $sender->sendMessage("§3Use /timeranks time ".($sender instanceof Player ? "[player]" : "<player>"));
            return true;
        }
        $sub = array_shift($args);
        switch(strtolower($sub)){
            case "time":
                if(isset($args[0])){
                    if(!$this->plugin->getServer()->getOfflinePlayer($args[0])->hasPlayedBefore()){
                        $sender->sendMessage("§4»§f Player ".$args[0]." §3Tidak Pernah Bermain Di server ini");
                        return true;
                    }
                    if(!$this->plugin->data->exists(strtolower($args[0]))){
                        $sender->sendMessage($args[0]."§4» §3Hanya Bermain §2Kurang Dari 1 menit");
                        $sender->sendMessage("§4» §3Rank Saat Ini: ".$this->plugin->default);
                        return true;
                    }
                    $sender->sendMessage($args[0]."§4» §3Sudah Bermain ".$this->plugin->data->get(strtolower($args[0]))." §2menit di server ");
                    $sender->sendMessage("§4» §3Rank Saat ini: ".$this->plugin->getRank(strtolower($args[0])));
                    return true;
                }
                if(!$this->plugin->data->exists(strtolower($sender->getName()))){
                    if(!($sender instanceof Player)){
                        $sender->sendMessage("§4» §3Silahkan Gunakan /timeranks time §e(namaplayers)");
                        return true;
                    }
                    $sender->sendMessage("§4» §3Kamu Hanya Bermain §2Kurang Dari 1 menit");
                    $sender->sendMessage("§4» §3Rank Saat Ini: ".$this->plugin->default);
                    return true;
                }
                $sender->sendMessage("§4» §3Kamu Sudah Bermain ".$this->plugin->data->get(strtolower($sender->getName()))." §2Menit di server");
                $sender->sendMessage("§4» §3Rank Saat ini: ".$this->plugin->getRank(strtolower($sender->getName())));
                return true;
            break;
            default:
                return false;
        }
    }

}
