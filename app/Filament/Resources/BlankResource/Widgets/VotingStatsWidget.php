<?php

namespace App\Filament\Widgets;

use App\Models\Candidate;
use App\Models\Voter;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VotingStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalVotes = $this->getTotalVotes();
        $leadingCandidate = $this->getLeadingCandidate();
        $participationRate = $this->getParticipationRate();

        return [
            Stat::make('Total Suara', number_format($totalVotes))
                ->description('Jumlah suara masuk')
                ->icon('heroicon-o-chart-bar')
                ->color('primary')
                ->chart($this->getVoteTrends())
                ->extraAttributes(['class' => 'border-l-4 border-blue-500']),

            Stat::make('Pemimpin Sementara', $leadingCandidate['name'])
                ->description($leadingCandidate['votes'].' suara ('.$leadingCandidate['percentage'].'%)')
                ->icon('heroicon-o-star')
                ->color('success')
                ->extraAttributes(['class' => 'border-l-4 border-green-500']),

            Stat::make('Tingkat Partisipasi', $participationRate.'%')
                ->description('Dari total pemilih terdaftar')
                ->icon('heroicon-o-users')
                ->color('purple')
                ->extraAttributes(['class' => 'border-l-4 border-purple-500']),
        ];
    }

    protected function getTotalVotes(): int
    {
        return Candidate::withCount('votes')->get()->sum('votes_count');
    }

    protected function getLeadingCandidate(): array
    {
        $candidate = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->first();

        $totalVotes = $this->getTotalVotes();
        $percentage = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100) : 0;

        return [
            'name' => $candidate->name,
            'votes' => $candidate->votes_count,
            'percentage' => $percentage
        ];
    }

    protected function getParticipationRate(): int
    {
        $totalVoters = Voter::count();
        $voted = Voter::where('has_voted', true)->count();

        return $totalVoters > 0 ? round(($voted / $totalVoters) * 100) : 0;
    }

    protected function getVoteTrends(): array
    {
        // Implement your logic to get voting trends over time
        return [7, 2, 10, 3, 15, 4, 17];
    }
}