<?php

namespace App\Filament\Imports;

use App\Models\Voter;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class VoterImporter extends Importer
{
    protected static ?string $model = Voter::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nisn')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('class')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('major')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('token')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('has_voted')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
        ];
    }

    public function resolveRecord(): ?Voter
    {
        // return Voter::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Voter();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your voter import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
