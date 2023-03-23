<?php

namespace App\Orchid\Screens;

use App\Models\App;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UpdateAppScreen extends Screen
{

    protected App $app;
    public $categories_names;
    public bool $is_app_featured;
    public bool $is_app_in_top_picks;

    public function update(Request $request, App $app)
    {
        $input = $request->input('app');

        $app->fill($input);

        if (isset($input['icon'])) {
            $attach = Attachment::find($input['icon'][0]);
            $icon_path = $attach->path . $attach->name . '.' . $attach->extension;
            $app->icon = $input['icon'][0];
            $app->icon_path = $icon_path;
        } else
            $app->icon = 'static/dummy_icon.png';
        
        if (isset($input['cover'])) {
            $attach = Attachment::find($input['cover'])->first();
            $cover_path = $attach->path . $attach->name . '.' . $attach->extension;
            $app->cover = $input['cover'][0];
            $app->cover_path = $cover_path;
        }

        $app->update();

        if ($input['feature']) {
            if ($app->cover_path) {
                $this->featureApp($app->id);
            } else {
                Toast::error('please add a cover image before adding app to featured');
            }
        } else {
            // TODO : unfeature
        }

        if ($input['top']) {
            $this->addAppToPicks($app->id);
        } else {
            // un top
        }

        Toast::success('App saved successfully');
    }

    public function back(Request $request)
    {
        return redirect()->route('platform.app');
    }

    public function featureApp($id)
    {

        DB::table('featured_apps')
            ->where('app_id', $id)
            ->delete();

        $featured_arr = DB::select('SELECT * FROM featured_apps');

        if ((sizeof($featured_arr) >= 2)) {

            $first_featured = DB::table('featured_apps')->orderBy('id')->first();

            DB::table('featured_apps')
                ->where('id', $first_featured->id)
                ->delete();

            DB::insert(
                'INSERT INTO featured_apps(app_id, created_at, updated_at) VALUES (?, ?, ?)',
                [$id, Carbon::now(), Carbon::now()]
            );
        } else {
            DB::insert(
                'INSERT INTO featured_apps(app_id, created_at, updated_at) VALUES (?, ?, ?)',
                [$id, Carbon::now(), Carbon::now()]
            );
        }
    }

    public function addAppToPicks($id)
    {
        DB::table('top_picks')
            ->where('app_id', $id)
            ->delete();

        DB::insert(
            'INSERT INTO top_picks(app_id, created_at, updated_at) VALUES (?, ?, ?)',
            [$id, Carbon::now(), Carbon::now()]
        );
    }


    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(App $app): iterable
    {
        $this->app = $app;

        $categories = Category::all();

        $map_id = [];

        foreach ($categories as $c)
            $map_id[$c->id] = $c->name;

        $is_app_featured = DB::table('featured_apps')->where('app_id', $app->id)->first();
        $is_app_in_top_picks = DB::table('top_picks')->where('app_id', $app->id)->first();

        return [
            'categories_names' => $map_id,
            'is_app_featured' => $is_app_featured != NULL,
            'is_app_in_top_picks' => $is_app_in_top_picks != NULL,
        ];
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
        return [
            Button::make('Save changes')
                ->type(Color::DARK())
                ->method('update', [$this->app]),
            Button::make('Cancel')
                ->type(Color::LIGHT())
                ->method('back'),
        ];
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
                Select::make('app.category_id')
                    ->options($this->categories_names)
                    ->isOptionList(),
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
                Switcher::make('app.feature')
                    ->sendTrueOrFalse()
                    ->value($this->is_app_featured)
                    ->disabled($this->app->cover_path == NULL)
                    ->title('Feature App')
                    ->help('add app to featured section, this will remove the first featured app' . ($this->app->cover_path ? '' : '(app must have a cover photo to be featured)')),
                Switcher::make('app.top')
                    ->sendTrueOrFalse()
                    ->value($this->is_app_in_top_picks)
                    ->title('Add App to Top Picks')
                    ->help('add app/game to top picks section'),
                Quill::make('app.description')
                    ->title('Application Description')
                    ->popover('Make sure to write an SEO optimal content to reach a wide audience.')
                    ->value($this->app->description)
                    ->toolbar(['text', 'color', 'quote', 'header', 'list', 'format', 'media']),
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
                        ->storage('public')
                        ->multiple(false)
                        ->value($this->app->icon)
                        ->required(),
                    Upload::make('app.cover')
                        ->title('Application Cover Image')
                        ->help('Media type that\'s displayed is applicaton display')
                        ->type('file')
                        ->maxFiles(1)
                        ->storage('public')
                        ->multiple(false)
                        ->value($this->app->cover),
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
            Layout::block([
                Layout::rows([
                    Input::make('app.download_url')
                        ->title('Download URL')
                        ->value($this->app->download_url)
                        ->help('The url where the application is hosted'),
                ])
            ])
                ->title('Download Area')
                ->description('Download sources info'),
            Layout::rows([
                Group::make([
                    Button::make('Save changes')
                        ->type(Color::DARK())
                        ->method('update'),
                    Button::make('Cancel')
                        ->type(Color::LIGHT())
                        ->method('back'),
                ])->autoWidth()
            ])
        ];
    }
}
