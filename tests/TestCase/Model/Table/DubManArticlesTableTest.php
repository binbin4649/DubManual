<?php

declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.7
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace DubManual\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use DubManual\Model\Table\DubManArticlesTable;

/**
 * DubManual\Model\Table\DubManArticlesTable Test Case
 */
class DubManArticlesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \DubManual\Model\Table\DubManArticlesTable
     */
    protected $DubManArticles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'plugin.DubManual.DubManArticles',
        'plugin.DubManual.DubManTopics',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DubManArticles') ? [] : ['className' => DubManArticlesTable::class];
        $this->DubManArticles = $this->getTableLocator()->get('DubManArticles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DubManArticles);

        parent::tearDown();
    }

    /**
     * DubManTopicsがアソシエーションされているかのテスト
     */
    public function testInitialize(): void
    {
        $this->assertTrue($this->DubManArticles->hasAssociation('DubManTopics'));
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \DubManual\Model\Table\DubManArticlesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        // Start Generation Here
        // 有効なデータの場合のテスト
        $data = [
            'name' => 'テスト記事',
            'article' => 'これはテスト記事です。',
            'img' => 'test_image.jpg',
            'sort_order' => 1,
        ];
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertEmpty($dubManArticle->getErrors());

        // nameが255文字を超える場合のテスト
        $data['name'] = str_repeat('a', 256);
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertNotEmpty($dubManArticle->getErrors()['name']);

        // nameが非スカラーの場合のテスト
        $data['name'] = ['配列'];
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertNotEmpty($dubManArticle->getErrors()['name']);

        // imgが255文字を超える場合のテスト
        $data['name'] = 'テスト記事';
        $data['img'] = str_repeat('a', 256);
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertNotEmpty($dubManArticle->getErrors()['img']);

        // imgが非スカラーの場合のテスト
        $data['img'] = ['配列'];
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertNotEmpty($dubManArticle->getErrors()['img']);

        // sort_orderが空の場合のテスト
        $data['img'] = 'test_image.jpg';
        $data['sort_order'] = null;
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertNotEmpty($dubManArticle->getErrors()['sort_order']);

        // sort_orderが数値でない場合のテスト
        $data['sort_order'] = '文字列';
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertNotEmpty($dubManArticle->getErrors()['sort_order']);

        // sort_orderが整数である場合のテスト
        $data['sort_order'] = 2;
        $dubManArticle = $this->DubManArticles->newEntity($data);
        $this->assertEmpty($dubManArticle->getErrors());
    }
}
