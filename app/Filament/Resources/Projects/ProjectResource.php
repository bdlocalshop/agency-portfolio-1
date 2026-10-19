<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Models\Category;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

use UnitEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->components([
                        // Left / Main column (2 cols)
                        Grid::make(1)
                            ->columnSpan(2)
                            ->components([
                                Section::make('Project Overview')
                                    ->components([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                        TextInput::make('slug')
                                            ->required()
                                            ->unique(Project::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255),
                                        TextInput::make('client_name')
                                            ->label('Client / Organization')
                                            ->maxLength(150),
                                        Textarea::make('short_description')
                                            ->label('Executive Summary')
                                            ->required()
                                            ->rows(3)
                                            ->maxLength(500),
                                    ]),

                                Section::make('Detailed Case Study')
                                    ->components([
                                        RichEditor::make('problem')
                                            ->label('The Problem / Architectural Challenge')
                                            ->placeholder('Describe the legacy constraints, performance bottlenecks, or business challenge...')
                                            ->columnSpanFull(),
                                        RichEditor::make('solution')
                                            ->label('The Engineering Solution')
                                            ->placeholder('Detail the stack choices, optimization techniques, and business outcome...')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Project Gallery (Additional Images)')
                                    ->components([
                                        Repeater::make('images')
                                            ->relationship('images')
                                            ->schema([
                                                FileUpload::make('image_url')
                                                    ->label('Gallery Image')
                                                    ->disk('public')
                                                    ->directory('project-images')
                                                    ->image()
                                                    ->required(),
                                                TextInput::make('caption')
                                                    ->maxLength(255),
                                                TextInput::make('sort_order')
                                                    ->numeric()
                                                    ->default(0),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(0)
                                            ->reorderable('sort_order'),
                                    ]),
                            ]),

                        // Right sidebar column (1 col)
                        Grid::make(1)
                            ->columnSpan(1)
                            ->components([
                                Section::make('Classification & Media')
                                    ->components([
                                        Select::make('category_id')
                                            ->label('Category')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required(),
                                        FileUpload::make('thumbnail_url')
                                            ->label('Primary Thumbnail')
                                            ->disk('public')
                                            ->directory('projects')
                                            ->image()
                                            ->required(),
                                        TagsInput::make('tech_stack')
                                            ->label('Tech Stack Tags')
                                            ->placeholder('Laravel, Vue.js, MySQL...')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Deployment & Links')
                                    ->components([
                                        TextInput::make('external_url')
                                            ->label('Live Demo / URL')
                                            ->url()
                                            ->maxLength(255),
                                        TextInput::make('github_url')
                                            ->label('GitHub Repository')
                                            ->url()
                                            ->maxLength(255),
                                        Grid::make(2)
                                            ->components([
                                                Toggle::make('is_featured')
                                                    ->label('Featured')
                                                    ->default(false),
                                                TextInput::make('sort_order')
                                                    ->numeric()
                                                    ->default(0),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail_url')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Project $record) => Str::limit($record->short_description, 60)),
                TextColumn::make('category.name')
                    ->badge()
                    ->sortable(),
                TextColumn::make('client_name')
                    ->label('Client')
                    ->toggleable(),
                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ])
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
