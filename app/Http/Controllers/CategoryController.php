<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $data = (object) [
            'categories' => $categories
        ];
        return view('categories.category')->with(["data" => $data]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories,title',
        ], [
            'title.required' => 'Поле название категории обязательно для заполнения',
            'title.string' => 'Название категории должно быть строкой',
            'title.max' => 'Название категории не должно превышать 255 символов',
            'title.unique' => 'Категория с таким названием уже существует',
        ]);

        if ($validator->fails()) {
            return redirect()->route('categories.create')
                ->withErrors($validator)
                ->withInput();
        }

        Category::create([
            'title' => $request->title,

        ]);

        return redirect()->route('categories.index')->with('success', 'Категория успешно добавлена');
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $data = (object) [
            'id' => $category->id,
            'title' => $category->title,

        ];
        return view('categories.show')->with(["data" => $data]);
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories,title,' . $category->id,
        ], [
            'title.required' => 'Поле название категории обязательно для заполнения',
            'title.string' => 'Название категории должно быть строкой',
            'title.max' => 'Название категории не должно превышать 255 символов',
            'title.unique' => 'Категория с таким названием уже существует',
        ]);

        if ($validator->fails()) {
            return redirect()->route('categories.edit', $category->id)
                ->withErrors($validator)
                ->withInput();
        }

        $category->update([
            'title' => $request->title,

        ]);

        return redirect()->route('categories.index')->with('success', 'Категория успешно изменена');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Категория удалена');
    }
}
