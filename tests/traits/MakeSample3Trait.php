<?php

use Faker\Factory as Faker;
use App\Models\Sample3;
use App\Repositories\Sample3Repository;

trait MakeSample3Trait
{
    /**
     * Create fake instance of Sample3 and save it in database
     *
     * @param array $sample3Fields
     * @return Sample3
     */
    public function makeSample3($sample3Fields = [])
    {
        /** @var Sample3Repository $sample3Repo */
        $sample3Repo = App::make(Sample3Repository::class);
        $theme = $this->fakeSample3Data($sample3Fields);
        return $sample3Repo->create($theme);
    }

    /**
     * Get fake instance of Sample3
     *
     * @param array $sample3Fields
     * @return Sample3
     */
    public function fakeSample3($sample3Fields = [])
    {
        return new Sample3($this->fakeSample3Data($sample3Fields));
    }

    /**
     * Get fake data of Sample3
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSample3Data($sample3Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title1' => $fake->word,
            'subtitle' => $fake->word,
            'answer001' => $fake->text,
            'email' => $fake->word,
            'start_date' => $fake->word,
            'number' => $fake->randomDigitNotNull,
            'zipcode' => $fake->word,
            'password' => $fake->word,
            'image' => $fake->word,
            'category' => $fake->randomDigitNotNull,
            'pref' => $fake->randomDigitNotNull,
            'popular' => $fake->randomDigitNotNull,
            'display_flg' => $fake->randomDigitNotNull,
            'hid' => $fake->randomDigitNotNull,
            'created_id' => $fake->randomDigitNotNull,
            'updated_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $sample3Fields);
    }
}
