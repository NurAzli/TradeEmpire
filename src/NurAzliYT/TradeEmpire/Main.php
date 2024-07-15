<?php

/**
 * MIT License
 *
 * Copyright (c) 2021-2024 NurAzliYT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @auto-license
 */

declare(strict_types=1);

namespace NurAzliYT\TradeEmpire;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use NurAzliYT\TradeEmpire\command\AddMoneyCommand;
use NurAzliYT\TradeEmpire\command\BalanceCommand;
use NurAzliYT\TradeEmpire\command\RemoveMoneyCommand;
use NurAzliYT\TradeEmpire\command\SetMoneyCommand;
use NurAzliYT\TradeEmpire\util\EconomyManager;

final class Main extends PluginBase
{
    private EconomyManager $economyManager;

    protected function onLoad(): void
    {
        $this->saveDefaultConfig();
    }

    protected function onEnable(): void
    {
        @mkdir($this->getDataFolder());
        $this->economyManager = new EconomyManager($this);

        $this->registerCommands();
    }

    private function registerCommands(): void
    {
        $this->getServer()->getCommandMap()->registerAll("tradeempire", [
            new BalanceCommand($this),
            new SetMoneyCommand($this),
            new AddMoneyCommand($this),
            new RemoveMoneyCommand($this)
        ]);
    }

    public function getEconomyManager(): EconomyManager
    {
        return $this->economyManager;
    }
}
