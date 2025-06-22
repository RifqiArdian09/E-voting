<?php

namespace App\Filament\Widgets;

use App\Models\Candidate;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class CandidatesTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Candidate::query()->withCount('votes'))
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->width(60)
                    ->height(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kandidat')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('votes_count')
                    ->label('Total Suara')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('percentage')
                    ->label('Persentase (%)')
                    ->numeric(decimalPlaces: 1)
                    ->getStateUsing(function (Candidate $record) {
                        $totalVotes = Candidate::withCount('votes')->get()->sum('votes_count');
                        return $totalVotes > 0 ? ($record->votes_count / $totalVotes) * 100 : 0;
                    }),

                Tables\Columns\TextColumn::make('progress_bar')
                    ->label('Progress')
                    ->html()
                    ->getStateUsing(function (Candidate $record) {
                        $totalVotes = Candidate::withCount('votes')->get()->sum('votes_count');
                        $percentage = $totalVotes > 0 ? ($record->votes_count / $totalVotes) * 100 : 0;
                        $percentage = round($percentage, 1);
                        return '
                            <div style="width:100%; background-color:#e5e7eb; border-radius:6px; height:14px;">
                                <div style="
                                    width:' . $percentage . '%;
                                    background-color:#3b82f6;
                                    height:100%;
                                    border-radius:6px;
                                    text-align:center;
                                    font-size:10px;
                                    color:white;
                                ">
                                    ' . $percentage . '%
                                </div>
                            </div>
                        ';
                    }),
            ])
            ->defaultSort('votes_count', 'desc');
    }
}
