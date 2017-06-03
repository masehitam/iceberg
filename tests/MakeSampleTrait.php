<?php

use Faker\Factory as Faker;
use App\Models\Sample;
use App\Repositories\SampleRepository;

trait MakeSampleTrait
{
    /**
     * Create fake instance of planning4 and save it in database
     *
     * @param array $planning4Fields
     * @return planning4
     */
    public function makeSample($planning4Fields = [])
    {
        /** @var planning4Repository $planning4Repo */
        $planning4Repo = App::make(planning4Repository::class);
        $theme = $this->fakeplanning4Data($planning4Fields);
        return $planning4Repo->create($theme);
    }

    /**
     * Get fake instance of planning4
     *
     * @param array $planning4Fields
     * @return planning4
     */
    public function fakeplanning4($planning4Fields = [])
    {
        return new planning4($this->fakeplanning4Data($planning4Fields));
    }

    /**
     * Get fake data of planning4
     *
     * @param array $postFields
     * @return array
     */
    public function fakeplanning4Data($planning4Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            '[Btitle' => $fake->word,
            'body' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $planning4Fields);
    }
}
