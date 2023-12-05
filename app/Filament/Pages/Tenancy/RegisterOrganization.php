<?php
namespace App\Filament\Pages\Tenancy;
 
use App\Models\Organization;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Database\Eloquent\Model;
 
class RegisterOrganization extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Organization';
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }
    
    protected function handleRegistration(array $data): Organization
    {
        $organization = Organization::create($data);
        
        $organization->users()->attach(auth()->user());
        
        return $organization;
    }
}