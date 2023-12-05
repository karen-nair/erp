<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('location')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('organization_id')
                ->relationship('organization', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                     Forms\Components\TextInput::make('email')
                        ->required()
                        ->label('Email address')
                        ->email()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                        ->required()
                        ->label('Phone number')
                        ->tel()
                        ->maxLength(255)

                ])
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
               Tables\Columns\TextColumn::make('location')->searchable()
            ])
            ->filters([
              Tables\Filters\SelectFilter::make('location')
                ->options([
                    'perak' => 'Perak',
                    'kl' => 'Kuala Lumpur',
                    'jb' => 'Johor',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
