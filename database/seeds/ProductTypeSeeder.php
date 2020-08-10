<?php

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productType = new ProductType;
        $productType->name = "Application";
        $productType->save();

        $productType = new ProductType;
        $productType->name = "Deed only";
        $productType->save();

        $productType = new ProductType;
        $productType->name = "Purchase";
        $productType->save();

        $productType = new ProductType;
        $productType->name = "Refinance";
        $productType->save();

        $productType = new ProductType;
        $productType->name = "Reverse";
        $productType->save();

        $productType = new ProductType;
        $productType->name = "Other";
        $productType->save();
        
    }
}
