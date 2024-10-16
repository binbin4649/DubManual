<?php

namespace DubManual\Test\TestCase\Service;

use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;
use BaserCore\TestSuite\BcTestCase;
use BaserCore\Test\Scenario\InitAppScenario;
use DubManual\Service\DubManCategoriesServiceInterface;
use DubManual\Service\DubManCategoriesService;

class DubManCategoriesServiceTest extends BcTestCase
{
    use ScenarioAwareTrait;

    // protected $dubManCategoriesServiceMock;
    protected $DubManCategoriesService;

    protected array $fixtures = [
        'plugin.DubManual.DubManTopics',
        'plugin.DubManual.DubManCategories',
        'plugin.DubManual.DubManArticles',
    ];

    public function setUp(): void
    {
        parent::setUp();
        //$this->dubManCategoriesServiceMock = $this->createMock(DubManCategoriesServiceInterface::class);
        $this->DubManCategoriesService = new DubManCategoriesService();
    }

    public function tearDown(): void
    {
        // unset($this->dubManCategoriesServiceMock);
        unset($this->DubManCategoriesService);
        parent::tearDown();
    }

    public function testImgDirectoryIsWritable(): void
    {
        $imgPath = ROOT . DS . 'plugins' . DS . 'DubManual' . DS . 'webroot' . DS . 'img';
        $this->assertTrue(is_writable($imgPath), 'imgディレクトリが書き込み可能ではありません。');
    }

    public function testGetIndex(): void
    {
        $query = $this->DubManCategoriesService->getIndex();
        $this->assertInstanceOf(\Cake\Datasource\QueryInterface::class, $query);
        $categories = $query->all()->toArray();
        $this->assertNotEmpty($categories);
        $this->assertTrue($categories[0]->has('dub_man_topics'));
        $this->assertTrue($categories[0]->dub_man_topics[0]->has('dub_man_articles'));
    }
}
