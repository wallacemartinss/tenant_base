<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Filament\Pages\Auth\Register as AuthRegister;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class Register extends AuthRegister
{

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPhoneNumberFormComponent(),                    
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getPhoneNumberFormComponent(): Component
    {
        return PhoneNumber::make('phone')
                    ->label('Celular Pessoal')
                    ->required()
                    ->mask('(99) 99999-9999');
    }

    
}
