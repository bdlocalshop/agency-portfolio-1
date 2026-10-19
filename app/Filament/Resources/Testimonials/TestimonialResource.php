<?php

namespace App\Filament\Resources\Testimonials;

use App\Filament\Resources\Testimonials\Pages\CreateTestimonial;
use App\Filament\Resources\Testimonials\Pages\EditTestimonial;
use App\Filament\Resources\Testimonials\Pages\ListTestimonials;
use App\Models\Testimonial;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use UnitEnum;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;

    protected static string|UnitEnum|null $navigationGroup = 'Proof & Trust';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Feedback Details')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('client_name')
                                    ->label('Client / Executive Name')
                                    ->required()
                                    ->maxLength(150),
                                TextInput::make('role_company')
                                    ->label('Role & Company')
                                    ->placeholder('e.g. CTO at ApexLogistics')
                                    ->required()
                                    ->maxLength(200),
                            ]),
                        Grid::make(3)
                            ->components([
                                Select::make('rating')
                                    ->label('Star Rating')
                                    ->options([
                                        5 => '5 Stars ★★★★★',
                                        4 => '4 Stars ★★★★☆',
                                        3 => '3 Stars ★★★☆☆',
                                    ])
                                    ->default(5)
                                    ->required(),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('Active on Landing Page')
                                    ->default(true),
                            ]),
                        FileUpload::make('avatar_url')
                            ->label('Client Avatar / Photo')
                            ->disk('public')
                            ->directory('testimonials')
                            ->image()
                            ->avatar()
                            ->columnSpanFull(),
                        Textarea::make('quote')
                            ->label('Outcome-Driven Testimonial / Review')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Photo')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('role_company')
                    ->label('Role & Company')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn ($state) => str_repeat('★', (int) $state)),
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
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }
}
