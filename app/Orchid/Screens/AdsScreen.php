<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class AdsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Ads';
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
        // top
        // bottom
        // in description
        // auto
        return [
            Layout::rows([
                TextArea::make('top')
                    ->title('Top ad'),
                TextArea::make('bottom')
                    ->title('Bottom ad'),
                TextArea::make('in_description')
                    ->title('In description ad'),
                TextArea::make('auto')
                    ->title('Auto ad')
            ])
        ];
    }
}
