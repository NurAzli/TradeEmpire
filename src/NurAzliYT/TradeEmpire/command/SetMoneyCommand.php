<?php

namespace NurAzliYT\TradeEmpire\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use NurAzliYT\TradeEmpire\TradeEmpire;

class SetMoneyCommand extends Command implements PluginOwned
{
    use PluginOwnedTrait;

    private TradeEmpire $plugin;

    public function __construct(TradeEmpire $plugin)
    {
        parent::__construct("setmoney", "Set a player's balance", "/setmoney <player> <amount>", []);
        $this->setPermission("tradeempire.command.setmoney");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) < 2) {
            $sender->sendMessage("Usage: /setmoney <player> <amount>");
            return false;
        }

        $playerName = array_shift($args);
        $amount = array_shift($args);

        $player = $this->plugin->getServer()->getPlayerByPrefix($playerName);

        if ($player instanceof Player) {
            $this->plugin->getEconomyManager()->setMoney($player, (float)$amount);
            $sender->sendMessage("Set " . $player->getName() . "'s balance to $amount.");
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
