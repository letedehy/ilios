<?php

namespace Tests\IliosApiBundle\Endpiont;

use Tests\IliosApiBundle\Endpoint\AbstractTest;

/**
 * Aamcmethod controller Test.
 * @package Ilios\CoreBundle\Test\Controller;
 */
class AamcmethodsTest extends AbstractTest
{
    /**
     * @inheritdoc
     */
    protected function getFixtures()
    {
        return [
            'Tests\CoreBundle\Fixture\LoadAamcMethodData',
            'Tests\CoreBundle\Fixture\LoadSessionTypeData'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getPluralName()
    {
        return 'aamcmethods';
    }

    /**
     * @group api_1
     */
    public function testGetOne()
    {
        $this->getOneTest();
    }

    /**
     * @group api_1
     */
    public function testGetAll()
    {
        $this->getAllTest();
    }

    /**
     * @group api_1
     */
    public function testPost()
    {
        $dataLoader = $this->getDataLoader();
        $data = $dataLoader->create();
        $postData = $data;
        $this->postTest($data, $postData);
    }

    /**
     * @group api_1
     */
    public function testPostBad()
    {
        $dataLoader = $this->getDataLoader();
        $data = $dataLoader->createInvalid();
        $this->badPostTest($data);
    }

    /**
     * @group api_1
     */
    public function testPut()
    {
        $dataLoader = $this->getDataLoader();
        $data = $dataLoader->getOne();
        $data['description'] = 'new';

        $postData = $data;
        $this->putTest($data, $postData);
    }

    /**
     * @group api_1
     */
    public function testDelete()
    {
        $dataLoader = $this->getDataLoader();
        $data = $dataLoader->getOne();
        $this->deleteTest($data['id']);
    }

    /**
     * @group api_1
     */
    public function testNotFound()
    {
        $this->notFoundTest(99);
    }

    /**
     * @group api_1
     */
    public function testFilterBySessionTypes()
    {
        $dataLoader = $this->getDataLoader();
        $all = $dataLoader->getAll();
        $expectedData[] = $all[0];
        $filters = ['filters[sessionTypes]' => [1]];
        $this->filterTest($filters, $expectedData);
    }
}
