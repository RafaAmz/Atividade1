<?php
namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class HomeController extends AbstractActionController
{
    public function homeAction()
    {
        $message = $this->params()->fromQuery('message', 'Teste');

        return new ViewModel(['message' => $message]);
    }
}