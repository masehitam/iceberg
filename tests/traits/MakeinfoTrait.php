<?php

use Faker\Factory as Faker;
use App\Models\info;
use App\Repositories\infoRepository;

trait MakeinfoTrait
{
    /**
     * Create fake instance of info and save it in database
     *
     * @param array $infoFields
     * @return info
     */
    public function makeinfo($infoFields = [])
    {
        /** @var infoRepository $infoRepo */
        $infoRepo = App::make(infoRepository::class);
        $theme = $this->fakeinfoData($infoFields);
        return $infoRepo->create($theme);
    }

    /**
     * Get fake instance of info
     *
     * @param array $infoFields
     * @return info
     */
    public function fakeinfo($infoFields = [])
    {
        return new info($this->fakeinfoData($infoFields));
    }

    /**
     * Get fake data of info
     *
     * @param array $postFields
     * @return array
     */
    public function fakeinfoData($infoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'link' => $fake->word,
            'zipcode' => $fake->word,
            'image' => $fake->word,
            'category' => $fake->randomDigitNotNull,
            'public_date' => $fake->word,
            'start_date' => $fake->word,
            'end_date' => $fake->word,
            'body' => $fake->text,
            'display_flg' => $fake->randomDigitNotNull,
            'toppage_flg' => $fake->randomDigitNotNull,
            'popular' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $infoFields);
    }
}
