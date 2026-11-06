<?php

namespace App\Filament\Resources\PortfolioProjects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PortfolioProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Category')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query
                            ->where('is_active', true)
                            ->orderBy('sort_order')
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Textarea::make('description')
                    ->rows(4)
                    ->maxLength(3000)
                    ->columnSpanFull(),

                TextInput::make('client_name')
                    ->label('Client / Brand')
                    ->maxLength(255),

                Select::make('media_type')
                    ->label('Media Type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->live()
                    ->required()
                    ->afterStateUpdated(function (callable $set) {
                        $set('project_type', null);
                        $set('media_path', null);
                        $set('thumbnail_path', null);
                    }),

                Select::make('project_type')
                    ->label('Media Category')
                    ->options(fn(Get $get): array => match ($get('media_type')) {
                        'image' => [
                            'graphic-design' => 'Graphic Design',
                            'photography' => 'Photography',
                            'branding' => 'Branding',
                            'other' => 'Other',
                        ],
                        'video' => [
                            'reels' => 'Reels',
                            'ai-videos' => 'AI Videos',
                            'real-estate-videos' => 'Real Estate Videos',
                            'promotional-videos' => 'Promotional Videos',
                            'cinematography' => 'Cinematography',
                            'other' => 'Other',
                        ],
                        default => [],
                    })
                    ->live()
                    ->disabled(fn(Get $get): bool => blank($get('media_type')))
                    ->required(),

                FileUpload::make('media_path')
                    ->label('Upload Media')
                    ->disk('s3')
                    ->directory(
                        fn(Get $get): string =>
                        'portfolio/'
                            . ($get('media_type') ?: 'other')
                            . '/'
                            . Str::slug($get('project_type') ?: 'uncategorized')
                            . '/'
                            . Str::slug($get('slug') ?: 'untitled-project')
                    )
                    ->acceptedFileTypes(fn(Get $get): array => match ($get('media_type')) {
                        'image' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'image/avif',
                        ],
                        'video' => [
                            'video/mp4',
                            'video/webm',
                            'video/quicktime',
                        ],
                        default => [],
                    })
                    ->maxSize(102400)
                    ->required()
                    ->visible(
                        fn(Get $get): bool =>
                        filled($get('media_type'))
                            && filled($get('project_type'))
                    )
                    ->columnSpanFull()
                    ->helperText('Upload exactly one image or video. Maximum file size: 100 MB.'),


                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail Image')
                    ->disk('s3')
                    ->directory(
                        fn(Get $get): string =>
                        'portfolio/'
                            . ($get('media_type') ?: 'image')
                            . '/'
                            . Str::slug($get('project_type') ?: 'uncategorized')
                            . '/'
                            . Str::slug($get('slug') ?: 'untitled-project')
                    )
                    ->acceptedFileTypes([
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                        'image/avif',
                    ])
                    ->maxSize(10240)
                    ->image()
                    ->visible(fn(Get $get): bool => $get('media_type') === 'image')
                    ->columnSpanFull()
                    ->helperText('Optional. Upload a smaller image for the portfolio grid. The original image will open in the popup.'),

                TextInput::make('location')
                    ->maxLength(255),

                DatePicker::make('project_date')
                    ->label('Project Date')
                    ->native(false),

                Toggle::make('is_featured')
                    ->label('Featured Project')
                    ->default(false)
                    ->required(),

                Toggle::make('is_active')
                    ->label('Published')
                    ->default(true)
                    ->required(),

                TextInput::make('sort_order')
                    ->label('Display Order')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->default(0)
                    ->required(),
            ])
            ->columns(2);
    }
}
