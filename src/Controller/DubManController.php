<?php

declare(strict_types=1);

namespace DubManual\Controller;

use BaserCore\Controller\BcFrontAppController;
use DubManual\Service\DubManCategoriesServiceInterface;
use DubManual\Service\DubManTopicsServiceInterface;

class DubManController extends BcFrontAppController
{
    public function index(DubManCategoriesServiceInterface $service)
    {
        $categories = $service->getIndex();
        $this->set(compact('categories'));
    }

    public function view(DubManTopicsServiceInterface $service, $id)
    {
        $topic = $service->get((int)$id);
        $this->set(compact('topic'));
    }
}
