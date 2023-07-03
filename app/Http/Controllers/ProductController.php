<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Auth;
use Image;

class ProductController extends Controller
{
    public function productView(){

        $allData = Product::latest()->paginate(10);
        $colors = [
            "table-primary",
            "table-secondary",
            "table-success",
            "table-danger",
            "table-warning",
            "table-info",
            "table-light",
        ];
        return view(
            "backend.product.index",
            compact("allData", "colors")
        );
    } // End Method

    public function productStore(Request $request)
    {
        $validatedData = $request->validate([
            "product_name" => "required|unique:products",
            // "product_amount" => "required",
            "product_amount" => "required|numeric|between:0,9999999.99",
        ], [
            "product_name.required" => "Please input product name",
            "product_name.unique" => "Product name must be unique",
            "product_amount.required" => "Please input product amount",
            // "product_amount.numeric" => "Product amount must be a numeric value",
        ]);

        $productAmount = (float) $request->product_amount;

        Product::insert([
            "product_name" => $request->product_name,
            "product_amount" => $productAmount,
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Product added successfully",
            "alert-type" => "success",
        ];

        return back()->with($notification);
    } // End Method

    public function productUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate(
            [
                "product_name" => "required|unique:products,product_name," . $id,
                "product_amount" => "required",
            ],
            [
                "product_name.required" => "Please input product name",
                "product_amount.required" => "Please input product amount",
            ]
        );

        try {
            // Find the product by ID
            $product = Product::findOrFail($id);

            // Update the fields with the new values
            $product->product_name = $request->product_name;
            $product->product_amount = $request->product_amount;
            $product->updated_by = Auth::user()->id;
            $product->updated_at = Carbon::now();

            // Save the updated product
            $product->save();

            $notification = [
                "message" => "product updated successfully",
                "alert-type" => "success",
            ];
            return back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                "message" => "Failed to update product",
                "alert-type" => "error",
            ];
            return back()->with($notification);
        }
    } // End Method

    public function productDelete($id)
    {
        // Delete from the Database
        Product::find($id)->delete();
        $notification = [
            "message" => "Deleted Successfully",
            "alert-type" => "success",
        ];
        return Redirect()
            ->route("product.view")
            ->with($notification);
    } // End Method

}
