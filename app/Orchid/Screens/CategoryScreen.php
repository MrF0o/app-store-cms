<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoryScreen extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'categories' => Category::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Categories';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Create Category')
                ->modal('categoryModal')
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
            Layout::table('categories', [
                TD::make('id', '#'),
                TD::make('', 'Icon')
                    ->render(fn ($cat) => '<img height="30px" src="' . Storage::url($cat->icon_path) . '" alt>'),
                TD::make('name'),
                TD::make('description'),
                TD::make('created_at', 'Created at')
                    ->render(fn ($cat) => Carbon::parse($cat->created_at)),
                TD::make('')->render(function ($cat) {
                    return
                        Group::make([
                            DropDown::make('Action')
                                ->icon('arrow-down')
                                ->list([
                                    Button::make('Edit')
                                        ->method('edit', [$cat->id]),
                                    Button::make('Delete')
                                        ->method('delete', [$cat->id]),
                                ])
                        ]);
                }),
            ]),

            Layout::modal('categoryModal', Layout::rows([

                Input::make('category.name')
                    ->title('Category Name')
                    ->help('the name of the category to be added')
                    ->required(),
                TextArea::make('category.description')
                    ->title('Category Description')
                    ->help('the description of the category to be added')
                    ->popover('Use a seo friendly paragraph, describing what the category is all about.'),
                Upload::make('category.icon')
                    ->type('file')
                    ->title('Icon')
                    ->placeholder('Select category Icon')
                    ->help('The Icon of the category to be created. 1:1 aspect ratio')
                    ->required(),

            ]))
                ->size('modal-lg')
                ->title('Create Category')
                ->applyButton('Add Category')
        ];
    }

    public function create(Request $request)
    {
        $input = $request->input('category');
        $category = new Category($input);
        $attach = Attachment::find($input['icon'][0]);
        $icon_path = $attach->path . $attach->name . '.' . $attach->extension;
        $category->icon = $input['icon'][0];
        $category->icon_path = $icon_path;
        $category->save();

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        return redirect()->route('platform.category.update', $id);
    }

    public function delete(Request $request, $id)
    {
        $cat = Category::find($id);
        Toast::info("Category $cat->name deleted successfully.");
        $cat->delete();
        
    }
}
