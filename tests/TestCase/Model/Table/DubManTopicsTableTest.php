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
use DubManual\Model\Table\DubManTopicsTable;

/**
 * DubManual\Model\Table\DubManTopicsTable Test Case
 */
class DubManTopicsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \DubManual\Model\Table\DubManTopicsTable
     */
    protected $DubManTopics;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'plugin.DubManual.DubManTopics',
        'plugin.DubManual.DubManCategories',
        'plugin.DubManual.DubManArticles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DubManTopics') ? [] : ['className' => DubManTopicsTable::class];
        $this->DubManTopics = $this->getTableLocator()->get('DubManTopics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DubManTopics);

        parent::tearDown();
    }

    /**
     * アソシエーションのテスト
     */
    public function testInitialize(): void
    {
        // DubManCategoriesとのアソシエーションが設定されているか確認
        $this->assertTrue($this->DubManTopics->hasAssociation('DubManCategories'));

        // DubManArticlesとのアソシエーションが設定されているか確認
        $this->assertTrue($this->DubManTopics->hasAssociation('DubManArticles'));
    }

    // Start Generation Here
    public function testBeforeMarshal(): void
    {
        // sort_orderが空の場合、beforeMarshalで設定されるかのテスト
        $data = [
            'name' => 'テストトピック',
            // 'sort_order'を省略
            'is_publish' => true,
        ];
        $entity = $this->DubManTopics->newEntity($data);
        $this->assertEquals(2, $entity->sort_order);

        // is_publishが空の場合、beforeMarshalでデフォルトが設定されるかのテスト
        $data = [
            'name' => 'テストトピック',
            'sort_order' => 1,
            // 'is_publish'を省略
        ];
        $entity = $this->DubManTopics->newEntity($data);
        $this->assertTrue($entity->is_publish);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \DubManual\Model\Table\DubManTopicsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        // 有効なデータの場合のテスト
        $data = [
            'name' => 'テストトピック',
            'sort_order' => 2,
            'is_publish' => true,
        ];
        $dubManTopic = $this->DubManTopics->newEntity($data);
        $this->assertEmpty($dubManTopic->getErrors());

        // nameが空の場合のテスト
        $data['name'] = '';
        $dubManTopic = $this->DubManTopics->newEntity($data);
        $this->assertNotEmpty($dubManTopic->getErrors()['name']);

        // nameが255文字を超える場合のテスト
        $data['name'] = str_repeat('a', 256);
        $dubManTopic = $this->DubManTopics->newEntity($data);
        $this->assertNotEmpty($dubManTopic->getErrors()['name']);

        // sort_orderが数値でない場合のテスト
        $data['sort_order'] = '文字列';
        $dubManTopic = $this->DubManTopics->newEntity($data);
        $this->assertNotEmpty($dubManTopic->getErrors()['sort_order']);

        // is_publishがブール値でない場合のテスト
        $data['is_publish'] = '文字列';
        $dubManTopic = $this->DubManTopics->newEntity($data);
        $this->assertNotEmpty($dubManTopic->getErrors()['is_publish']);
    }
}
