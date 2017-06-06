<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Sample3ApiTest extends TestCase
{
    use MakeSample3Trait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSample3()
    {
        $sample3 = $this->fakeSample3Data();
        $this->json('POST', '/api/v1/sample3s', $sample3);

        $this->assertApiResponse($sample3);
    }

    /**
     * @test
     */
    public function testReadSample3()
    {
        $sample3 = $this->makeSample3();
        $this->json('GET', '/api/v1/sample3s/'.$sample3->id);

        $this->assertApiResponse($sample3->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSample3()
    {
        $sample3 = $this->makeSample3();
        $editedSample3 = $this->fakeSample3Data();

        $this->json('PUT', '/api/v1/sample3s/'.$sample3->id, $editedSample3);

        $this->assertApiResponse($editedSample3);
    }

    /**
     * @test
     */
    public function testDeleteSample3()
    {
        $sample3 = $this->makeSample3();
        $this->json('DELETE', '/api/v1/sample3s/'.$sample3->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sample3s/'.$sample3->id);

        $this->assertResponseStatus(404);
    }
}
