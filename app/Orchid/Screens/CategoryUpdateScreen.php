<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoryUpdateScreen extends Screen
{

    protected Category $category;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $cat): iterable
    {
        $this->category = $cat;
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit Category ' . $this->category->name;
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
                ->method('update', [$this->category]),
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
        return   [

            Layout::rows([
                Input::make('category.name')
                    ->title('Category Name')
                    ->help('the name of the category to be added')
                    ->value($this->category->name)
                    ->required(),
                TextArea::make('category.description')
                    ->title('Category Description')
                    ->help('the description of the category to be added')
                    ->value($this->category->description)
                    ->popover('Use a seo friendly paragraph, describing what the category is all about.'),
                Upload::make('category.icon')
                    ->type('file')
                    ->title('Icon')
                    ->value($this->category->icon)
                    ->placeholder('Select category Icon')
                    ->help('The Icon of the category to be created. 1:1 aspect ratio')
                    ->required(),
            ])

        ];
    }

    public function update(Request $request, $category)
    {
        $input = $request->input('category');
        $category = Category::find($category)->fill($input);
        $attach = Attachment::find($input['icon'][0]);
        $icon_path = $attach->path . $attach->name . '.' . $attach->extension;
        $category->icon = $input['icon'][0];
        $category->icon_path = $icon_path;
        $category->update();
        
        Toast::success('Category Updated successfully');
    }

    public function back()
    {
        return redirect()->route('platform.category');
    }
}
