<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerComponent('borrow-book');
        $this->registerComponent('return-book');
        $this->registerComponent('add-book');
        $this->registerComponent('manage-book');
        $this->registerComponent('add-student');
        $this->registerComponent('manage-student');
        $this->registerComponent('view-dog');
        $this->registerComponent('welcome-page');
        $this->registerComponent('view-logs');
        $this->registerComponent('book-logs');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }

    protected function registerComponent(string $component) {
        \Illuminate\Support\Facades\Blade::component('jetstream::components.'.$component, 'jet-'.$component);
    }
}
