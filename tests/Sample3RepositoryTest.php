<?php

use App\Models\Sample3;
use App\Repositories\Sample3Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Sample3RepositoryTest extends TestCase
{
    use MakeSample3Trait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Sample3Repository
     */
    protected $sample3Repo;

    public function setUp()
    {
        parent::setUp();
        $this->sample3Repo = App::make(Sample3Repository::class);
    }

    /**
     * @test create
     */
    public function testCreateSample3()
    {
        $sample3 = $this->fakeSample3Data();
        $createdSample3 = $this->sample3Repo->create($sample3);
        $createdSample3 = $createdSample3->toArray();
        $this->assertArrayHasKey('id', $createdSample3);
        $this->assertNotNull($createdSample3['id'], 'Created Sample3 must have id specified');
        $this->assertNotNull(Sample3::find($createdSample3['id']), 'Sample3 with given id must be in DB');
        $this->assertModelData($sample3, $createdSample3);
    }

    /**
     * @test read
     */
    public function testReadSample3()
    {
        $sample3 = $this->makeSample3();
        $dbSample3 = $this->sample3Repo->find($sample3->id);
        $dbSample3 = $dbSample3->toArray();
        $this->assertModelData($sample3->toArray(), $dbSample3);
    }

    /**
     * @test update
     */
    public function testUpdateSample3()
    {
        $sample3 = $this->makeSample3();
        $fakeSample3 = $this->fakeSample3Data();
        $updatedSample3 = $this->sample3Repo->update($fakeSample3, $sample3->id);
        $this->assertModelData($fakeSample3, $updatedSample3->toArray());
        $dbSample3 = $this->sample3Repo->find($sample3->id);
        $this->assertModelData($fakeSample3, $dbSample3->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSample3()
    {
        $sample3 = $this->makeSample3();
        $resp = $this->sample3Repo->delete($sample3->id);
        $this->assertTrue($resp);
        $this->assertNull(Sample3::find($sample3->id), 'Sample3 should not exist in DB');
    }
}
