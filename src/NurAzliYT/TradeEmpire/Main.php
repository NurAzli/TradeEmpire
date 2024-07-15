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
        $this->registerCommands();
    }

    private function registerCommands(): void {
        $setMoneyCommand = new SetMoneyCommand($this);
        $this->getServer()->getCommandMap()->register("tradeempire", $setMoneyCommand);
        
        $balanceCommand = new BalanceCommand($this);
        $this->getServer()->getCommandMap()->register("tradeempire", $balanceCommand);

        $addMoneyCommand = new AddMoneyCommand($this);
        $this->getServer()->getCommandMap()->register("tradeempire", $addMoneyCommand);

        $removeMoneyCommand = new RemoveMoneyCommand($this);
        $this->getServer()->getCommandMap()->register("tradeempire", $removeMoneyCommand);
    }

    public function getEconomyManager(): EconomyManager {
        return $this->economyManager;
    }
}
