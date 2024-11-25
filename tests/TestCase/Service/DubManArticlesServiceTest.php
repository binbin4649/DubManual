<?php

namespace DubManual\Test\TestCase\Service;

use Cake\TestSuite\TestCase;
use Cake\Core\Configure;
use DubManual\Service\DubManArticlesService;

class DubManArticlesServiceTest extends TestCase
{


    public function testHandleFileUpload()
    {
        Configure::write('BcApp.coreFrontTheme', 'NomissTheme');
        // handleFileUploadのテスト
        $service = new DubManArticlesService();

        // アップロードファイルのモックを作成
        $uploadedFile = $this->createMock(\Laminas\Diactoros\UploadedFile::class);
        $uploadedFile->method('getError')->willReturn(UPLOAD_ERR_OK);
        $uploadedFile->method('getClientFilename')->willReturn('test.jpg');
        $uploadedFile->expects($this->once())->method('moveTo');

        // 保存されたエンティティのモックを作成
        $entity = $this->createMock(\Cake\Datasource\EntityInterface::class);
        $entity->id = 1;

        // リフレクションを使ってプライベートメソッドhandleFileUploadを呼び出す
        $reflection = new \ReflectionClass(DubManArticlesService::class);
        $method = $reflection->getMethod('handleFileUpload');
        $method->setAccessible(true);
        $result = $method->invokeArgs($service, [$uploadedFile, $entity]);
        $this->assertInstanceOf(\Cake\Datasource\EntityInterface::class, $result);
        $this->assertEquals('/nomiss_theme/img/DubManual/1.jpg', $result->img);
    }
}
