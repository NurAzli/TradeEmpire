<?php

namespace NurAzliYT\TradeEmpire\util;

use pocketmine\utils\Config;
use pocketmine\player\Player;

class EconomyManager {

    /** @var Config */
    private $balances;

    public function __construct($plugin) {
        $this->balances = new Config($plugin->getDataFolder() . "balances.yml", Config::YAML, []);
    }

    public function getBalance(Player $player): int {
        $name = $player->getName();
        return $this->balances->get($name, 0);
    }

    public function setMoney(string $playerName, int $amount): void {
        $this->balances->set($playerName, $amount);
        $this->balances->save();
    }

    public function addMoney(string $playerName, int $amount): void {
        $currentBalance = $this->balances->get($playerName, 0);
        $this->balances->set($playerName, $currentBalance + $amount);
        $this->balances->save();
    }

    public function removeMoney(string $playerName, int $amount): void {
        $currentBalance = $this->balances->get($playerName, 0);
        $this->balances->set($playerName, max(0, $currentBalance - $amount));
        $this->balances->save();
    }
}
