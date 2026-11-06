<?php

namespace App\Filament\Resources\PortfolioProjects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PortfolioProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->sortable(),

                TextColumn::make('project_type')
                    ->label('Project Type')
                    ->badge()
                    ->searchable(),

                TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('project_date')
                    ->label('Project Date')
                    ->date()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Category'),

                SelectFilter::make('project_type')
                    ->options([
                        'Graphic Design' => 'Graphic Design',
                        'Photography' => 'Photography',
                        'Videography' => 'Videography',
                        'Video Editing' => 'Video Editing',
                        'AI Video Creation' => 'AI Video Creation',
                        'Real Estate Marketing' => 'Real Estate Marketing',
                        'Other' => 'Other',
                    ]),

                TernaryFilter::make('is_featured')
                    ->label('Featured'),

                TernaryFilter::make('is_active')
                    ->label('Published'),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ]);
    }
}
