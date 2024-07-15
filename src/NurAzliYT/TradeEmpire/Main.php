<?php

namespace NurAzliYT\TradeEmpire;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use NurAzliYT\TradeEmpire\command\BalanceCommand;
use NurAzliYT\TradeEmpire\command\SetMoneyCommand;
use NurAzliYT\TradeEmpire\command\AddMoneyCommand;
use NurAzliYT\TradeEmpire\command\RemoveMoneyCommand;
use NurAzliYT\TradeEmpire\util\EconomyManager;

class Main extends PluginBase {

    /** @var EconomyManager */
    private $economyManager;

    public function onEnable(): void {
        // Create balances file
        @mkdir($this->getDataFolder());
        $this->economyManager = new EconomyManager($this);

        // Register commands
        $this->getServer()->getCommandMap()->registerAll("TradeEmpire", [
            new BalanceCommand($this),
            new SetMoneyCommand($this),
            new AddMoneyCommand($this),
            new RemoveMoneyCommand($this)
        ]);
    }

    public function getEconomyManager(): EconomyManager {
        return $this->economyManager;
    }
}
