<?php

namespace App\Orchid\Screens;

use App\Models\Page;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UpdatePageScreen extends Screen
{
    public $page;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Page $page): iterable
    {
        $this->page = $page;
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Update ' . $this->page->title;
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
                ->method('update'),
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
                Input::make('page.title')
                    ->title('Page title')
                    ->value($this->page->title),
                Quill::make('page.content')
                    ->title('Page Content')
                    ->popover('Make sure to write an SEO optimal content to reach a wide audience.')
                    ->value($this->page->content)
                    ->toolbar(['text', 'color', 'quote', 'header', 'list', 'format', 'media']),
                TextArea::make('page.seo_description')
                    ->value($this->page->seo_description)
                    ->help('Descriptions are limited to about 155 characters for desktop search and 120 characters for mobile search')
                    ->title('SEO Description'),
                Input::make('page.seo_keywords')
                    ->value($this->page->seo_keywords)
                    ->title('SEO Keywords'),
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

    public function update(Request $request, Page $page)
    {
        $page->fill($request->input('page'));
        $page->save();

        Toast::success('Page saved successfully.');
    }

    public function back()
    {
        return redirect()->route('platform.page');
    }
}
