<?php

namespace NurAzliYT\TradeEmpire\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use NurAzliYT\TradeEmpire\TradeEmpire;

class RemoveMoneyCommand extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private TradeEmpire $plugin;

    public function __construct(TradeEmpire $plugin)
    {
        parent::__construct("removemoney", "Remove money from a player's balance", "/removemoney <player> <amount>", []);
        $this->setPermission("tradeempire.command.removemoney");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) < 2) {
            $sender->sendMessage("Usage: /removemoney <player> <amount>");
            return false;
        }

        $playerName = array_shift($args);
        $amount = array_shift($args);

        $player = $this->plugin->getServer()->getPlayerByPrefix($playerName);

        if ($player instanceof Player) {
            $this->plugin->getEconomyManager()->removeMoney($player, (float)$amount);
            $sender->sendMessage("Removed $amount from " . $player->getName() . "'s balance.");
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
