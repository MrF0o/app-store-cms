<?php

namespace App\Orchid\Screens;

use App\Models\App;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EditorChoiceScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'editors_choice' => App::where('is_chosen_by_editor', true)->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Editor\'s choice apps & games';
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
            Layout::table('editors_choice', [
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
                                Button::make('delete from Editor\'s choice')
                                    ->method('unselect', [$app->id])
                                    ->type(Color::DANGER())
                            ]
                        )->autoWidth();
                    }),
            ]),
        ];
    }

    public function unselect($id)
    {
        $app = App::find($id);
        $app->is_chosen_by_editor = false;
        $app->save();
        Toast::info("$app->name removed from Editor's choice successfully.");
    }
}
