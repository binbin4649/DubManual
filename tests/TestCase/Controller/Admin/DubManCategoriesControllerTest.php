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

namespace DubManual\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestTrait;
use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;
// use Cake\TestSuite\TestCase;
use BaserCore\TestSuite\BcTestCase;
use BaserCore\Test\Scenario\InitAppScenario;
use DubManual\Controller\Admin\DubManCategoriesController;

/**
 * DubManual\Controller\Admin\DubManCategoriesController Test Case
 *
 * @uses \DubManual\Controller\Admin\DubManCategoriesController
 */
class DubManCategoriesControllerTest extends BcTestCase
{
    use IntegrationTestTrait;
    use ScenarioAwareTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->enableRetainFlashMessages();
        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->loadFixtureScenario(InitAppScenario::class);
        $this->loginAdmin($this->getRequest());
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * index メソッドのテスト
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/baser/admin/dub-manual/dub_man_categories/index');
        $this->assertResponseOk();
        $this->assertResponseContains('Dub Man Categories');
    }
}
