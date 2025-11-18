<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->filterByName($request->name)
            ->filterByQtyMin($request->qty_min)
            ->filterByPriceMin($request->price_min)
            ->filterByPriceMax($request->price_max)
            ->filterByCategory($request->category_id)
            ->when($request->sort == 'newest', fn($q) => $q->orderBy('created_at', 'desc'))
            ->when($request->sort == 'price_asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($request->sort == 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
            ->when($request->sort == 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
            ->when($request->sort == 'name_desc', fn($q) => $q->orderBy('name', 'desc'))
            ->when($request->sort == 'qty_asc', fn($q) => $q->orderBy('qty', 'asc'))
            ->when($request->sort == 'qty_desc', fn($q) => $q->orderBy('qty', 'desc'))
            ->when(!$request->sort, fn($q) => $q->orderBy('id', 'desc'))
            ->paginate(3)
            ->appends(request()->query());

        $categories = Category::all();
        return view('products.product', compact('products', 'categories'));
    }

    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Доступ запрещен');
        }

        $category = Category::all();
        return view('products.create')->with(["category" => $category]);
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Доступ запрещен');
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => 'required',
            'category_id' => 'required',
            'qty' => ['required', 'integer'],
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator)
                ->withInput();
        }

        $image_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = 'images/products/';
        $request->file('image')->move(public_path($path), $image_name);
        Product::create([
                'image' => $path . $image_name,
            ] + $request->all());
        return redirect()->route('products.index')->with('success', 'Товар добавлен');
    }

    public function show(string $id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        $data = (object)[
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $product->qty,
            'description' => $product->description,
            'image' => $product->image,
            'category' => $category->title,
        ];
        return view('products.show')->with(["data" => $data]);
    }

    public function edit(string $id)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Доступ запрещен');
        }

        $pro = Product::find($id);
        $category = Category::all();
        return view('products.edit', compact('pro'))->with(["category" => $category]);
    }

    public function update(Request $request, Product $product)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Доступ запрещен');
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => 'required',
            'category_id' => 'required',
            'qty' => ['required', 'integer'],
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)
                ->withErrors($validator)
                ->withInput();
        }

        $product->update($request->except('image'));

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = 'images/products/';
            $request->file('image')->move(public_path($path), $image_name);
            $product->image = $path . $image_name;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Товар изменен');
    }

    public function destroy(string $id)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Доступ запрещен');
        }

        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар Удален');
    }
}
