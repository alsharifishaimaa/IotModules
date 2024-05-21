<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IotmoduleController extends AbstractController
{
    #[Route('/iotmodule', name: 'app_iotmodule')]
    public function index(): Response
    {
        return $this->render('iotmodule/iot_exploration.html.twig', [
            'controller_name' => 'IotmoduleController',
        ]);
    }
}
