<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('sku')->primary();
            $table->string('name');
            $table->string('category');
            $table->integer('price');
        });

        // Inserts
        DB::table('products')->insert(
            array(
                'sku' => '000001',
                'name' => 'Full coverage insurance',
                'category' => 'insurance',
                'price' => '89000',
            )
        );

        
        DB::table('products')->insert(
            array(
                'sku' => '000002',
                'name' => 'Compact Car x3',
                'category' => 'vehicle',
                'price' => '99000',
            )
        );

        
        DB::table('products')->insert(
            array(
                'sku' => '000003',
                'name' => 'SUV Vehicle, high end',
                'category' => 'vehicle',
                'price' => '150000',
            )
        );

        
        DB::table('products')->insert(
            array(
                'sku' => '000004',
                'name' => 'Basic coverage ',
                'category' => 'insurance',
                'price' => '20000',
            )
        );

        
        DB::table('products')->insert(
            array(
                'sku' => '000005',
                'name' => 'Convertible X2, Electric',
                'category' => 'vehicle',
                'price' => '250000',
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
