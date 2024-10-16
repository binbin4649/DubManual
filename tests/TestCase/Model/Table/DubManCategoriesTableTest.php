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
use DubManual\Model\Table\DubManCategoriesTable;

/**
 * DubManual\Model\Table\DubManCategoriesTable Test Case
 */
class DubManCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \DubManual\Model\Table\DubManCategoriesTable
     */
    protected $DubManCategories;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'plugin.DubManual.DubManCategories',
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
        $config = $this->getTableLocator()->exists('DubManCategories') ? [] : ['className' => DubManCategoriesTable::class];
        $this->DubManCategories = $this->getTableLocator()->get('DubManCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DubManCategories);

        parent::tearDown();
    }

    /**
     * DubManTopicsがアソシエーションされているかのテスト
     */
    public function testInitialize(): void
    {
        $this->assertTrue($this->DubManCategories->hasAssociation('DubManTopics'));
    }

    /**
     * beforeMarshalのテスト
     *
     * @return void
     */
    public function testBeforeMarshal(): void
    {
        // sort_orderが空の場合、次の番号が自動的に設定されることをテスト
        $data = [
            'name' => 'テストカテゴリ',
            'is_publish' => true,
        ];
        $entity = $this->DubManCategories->newEntity($data);
        $this->assertEquals(2, $entity->sort_order);

        // is_publishが空の場合、trueに設定されることをテスト
        $data = [
            'name' => 'テストカテゴリ',
            'sort_order' => 1,
        ];
        $entity = $this->DubManCategories->newEntity($data);
        $this->assertTrue($entity->is_publish);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \DubManual\Model\Table\DubManCategoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        // Start Generation Here
        // 有効なデータの場合のテスト
        $data = [
            'name' => 'テストカテゴリ',
            'sort_order' => 1,
            'article' => 'テスト記事',
            'is_publish' => true,
        ];
        $dubManCategory = $this->DubManCategories->newEntity($data);
        $this->assertEmpty($dubManCategory->getErrors());

        // nameが空の場合のテスト
        $data['name'] = '';
        $dubManCategory = $this->DubManCategories->newEntity($data);
        $this->assertNotEmpty($dubManCategory->getErrors()['name']);

        // nameが255文字を超える場合のテスト
        $data['name'] = str_repeat('a', 256);
        $dubManCategory = $this->DubManCategories->newEntity($data);
        $this->assertNotEmpty($dubManCategory->getErrors()['name']);

        // sort_orderが数値でない場合のテスト
        $data['sort_order'] = '文字列';
        $dubManCategory = $this->DubManCategories->newEntity($data);
        $this->assertNotEmpty($dubManCategory->getErrors()['sort_order']);

        // is_publishがブール値でない場合のテスト
        $data['is_publish'] = '文字列';
        $dubManCategory = $this->DubManCategories->newEntity($data);
        $this->assertNotEmpty($dubManCategory->getErrors()['is_publish']);
    }
}
