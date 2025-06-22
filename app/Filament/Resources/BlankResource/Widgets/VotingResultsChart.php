<?php

namespace App\Filament\Widgets;

use App\Models\Candidate;
use Filament\Widgets\BarChartWidget;

class VotingBarChartWidget extends BarChartWidget
{
    protected static ?string $heading = 'Perolehan Suara Kandidat';
    protected static ?string $maxHeight = 'full';
    protected static ?string $polling = 'live';
    protected static ?string $pollingInterval = '10s';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $candidates = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        $totalVotes = $candidates->sum('votes_count');

        return [
            'labels' => $candidates->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Persentase Suara (%)',
                    'data' => $candidates->map(function ($candidate) use ($totalVotes) {
                        return $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100) : 0;
                    })->toArray(),
                    'backgroundColor' => '#3B82F6',
                    'borderColor' => '#2563EB',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
