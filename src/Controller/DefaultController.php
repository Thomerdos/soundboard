<?php

namespace App\Controller;

use App\Repository\SoundRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index()
    {

        return $this->redirectToRoute('sound_index');
    }
}
