<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class infoApiTest extends TestCase
{
    use MakeinfoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateinfo()
    {
        $info = $this->fakeinfoData();
        $this->json('POST', '/api/v1/infos', $info);

        $this->assertApiResponse($info);
    }

    /**
     * @test
     */
    public function testReadinfo()
    {
        $info = $this->makeinfo();
        $this->json('GET', '/api/v1/infos/'.$info->id);

        $this->assertApiResponse($info->toArray());
    }

    /**
     * @test
     */
    public function testUpdateinfo()
    {
        $info = $this->makeinfo();
        $editedinfo = $this->fakeinfoData();

        $this->json('PUT', '/api/v1/infos/'.$info->id, $editedinfo);

        $this->assertApiResponse($editedinfo);
    }

    /**
     * @test
     */
    public function testDeleteinfo()
    {
        $info = $this->makeinfo();
        $this->json('DELETE', '/api/v1/infos/'.$info->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/infos/'.$info->id);

        $this->assertResponseStatus(404);
    }
}
