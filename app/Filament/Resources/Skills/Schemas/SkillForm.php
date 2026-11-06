<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('icon_path')
                    ->label('Skill Icon')
                    ->image()
                    ->disk('s3')
                    ->directory('skills/icons')
                    ->acceptedFileTypes([
                        'image/png',
                        'image/svg+xml',
                        'image/webp',
                    ])
                    ->maxSize(2048)
                    ->imageEditor()
                    ->columnSpanFull()
                    ->helperText('Upload a transparent PNG, SVG or WebP skill icon.'),

                TextInput::make('sort_order')
                    ->label('Display Order')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->default(0)
                    ->required(),

                Toggle::make('is_active')
                    ->label('Published')
                    ->default(true)
                    ->required(),
            ])
            ->columns(2);
    }
}