<?php

namespace DubManual\Test\TestCase\Service;

use BaserCore\TestSuite\BcTestCase;
use DubManual\Service\DubManTopicsService;

class DubManTopicsServiceTest extends BcTestCase
{
    protected $DubManTopicsService;

    protected array $fixtures = [
        'plugin.DubManual.DubManTopics',
        'plugin.DubManual.DubManCategories',
        'plugin.DubManual.DubManArticles',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->DubManTopicsService = new DubManTopicsService();
    }

    public function tearDown(): void
    {
        unset($this->DubManTopicsService);
        parent::tearDown();
    }

    public function testGetCategoryById(): void
    {
        $category = $this->DubManTopicsService->getCategoryById('1');
        $this->assertInstanceOf(\Cake\Datasource\EntityInterface::class, $category);
    }
}
