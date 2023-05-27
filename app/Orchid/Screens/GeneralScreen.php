<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class GeneralScreen extends Screen
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
        return 'General Settings';
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
        // site name
        // site description
        // primary color
        // download button color
        // display categories on footer
        return [
            Layout::rows([
                Input::make("site_name")
                    ->title("Site Name"),
                Input::make("site_description")
                    ->title("Site Description"),
                Input::make("cat_on_footer")
                    ->title("Display Category on Footer"),
            ])->title("General Info"),
            Layout::rows([
                Input::make("primary_color")
                    ->title("Primary Color")
                    ->type('color'),
                Input::make("download_button_color")
                    ->type('color')
                    ->title("Download Button Color"),
            ])->title("Appearance")
        ];
    }
}
