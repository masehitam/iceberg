<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class planning4ApiTest extends TestCase
{
    use Makeplanning4Trait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateplanning4()
    {
        $planning4 = $this->fakeplanning4Data();
        $this->json('POST', '/api/v1/planning4s', $planning4);

        $this->assertApiResponse($planning4);
    }

    /**
     * @test
     */
    public function testReadplanning4()
    {
        $planning4 = $this->makeplanning4();
        $this->json('GET', '/api/v1/planning4s/'.$planning4->id);

        $this->assertApiResponse($planning4->toArray());
    }

    /**
     * @test
     */
    public function testUpdateplanning4()
    {
        $planning4 = $this->makeplanning4();
        $editedplanning4 = $this->fakeplanning4Data();

        $this->json('PUT', '/api/v1/planning4s/'.$planning4->id, $editedplanning4);

        $this->assertApiResponse($editedplanning4);
    }

    /**
     * @test
     */
    public function testDeleteplanning4()
    {
        $planning4 = $this->makeplanning4();
        $this->json('DELETE', '/api/v1/planning4s/'.$planning4->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/planning4s/'.$planning4->id);

        $this->assertResponseStatus(404);
    }
}
