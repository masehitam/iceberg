<?php

use App\Models\planning4;
use App\Repositories\planning4Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class planning4RepositoryTest extends TestCase
{
    use Makeplanning4Trait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var planning4Repository
     */
    protected $planning4Repo;

    public function setUp()
    {
        parent::setUp();
        $this->planning4Repo = App::make(planning4Repository::class);
    }

    /**
     * @test create
     */
    public function testCreateplanning4()
    {
        $planning4 = $this->fakeplanning4Data();
        $createdplanning4 = $this->planning4Repo->create($planning4);
        $createdplanning4 = $createdplanning4->toArray();
        $this->assertArrayHasKey('id', $createdplanning4);
        $this->assertNotNull($createdplanning4['id'], 'Created planning4 must have id specified');
        $this->assertNotNull(planning4::find($createdplanning4['id']), 'planning4 with given id must be in DB');
        $this->assertModelData($planning4, $createdplanning4);
    }

    /**
     * @test read
     */
    public function testReadplanning4()
    {
        $planning4 = $this->makeplanning4();
        $dbplanning4 = $this->planning4Repo->find($planning4->id);
        $dbplanning4 = $dbplanning4->toArray();
        $this->assertModelData($planning4->toArray(), $dbplanning4);
    }

    /**
     * @test update
     */
    public function testUpdateplanning4()
    {
        $planning4 = $this->makeplanning4();
        $fakeplanning4 = $this->fakeplanning4Data();
        $updatedplanning4 = $this->planning4Repo->update($fakeplanning4, $planning4->id);
        $this->assertModelData($fakeplanning4, $updatedplanning4->toArray());
        $dbplanning4 = $this->planning4Repo->find($planning4->id);
        $this->assertModelData($fakeplanning4, $dbplanning4->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteplanning4()
    {
        $planning4 = $this->makeplanning4();
        $resp = $this->planning4Repo->delete($planning4->id);
        $this->assertTrue($resp);
        $this->assertNull(planning4::find($planning4->id), 'planning4 should not exist in DB');
    }
}
