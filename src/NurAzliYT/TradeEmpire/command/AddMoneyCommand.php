<?php

namespace NurAzliYT\TradeEmpire\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use NurAzliYT\TradeEmpire\TradeEmpire;

class AddMoneyCommand extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private TradeEmpire $plugin;

    public function __construct(TradeEmpire $plugin)
    {
        parent::__construct("addmoney", "Add money to a player's balance", "/addmoney <player> <amount>", []);
        $this->setPermission("tradeempire.command.addmoney");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) < 2) {
            $sender->sendMessage("Usage: /addmoney <player> <amount>");
            return false;
        }

        $playerName = array_shift($args);
        $amount = array_shift($args);

        $player = $this->plugin->getServer()->getPlayerByPrefix($playerName);

        if ($player instanceof Player) {
            $this->plugin->getEconomyManager()->addMoney($player, (float)$amount);
            $sender->sendMessage("Added $amount to " . $player->getName() . "'s balance.");
            return true;
        } else {
            $sender->sendMessage("Player not found.");
            return false;
        }
    }

    public function getOwningPlugin(): TradeEmpire
    {
        return $this->plugin;
    }
}
