<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\CreateSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSiteSettings;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use UnitEnum;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Configuration';

    protected static ?string $navigationLabel = 'Site & Brand Settings';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return SiteSetting::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Brand & Identity Assets')
                    ->description('Logos, agency titles, and browser favicons.')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('agency_name')
                                    ->label('Agency Legal / Brand Name')
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('tagline')
                                    ->label('Tagline / Sub-brand')
                                    ->maxLength(150),
                            ]),
                        Grid::make(2)
                            ->components([
                                FileUpload::make('site_logo')
                                    ->label('Header Site Logo (SVG, PNG, WebP)')
                                    ->disk('public')
                                    ->directory('branding')
                                    ->image(),
                                FileUpload::make('favicon')
                                    ->label('Browser Favicon')
                                    ->disk('public')
                                    ->directory('branding')
                                    ->image(),
                            ]),
                    ]),

                Section::make('Hero Banner Copy & Actions')
                    ->description('Main headline, positioning statement, and CTA triggers.')
                    ->components([
                        TextInput::make('hero_badge')
                            ->label('Floating Pill Tagline')
                            ->maxLength(100),
                        TextInput::make('hero_headline')
                            ->label('Primary Hero Headline')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('hero_subheadline')
                            ->label('Hero Supporting Narrative')
                            ->rows(3)
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->components([
                                TextInput::make('primary_cta_text')
                                    ->label('Primary CTA Text')
                                    ->required(),
                                TextInput::make('primary_cta_url')
                                    ->label('Primary CTA Target (e.g. #contact)')
                                    ->required(),
                                TextInput::make('secondary_cta_text')
                                    ->label('Secondary CTA Text')
                                    ->required(),
                                TextInput::make('secondary_cta_url')
                                    ->label('Secondary CTA Target (e.g. #portfolio)')
                                    ->required(),
                            ]),
                    ]),

                Section::make('Official Contact & Social Profiles')
                    ->description('Contact channels shown in the footer and direct partnership cards.')
                    ->components([
                        Grid::make(3)
                            ->components([
                                TextInput::make('contact_email')
                                    ->label('Inquiry Email')
                                    ->email()
                                    ->required(),
                                TextInput::make('contact_phone')
                                    ->label('Phone / WhatsApp')
                                    ->tel(),
                                TextInput::make('contact_location')
                                    ->label('Office Location / Timezone'),
                            ]),
                        Grid::make(3)
                            ->components([
                                TextInput::make('github_url')
                                    ->label('GitHub URL')
                                    ->url(),
                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn URL')
                                    ->url(),
                                TextInput::make('x_url')
                                    ->label('X (Twitter) URL')
                                    ->url(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('site_logo')
                    ->label('Logo')
                    ->disk('public'),
                TextColumn::make('agency_name')
                    ->label('Agency')
                    ->weight('bold'),
                TextColumn::make('hero_headline')
                    ->label('Hero Headline')
                    ->limit(45),
                TextColumn::make('contact_email')
                    ->label('Email'),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M d, Y H:i'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit Settings'),
            ])
            ->toolbarActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteSettings::route('/'),
            'create' => CreateSiteSetting::route('/create'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
