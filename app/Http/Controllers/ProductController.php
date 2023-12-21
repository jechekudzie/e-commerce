<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.index', compact('products','categories','brands'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|max:255',
            'model' => 'nullable|max:255',
            'description' => 'nullable',
            'quantity' => 'nullable|integer',
            'image' => 'nullable|image',
            'price' => 'nullable|numeric',
            'on_discount' => 'nullable|boolean',
            'discount_percentage' => 'nullable|numeric',
            'qr_code' => 'nullable|max:255',
            'bar_code' => 'nullable|max:255',
        ]);

        // Handle the uploaded image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file_name = time() . $name;
            $path = $file->move('images/products', $file_name);
            $validatedData['image'] = $path;
        }

        Product::create($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|max:255',
            'model' => 'nullable|max:255',
            'description' => 'nullable',
            'quantity' => 'nullable|integer',
            'image' => 'nullable|image',
            'price' => 'nullable|numeric',
            'on_discount' => 'nullable|boolean',
            'discount_percentage' => 'nullable|numeric',
            'qr_code' => 'nullable|max:255',
            'bar_code' => 'nullable|max:255',
        ]);

        // Handle the uploaded image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file_name = time() . $name;
            $path = $file->move('images/products', $file_name);

            // Delete the previous image if it exists
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $validatedData['image'] = $path;
        }

        $product->update($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
        // ...
    }
}
