<?php

namespace App\Orchid\Screens;

use App\Models\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TopPicksScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tops' => App::join('top_picks', 'apps.id', '=', 'top_picks.app_id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Top Picks';
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
            Layout::table('tops', [
                TD::make('id', '#'),
                TD::make('icon', 'Icon')->width('100px')
                    ->render(function ($app) {
                        $html = '<img widht="100%" height="50px" src="' . Storage::url($app->icon_path) . '" >';

                        return $html;
                    }),
                TD::make('name', 'Name')
                ->width('100%'),
                TD::make('Action')
                    ->render(function ($app) {
                        return Group::make(
                            [
                                Button::make('delete from top picks')
                                    ->method('delete', [$app->app_id])
                                    ->type(Color::DANGER())
                            ]
                        )->autoWidth();
                    }),
            ]),
        ];
    }

    public function delete($id) {
        DB::table('top_picks')
            ->where('app_id', $id)
            ->delete();
        
        Toast::info('app removed from top picks');
    }
}
