<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoterResource\Pages;
use App\Models\Voter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VoterResource extends Resource
{
    protected static ?string $model = Voter::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Pemilih';
    protected static ?string $modelLabel = 'Data Pemilih';
    protected static ?string $pluralModelLabel = 'Daftar Pemilih';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nisn')
                ->label('NISN')
                ->required()
                ->maxLength(20)
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('class')
                ->label('Kelas')
                ->required(),

            Forms\Components\TextInput::make('major')
                ->label('Jurusan')
                ->required(),

                Forms\Components\TextInput::make('token')
                ->label('Token Voting')
                ->disabled()
                ->dehydrated(),            

            Forms\Components\Toggle::make('has_voted')
                ->label('Sudah Memilih')
                ->onColor('success')
                ->offColor('danger'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nisn')
                    ->label('NISN')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('class')
                    ->label('Kelas')
                    ->sortable(),

                Tables\Columns\TextColumn::make('major')
                    ->label('Jurusan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('token')
                    ->label('Token')
                    ->searchable(),

                Tables\Columns\IconColumn::make('has_voted')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
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
            'index' => Pages\ListVoters::route('/'),
            'create' => Pages\CreateVoter::route('/create'),
            'edit' => Pages\EditVoter::route('/{record}/edit'),
        ];
    }
}
