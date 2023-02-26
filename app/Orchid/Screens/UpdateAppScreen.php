<?php

namespace App\Orchid\Screens;

use App\Models\App;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class UpdateAppScreen extends Screen
{

    protected App $app;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(App $app): iterable
    {
        $this->app = $app;
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Update ' . $this->app->name;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([
                Input::make('app.name')
                    ->title('App Name')
                    ->value($this->app->name)
                    ->help('The application name')
                    ->required(),
                Input::make('app.shortdesc')
                    ->title('App Short description')
                    ->max(255)
                    ->help('The featured description of the appilcation (max 255 characters)'),
                Select::make('app.isapp')
                    ->options([
                        'app' => 'App',
                        'game' => 'Game',
                    ])
                    ->title('Application Type')
                    ->help('select either an app or game')
                    ->value($this->app->is_app ? 'app' : 'game')
                    ->required()
                    ->disabled(),
                Quill::make('app.description')
                    ->title('Application Description')
                    ->popover('Make sure to write an SEO optimal content to reach a wide audience.')
                    ->value($this->app->description),
            ])->title('Basic Info'),
            Layout::block([
                Layout::rows([
                    Input::make('app.publisher')
                        ->title('Publisher Name')
                        ->value($this->app->publisher)
                        ->help('The publisher name'),
                    Input::make('app.publisher_url')
                        ->title('Publisher URL')
                        ->value($this->app->publisher_url)
                        ->help('The publisher URL'),
                ])
            ])
                ->title('Publisher info')
                ->description('These info are not required but recommended'),
            Layout::block([
                Layout::rows([
                    Upload::make('app.icon')
                        ->title('Application Icon')
                        ->help('The icon to be displayed in app details page and listings')
                        ->type('file')
                        ->maxFiles(1)
                        ->value($this->app->attachment()->get())
                        ->required(),
                    Upload::make('app.screeshots')
                        ->title('Application Screenshots')
                        ->help('The screenshots to be displayed in app details page')
                        ->type('file')
                        ->media(),
                ])
            ])
                ->title('Media (images)')
                ->description('Application display medias'),
            Layout::block([
                Layout::rows([
                    Input::make('app.package_name')
                        ->title('Package Name')
                        ->value($this->app->package_name)
                        ->help('The package name of the app (ex: com.example.foo)'),
                    Input::make('app.version')
                        ->title('Version Name')
                        ->value($this->app->version)
                        ->help('the version name of the app (ex: 10.6.2)'),
                    Select::make('app.category')
                        ->title('Not Applicable for now')
                        ->disabled(),
                ])
            ])
                ->title('Application Properties')
                ->description('Application info'),


        ];
    }
}
