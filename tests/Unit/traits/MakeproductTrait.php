<?php

use Faker\Factory as Faker;
use App\Models\product;
use App\Repositories\productRepository;

trait MakeproductTrait
{
    /**
     * Create fake instance of product and save it in database
     *
     * @param array $productFields
     * @return product
     */
    public function makeproduct($productFields = [])
    {
        /** @var productRepository $productRepo */
        $productRepo = App::make(productRepository::class);
        $theme = $this->fakeproductData($productFields);
        return $productRepo->create($theme);
    }

    /**
     * Get fake instance of product
     *
     * @param array $productFields
     * @return product
     */
    public function fakeproduct($productFields = [])
    {
        return new product($this->fakeproductData($productFields));
    }

    /**
     * Get fake data of product
     *
     * @param array $postFields
     * @return array
     */
    public function fakeproductData($productFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'hid' => $fake->word,
            'name' => $fake->word,
            'start_date' => $fake->word,
            'category' => $fake->randomDigitNotNull,
            'zipcode' => $fake->word,
            'company' => $fake->randomDigitNotNull,
            'pref' => $fake->randomDigitNotNull,
            'address01' => $fake->word,
            'address02' => $fake->word,
            'level' => $fake->randomDigitNotNull,
            'rank' => $fake->randomDigitNotNull,
            'image' => $fake->word,
            'top_image' => $fake->word,
            'description' => $fake->text,
            'position' => $fake->text,
            'display_flg' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $productFields);
    }
}
