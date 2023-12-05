<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Branch;

class BranchTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Perak', Branch::query()->where('location', 'perak')->count()),
            Stat::make('Kuala Lumpur', Branch::query()->where('location', 'kl')->count()),
            Stat::make('Johor', Branch::query()->where('location', 'jb')->count()),
        ];
    }
}
