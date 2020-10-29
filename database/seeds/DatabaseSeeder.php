<?php

use App\Category;
use App\Product;
use App\SubCategory;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Category::create([
            'name' => 'Laptops',
            'slug' => 'laptops',
            'description' => 'Laptops Category',
            'image' => 'files/laptops.jpeg'
        ]);
        Category::create([
            'name' => 'Cameras',
            'slug' => 'cameras',
            'description' => 'Cameras Category',
            'image' => 'files/cameras.jpeg'
        ]);

        SubCategory::create([
            'name' => 'Dell',
            'category_id' => 1
        ]);
        SubCategory::create([
            'name' => 'HP',
            'category_id' => 1
        ]);
        SubCategory::create([
            'name' => 'Lenovo',
            'category_id' => 1
        ]);
        SubCategory::create([
            'name' => 'Canon',
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'HP Pavilion',
            'image' => 'products/NTbSaAh9gIBMIXYYBgrU6Mr9el4GMP1wTdvqJiAf.jpeg',
            'price' => rand(700, 1000),
            'description' => 'This is HP Pavilion Laptop.',
            'additional_info' => 'Portable, reliable and very fast',
            'category_id' => 1,
            'sub_category_id' => 2
        ]);
        Product::create([
            'name' => 'Canon Camera',
            'image' => 'products/NLtpDFXKtvaiHj8dDbQWoNnkdSXiJjtJcabNzVpf.jpeg',
            'price' => rand(800, 1500),
            'description' => 'This is Canon Camera.',
            'additional_info' => 'Portable, reliable and clarity',
            'category_id' => 2,
            'sub_category_id' => 1
        ]);

        User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('admin123'),
            'email_verified_at'=>NOW(),
            'address'=>'Australia',
            'phone_number'=>'0212458760',
            'is_admin'=>1
        ]);
    }
}
