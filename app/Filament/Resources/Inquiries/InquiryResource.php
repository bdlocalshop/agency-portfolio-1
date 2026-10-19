<?php

namespace App\Filament\Resources\Inquiries;

use App\Filament\Resources\Inquiries\Pages\CreateInquiry;
use App\Filament\Resources\Inquiries\Pages\EditInquiry;
use App\Filament\Resources\Inquiries\Pages\ListInquiries;
use App\Models\Inquiry;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

use UnitEnum;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static string|UnitEnum|null $navigationGroup = 'Communications';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Inquiry::where('status', Inquiry::STATUS_NEW)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lead Submission Details')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('name')
                                    ->disabled(),
                                TextInput::make('email')
                                    ->email()
                                    ->disabled(),
                                TextInput::make('service_type')
                                    ->label('Interested Service')
                                    ->disabled(),
                                TextInput::make('budget_range')
                                    ->label('Estimated Budget')
                                    ->disabled(),
                                Select::make('status')
                                    ->label('Lead Status')
                                    ->options([
                                        'new' => 'New Lead',
                                        'contacted' => 'Contacted / In Discussion',
                                        'archived' => 'Archived / Closed',
                                    ])
                                    ->required(),
                                TextInput::make('created_at')
                                    ->label('Submitted At')
                                    ->disabled(),
                            ]),
                        Textarea::make('message')
                            ->label('Project Requirements / Scope Message')
                            ->rows(6)
                            ->columnSpanFull()
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('service_type')
                    ->label('Service')
                    ->badge(),
                TextColumn::make('budget_range')
                    ->label('Budget')
                    ->color('gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'contacted' => 'info',
                        'archived', 'closed' => 'gray',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'archived' => 'Archived',
                        'closed' => 'Closed',
                        default => ucfirst($state),
                    }),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'archived' => 'Archived',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Review & Update Status'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInquiries::route('/'),
            'edit' => EditInquiry::route('/{record}/edit'),
        ];
    }
}
