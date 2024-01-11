<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public function listAll(Request $request)
    {
        $productsArray = [];

        $category= $request->query('category');
        $price= $request->query('price');

        if(!isset($price) && !isset($category))
        {
            $productsArray = Products::all();
        }
        else
        {
            if(isset($price) && isset($category))
            {
                $priceAndCategoryProductsArray = Products::where('price', $price)->where('category', $category)->get();
        
                foreach ($priceAndCategoryProductsArray as $priceAndCategory)
                {
                    array_push($productsArray, $priceAndCategory);
                }
            }
            else
            {
                if(isset($price))
                {
                    $priceProductsArray = Products::where('price', $price)->get();
        
                    foreach ($priceProductsArray as $priceProduct)
                    {
                        array_push($productsArray, $priceProduct);
                    }
                }
        
                if(isset($category))
                {
                    $categoryProductsArray = Products::where('category', $category)->get();
        
                    foreach ($categoryProductsArray as $categoryProduct)
                    {
                        array_push($productsArray, $categoryProduct);
                    }
                }
            }
        }
    
        foreach ($productsArray as $item)
        {
            $returnArray[] = ProductsController::validatePrice($item);
        }

        if(count($productsArray) <= 0)
            return $productsArray;

        return $returnArray;
    }

    private function validatePrice(Products $product)
    {
        $calculateItemPrice = null;

        $insuranceDiscount = 30;
        $productDiscount = 15;

        if('insurance' == $product->category)
        {
            $priceData = [
                'orginal' => $product->price,
                'final' => ProductsController::discountCalculate($product->price, $insuranceDiscount),
                'discount_percentage' => $insuranceDiscount . '%',
                "currency" => 'USD'
            ];
            $calculateItemPrice = $priceData;
        }
        elseif('000003' == $product->sku)
        {
            $priceData = [
                'orginal' => $product->price,
                'final' => ProductsController::discountCalculate($product->price, $productDiscount),
                'discount_percentage' => $productDiscount . '%',
                "currency" => 'USD'
            ];
            $calculateItemPrice = $priceData;
        }
        else
        {
            $priceData = [
                'orginal' => $product->price,
                'final' => $product->price,
                'discount_percentage' => null,
                "currency" => 'USD'
            ];
            $calculateItemPrice = $priceData;

        }
        $product->price = $calculateItemPrice;
        
        return $product;
    }

    private function discountCalculate(int $originalPrice, int $discount)
    {
        return (int)(($originalPrice*(100-$discount))/100);
    }
}
