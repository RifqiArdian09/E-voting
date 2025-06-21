<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Kandidat';
    protected static ?string $modelLabel = 'Kandidat';
    protected static ?string $pluralModelLabel = 'Daftar Kandidat';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nama Kandidat')
                ->maxLength(255),

            Forms\Components\Textarea::make('vision')
                ->required()
                ->label('Visi')
                ->columnSpanFull(),

            Forms\Components\Textarea::make('mission')
                ->required()
                ->label('Misi')
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('photo')
                ->label('Foto Profil')
                ->image()
                ->previewable(true) // agar muncul saat edit
                ->directory('candidates') // simpan di storage/app/public/candidates
                ->visibility('public')
                ->disk('public')
                ->imageEditor()
                ->openable()
                ->downloadable()
                ->preserveFilenames(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->visibility('public')
                    ->circular()
                    ->defaultImageUrl(url('/storage/default-profile.png')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('votes_count')
                    ->counts('votes')
                    ->label('Total Suara')
                    ->sortable()
                    ->numeric(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}
