<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;


class BloggerRecipeEdit extends Component
{
    use WithFileUploads;

    public $recipe;

    public $name;
//    public $recipe_category_id;
//    public $images= [];
//    public $video;
//    public $ingredients = [];
//    public $steps = [];
    protected $rules = [
        'recipe.name' => 'required',
    ];

    public function mount(Recipe $recipe)
    {
        $this->recipe = $recipe;
        $this->name = $recipe->name;

//        $this->recipe_category_id = $recipe->recipe_category_id;
//        $this->images = $recipe->images;
//        $this->video = $recipe->video;
//        $this->ingredients = $recipe->ingredients;
//        $this->steps = $recipe->steps;
    }
    public function render()
    {
        $recipe_categories=RecipeCategory::orderBy('id','DESC')->get();//食譜類別
        return view('livewire.blogger-recipe-edit', compact('recipe_categories'));
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->recipe->update(['name' => $this->name]);

        return redirect()->route('members.recipes');
    }




}
