<?php

namespace App\Orchid\Screens;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class AppScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'apps' => App::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Apps';
    }

    public function description(): ?string
    {
        return 'Create and manage Apps & Games';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Create App')
                ->modal('appModal')
                ->method('create')
                ->icon('plus'),
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
            Layout::table('apps', [
                TD::make('icon', 'Icon')->width('100px')
                    ->render(function ($app) {
                        $html = '<img widht="100%" height="50px" src="' . Storage::url($app->icon_path) . '" >';

                        return $html;
                    }),
                TD::make('name', 'Name')->width('100%'),
                TD::make()->align(TD::ALIGN_CENTER)
                    ->render(function ($app) {
                        return Group::make([
                            DropDown::make('Action')
                                ->list([
                                    Button::make('Update')
                                        ->type(Color::LINK())
                                        ->padding(23),
                                    Link::make('Delete')
                                        ->type(Color::DANGER()),
                                ])
                                ->icon('options-vertical'),
                            Button::make('Publish')
                                ->type(Color::PRIMARY()),
                        ]);
                    }),
            ]),

            Layout::modal('appModal', Layout::rows([
                Input::make('app.name')
                    ->title('Name')
                    ->placeholder('Enter The application name')
                    ->help('The name of the app to be created.'),
                Upload::make('app.icon')
                    ->type('file')
                    ->title('Icon')
                    ->placeholder('Select app Icon')
                    ->help('The Icon of the app to be created. 1:1 aspect ratio')
                    ->required(),
                Select::make('app.isapp')
                    ->options([
                        'app' => 'App',
                        'game' => 'Game',
                    ])
                    ->title('Application Type')
                    ->help('select either an app or game'),
            ]))
                ->size('modal-lg')
                ->title('Create App')
                ->applyButton('Add App'),
        ];
    }

    public function create(Request $request)
    {
        $input = $request->input('app');
        $app = new App($input);
        $app->is_app = $input['isapp'] == 'app' ? true : false;
        $attach = Attachment::find($input['icon'][0]);
        $icon_path = $attach->path . $attach->name . '.' . $attach->extension;
        $app->icon = $input['icon'][0];
        $app->icon_path = $icon_path;
        $app->save();

        return redirect()->route('platform.app.update', $app->id);
    }
}
