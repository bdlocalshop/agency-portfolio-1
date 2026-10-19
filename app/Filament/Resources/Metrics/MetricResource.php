<?php

namespace App\Filament\Resources\Metrics;

use App\Filament\Resources\Metrics\Pages\CreateMetric;
use App\Filament\Resources\Metrics\Pages\EditMetric;
use App\Filament\Resources\Metrics\Pages\ListMetrics;
use App\Models\Metric;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use UnitEnum;

class MetricResource extends Resource
{
    protected static ?string $model = Metric::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static string|UnitEnum|null $navigationGroup = 'Proof & Trust';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Metric Counter Details')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('value')
                                    ->label('Metric / Counter Value')
                                    ->placeholder('e.g. 100%, 15+, Zero, 24/7')
                                    ->required()
                                    ->maxLength(50),
                                TextInput::make('label')
                                    ->label('Metric Label / Title')
                                    ->placeholder('e.g. On-Time Handover')
                                    ->required()
                                    ->maxLength(150),
                            ]),
                        TextInput::make('description')
                            ->label('Subtitle / Supporting Guarantee')
                            ->placeholder('e.g. Fixed-timeline milestones strictly honored')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->components([
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('Active on Landing Page')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('value')
                    ->label('Metric')
                    ->weight('bold')
                    ->badge(),
                TextColumn::make('label')
                    ->label('Label')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                TextColumn::make('description')
                    ->label('Subtitle')
                    ->color('gray'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->recordActions([
                EditAction::make(),
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
            'index' => ListMetrics::route('/'),
            'create' => CreateMetric::route('/create'),
            'edit' => EditMetric::route('/{record}/edit'),
        ];
    }
}
