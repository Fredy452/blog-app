<?php

namespace App\Filament\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Post;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total', Post::all()->count())
                ->description('1+ hoy')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),
            Card::make('Publicados', Post::where('is_published', true)->count()),
            Card::make('No publicados', Post::where('is_published', false)->count())
                ->description(Post::whereNotNull('deleted_at')->get(),' en espera')
                ->color('danger')
                ->descriptionIcon('heroicon-s-trending-down'),
        ];
    }
}
