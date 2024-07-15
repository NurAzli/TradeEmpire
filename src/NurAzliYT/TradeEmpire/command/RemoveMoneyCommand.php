<?php

namespace NurAzliYT\TradeEmpire\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use NurAzliYT\TradeEmpire\Main;

class RemoveMoneyCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("removemoney", "Remove money from a player's balance", "/removemoney <player> <amount>", []);
        $this->setPermission("tradeempire.command.removemoney");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) < 2) {
            $sender->sendMessage("Usage: /removemoney <player> <amount>");
            return false;
        }

        $playerName = $args[0];
        $amount = intval($args[1]);

        $this->plugin->getEconomyManager()->removeBalance($playerName, $amount);
        $sender->sendMessage("Removed $" . $amount . " from $playerName's balance");
        return true;
    }
}
