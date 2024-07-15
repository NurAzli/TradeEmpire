<?php

namespace NurAzliYT\TradeEmpire\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use NurAzliYT\TradeEmpire\TradeEmpire;

class BalanceCommand extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private TradeEmpire $plugin;

    public function __construct(TradeEmpire $plugin)
    {
        parent::__construct("balance", "Check your balance", "/balance", []);
        $this->setPermission("tradeempire.command.balance");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if ($sender instanceof Player) {
            $balance = $this->plugin->getEconomyManager()->getBalance($sender);
            $sender->sendMessage("Your balance is: $" . $balance);
            return true;
        } else {
            $sender->sendMessage("This command can only be used in-game.");
            return true;
        }
    }

    public function getOwningPlugin(): TradeEmpire
    {
        return $this->plugin;
    }
}
