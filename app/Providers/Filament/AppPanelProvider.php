<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Models\Organization;
use Filament\Pages\Dashboard;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\FilamentSettings;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use App\Filament\Pages\Tenancy\RegisterOrganization;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
        ->default()
        ->id('app')
        ->path('app')
        ->login()
        ->sidebarFullyCollapsibleOnDesktop()
        ->registration()
        ->databaseNotifications()
        ->profile()
        ->userMenuItems([
            'profile' => MenuItem::make()
                ->label( fn() =>Auth::user()->name)
                ->url(fn (): string => EditProfilePage::getUrl())
                ->icon('heroicon-m-user-circle')
                //If you are using tenancy need to check with the visible method where ->company() is the relation between the user and tenancy model as you called
                ->visible(function (): bool {
                    return Auth::user()->organization()->exists();
                })
        ])
        ->userMenuItems([
            MenuItem::make()
                ->label('Admin')
                ->icon('heroicon-o-cog-6-tooth')
                ->url('/admin')
                ->visible(fn (): bool => Auth::user()->is_admin)
        ])
        ->colors([
            'danger' => Color::Red,
            'gray' => Color::Slate,
            'info' => Color::Blue,
            'success' => Color::Emerald,
            'warning' => Color::Orange,
            'primary' => Color::Amber,
        ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
               
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                FilamentSettings::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            ->tenant(Organization::class, ownershipRelationship: 'organization', slugAttribute: 'slug')
            ->tenantRegistration(RegisterOrganization::class)
            //->tenantProfile(EditOrganizationProfile::class)
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->slug('my-profile')
                    ->setTitle('Meu Perfil')
                    ->setNavigationLabel('Meu Perfil')
                    ->setNavigationGroup('Group Profile')
                    ->setIcon('heroicon-o-user')
                    ->setSort(10)
                    ->shouldRegisterNavigation(false)
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowBrowserSessionsForm()
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'avatars', // image will be stored in 'storage/app/public/avatars
                    ) 
                    ->customProfileComponents([
                        \App\Livewire\ColorProfileComponent::class,
                    ])
            ]);
    }
}
