<?php

namespace App\Providers;

use App\Nova\Child;
use App\Nova\ClassLevel;
use App\Nova\Dashboards\Main;
use App\Nova\Event;
use App\Nova\Filters\OrganizerUserFilter;
use App\Nova\Reservation;
use App\Nova\ReservationType;
use App\Nova\School;
use App\Nova\SchoolType;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use Vyuldashev\NovaPermission\Permission;
use Vyuldashev\NovaPermission\Role;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        Nova::mainMenu(function () {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make('Organizers', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Child::class),
                    MenuItem::resource(Event::class)
                ])->icon('users')->collapsable()->canSee(function (NovaRequest $request) {
                    return $request->user()->hasRole('organizer');
                }),

                MenuSection::make('Resources', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Child::class),
                    MenuItem::resource(Event::class),
                    MenuItem::resource(Reservation::class),
                    MenuItem::resource(ReservationType::class),
                    MenuItem::resource(ClassLevel::class),
                    MenuItem::resource(SchoolType::class),
                    MenuItem::resource(School::class),
                    MenuItem::resource(Role::class),
                    MenuItem::resource(Permission::class),
                ])->icon('document-text')->collapsable()->canSee(function (NovaRequest $request) {
                    return $request->user()->hasRole('admin');
                }),
            ];
        });

        Nova::userMenu(function (Request $request, Menu $menu) {
            $menu->append(MenuItem::make('Website', '/'));

            return $menu;
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function ($user) {
            return $user->hasRole('admin');
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards(): array
    {
        return [
            new Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            NovaPermissionTool::make(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
