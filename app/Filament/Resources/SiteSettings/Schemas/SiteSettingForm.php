<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('hero_image')
                    ->label('Homepage Hero Image')
                    ->image()
                    ->disk('s3')
                    ->directory('site-settings')
                    ->visibility('private')
                    ->imageEditor()
                    ->required(),
            ]);
    }
}