<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoteResource\Pages;
use App\Models\Vote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VoteResource extends Resource
{
    protected static ?string $model = Vote::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationLabel = 'Suara';
    protected static ?string $modelLabel = 'Data Suara';
    protected static ?string $pluralModelLabel = 'Daftar Suara';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('voter_id')
                ->relationship('voter', 'name')
                ->label('Pemilih')
                ->required(),
                
            Forms\Components\Select::make('candidate_id')
                ->relationship('candidate', 'name')
                ->label('Kandidat')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('voter.name')
                    ->label('Nama Pemilih')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('candidate.name')
                    ->label('Kandidat Dipilih')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Memilih')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVotes::route('/'),
            'create' => Pages\CreateVote::route('/create'),
            'edit' => Pages\EditVote::route('/{record}/edit'),
        ];
    }
}