<?php

namespace NurAzliYT\TradeEmpire\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use pocketmine\Server;
use NurAzliYT\TradeEmpire\Main;

class SetMoneyCommand extends Command implements PluginOwned {
    use PluginOwnedTrait;

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("setmoney", "Set a player's balance", "/setmoney <player> <amount>", []);
        $this->setPermission("tradeempire.command.setmoney");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) < 2) {
            $sender->sendMessage("Usage: /setmoney <player> <amount>");
            return false;
        }

        $playerName = $args[0];
        $amount = intval($args[1]);

        $this->plugin->getEconomyManager()->setBalance($playerName, $amount);
        $sender->sendMessage("Set $playerName's balance to $" . $amount);
        return true;
    }

    public function getOwningPlugin(): Main {
        return $this->plugin;
    }
}
