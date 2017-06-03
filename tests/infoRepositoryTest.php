<?php

use App\Models\info;
use App\Repositories\infoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class infoRepositoryTest extends TestCase
{
    use MakeinfoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var infoRepository
     */
    protected $infoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->infoRepo = App::make(infoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateinfo()
    {
        $info = $this->fakeinfoData();
        $createdinfo = $this->infoRepo->create($info);
        $createdinfo = $createdinfo->toArray();
        $this->assertArrayHasKey('id', $createdinfo);
        $this->assertNotNull($createdinfo['id'], 'Created info must have id specified');
        $this->assertNotNull(info::find($createdinfo['id']), 'info with given id must be in DB');
        $this->assertModelData($info, $createdinfo);
    }

    /**
     * @test read
     */
    public function testReadinfo()
    {
        $info = $this->makeinfo();
        $dbinfo = $this->infoRepo->find($info->id);
        $dbinfo = $dbinfo->toArray();
        $this->assertModelData($info->toArray(), $dbinfo);
    }

    /**
     * @test update
     */
    public function testUpdateinfo()
    {
        $info = $this->makeinfo();
        $fakeinfo = $this->fakeinfoData();
        $updatedinfo = $this->infoRepo->update($fakeinfo, $info->id);
        $this->assertModelData($fakeinfo, $updatedinfo->toArray());
        $dbinfo = $this->infoRepo->find($info->id);
        $this->assertModelData($fakeinfo, $dbinfo->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteinfo()
    {
        $info = $this->makeinfo();
        $resp = $this->infoRepo->delete($info->id);
        $this->assertTrue($resp);
        $this->assertNull(info::find($info->id), 'info should not exist in DB');
    }
}
