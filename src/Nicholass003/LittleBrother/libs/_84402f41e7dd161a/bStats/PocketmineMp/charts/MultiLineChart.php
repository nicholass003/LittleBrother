<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_84402f41e7dd161a\bStats\PocketmineMp\charts;

use Closure;

class MultiLineChart extends CustomChart
{
    /** @var Closure(): array<string, int> */
    private Closure $callable;

    /**
     * @param Closure(): array<string, int> $callable
     */
    public function __construct(string $chartId, Closure $callable)
    {
        parent::__construct($chartId);
        $this->callable = $callable;
    }

    protected function getChartData(): ?array
    {
        $map = ($this->callable)();
        if (count($map) === 0) {
            return null;
        }
        $allSkipped = true;
        $values = [];
        foreach ($map as $key => $value) {
            if ($value === 0) {
                continue;
            }
            $allSkipped = false;
            $values[$key] = $value;
        }
        if ($allSkipped) {
            return null;
        }
        return ["values" => $values];
    }
}