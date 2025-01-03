<?php

namespace App\Filament\Resources\OrganizationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class UserRelationManager extends RelationManager
{
    protected static string $relationship = 'users';
    protected static ?string $modelLabel = 'Usuário';
    protected static ?string $modelLabelPlural = "Usuários";
    protected static ?string $title = 'Usuários do Tenant';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('name')
                ->label('Nome Usuário')
                ->required()
                ->maxLength(255),
                
            TextInput::make('email')
                ->label('E-mail')
                ->email()
                ->required()
                ->maxLength(255),

            Toggle::make('is_admin')
                ->label('Administrador')
                ->required(),
         
            TextInput::make('password')
                ->label('Senha')
                ->password()
                ->required()
                ->maxLength(255),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user')

            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->alignCenter(),

                TextColumn::make('name')
                    ->label('Nome'),

                TextColumn::make('email')
                    ->label('E-mail'),

                TextColumn::make('email_verified_at')
                    ->label('Ativado em')
                    ->dateTime('d/m/Y HH:mm:ss')
                    ->sortable(),

                ToggleColumn::make('is_admin')
                    ->alignCenter()
                    ->label('Administrador'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
