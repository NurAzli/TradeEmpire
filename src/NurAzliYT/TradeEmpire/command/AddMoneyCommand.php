<?php

namespace NurAzliYT\TradeEmpire\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use NurAzliYT\TradeEmpire\Main;

class AddMoneyCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("addmoney", "Add money to a player's balance", "/addmoney <player> <amount>", []);
        $this->setPermission("tradeempire.command.addmoney");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) < 2) {
            $sender->sendMessage("Usage: /addmoney <player> <amount>");
            return false;
        }

        $playerName = $args[0];
        $amount = intval($args[1]);

        $this->plugin->getEconomyManager()->addBalance($playerName, $amount);
        $sender->sendMessage("Added $" . $amount . " to $playerName's balance");
        return true;
    }
}
