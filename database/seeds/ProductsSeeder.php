<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {

            /* @var $product \App\Models\Product */

            $product = \App\Models\Product::create([
                'attribute_set_id' => 1,
                'type' => 'product_type_simple'
            ]);


            /* @var $attribute \App\Models\Attribute */

            foreach ($product->attributeSet->attributes as $attribute) {

                if ($attribute->hasMultiOptions()) {

                    $product->setData($attribute->code, $attribute->options()->pluck('option_value', 'option_value')->shuffle()->first());
                    continue;
                }

                switch ($attribute->getCode()) {
                    case 'sku':
                    case 'url_key':
                        $value = $faker->slug;
                        break;
                    case 'new_from' :
                    case 'new_to' :
                        $value = $faker->date('d/m/Y');
                        break;

                    case 'short_description' :
                    case 'meta_description' :
                    case 'meta_keywords' :
                        $value = $faker->text(100);
                        break;
                    case 'price' :
                    case 'special_price' :
                        $value = $faker->randomNumber();

                        break;
                    default:
                        $value = $faker->text(20);
                }


                $product->setData($attribute->code, $value);
            };

            $product->categories()->attach(\App\Models\Category::pluck('id', 'id')->shuffle()->take(3));

            for ($i =0; $i <= 10; $i++) {

                $filename = pathinfo($faker->image(storage_path('app/' . \App\Models\ProductImage::UPLOAD_DIR)), PATHINFO_BASENAME);

                $product->images()->create([
                    'label' => $faker->text(10),
                    'sequence' => $i + 1,
                    'image' => \App\Models\ProductImage::UPLOAD_DIR . $filename
                ]);
            }

            $product->related()->attach( \App\Models\Product::where('id', '!=', $product->id)->pluck('id')->shuffle()->take(20) );
            $product->upsells()->attach( \App\Models\Product::where('id', '!=', $product->id)->pluck('id')->shuffle()->take(20) );
            $product->crossSell()->attach( \App\Models\Product::where('id', '!=', $product->id)->pluck('id')->shuffle()->take(20) );

            $product->save();
        }
    }
}
