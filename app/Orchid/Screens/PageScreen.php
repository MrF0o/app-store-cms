<?php

namespace App\Orchid\Screens;

use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PageScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'pages' => Page::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Pages';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('create Page')
                ->method('createAndRedirect')
                ->icon('plus')
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
            Layout::table('pages', [
                TD::make('title')->width('100%'),
                TD::make()->align(TD::ALIGN_CENTER)
                    ->render(function ($app) {
                        return Group::make([
                            DropDown::make('Action')
                                ->list([
                                    Button::make('Update')
                                        ->type(Color::LINK())
                                        ->method('goToUpdatePage', [$app->id])
                                        ->padding(23),
                                    Button::make('Delete')
                                        ->method('delete', [$app->id])
                                        ->type(Color::DANGER()),
                                ])
                                ->icon('options-vertical'),
                        ]);
                    }),
            ]),
        ];
    }

    public function createAndRedirect()
    {
        $page = new Page();
        $page->title = 'Untitled Page';
        $page->save();

        return redirect()->route('platform.page.update', $page->id);
    }

    public function goToUpdatePage($id)
    {
        return redirect()->route('platform.page.update', $id);
    }

    public function delete($id)
    {
        $page = Page::find($id);
        Toast::info("Page $page->name deleted successfully.");
        $page->delete();
    }
}
