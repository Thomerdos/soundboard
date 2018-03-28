<?php

namespace App\Controller;

use App\Entity\Sound;
use App\Form\SoundType;
use App\Repository\SoundRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sound")
 */
class SoundController extends Controller
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="sound_index")
     * @param SoundRepository $soundRepository
     * @return Response
     */
    public function index(SoundRepository $soundRepository): Response
    {

        return $this->render('sound/index.html.twig', ['sounds' => $soundRepository->findAll()]);
    }

    /**
     * @Route("/new", name="sound_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function new(Request $request): Response
    {
        $sound = new Sound();
        $form = $this->createForm(SoundType::class, $sound);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($sound);
            $this->em->flush();

            return $this->redirectToRoute('sound_index');
        }

        return $this->render('sound/new.html.twig', [
            'sound' => $sound,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sound_show", methods="GET")
     * @param Sound $sound
     * @return Response
     */
    public function show(Sound $sound): Response
    {
        return $this->render('sound/show.html.twig', ['sound' => $sound]);
    }

    /**
     * @Route("/{id}/edit", name="sound_edit", methods="GET|POST")
     * @param Request $request
     * @param Sound $sound
     * @return Response
     * @throws \LogicException
     */
    public function edit(Request $request, Sound $sound): Response
    {
        $form = $this->createForm(SoundType::class, $sound);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('sound_edit', ['id' => $sound->getId()]);
        }

        return $this->render('sound/edit.html.twig', [
            'sound' => $sound,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sound_delete", methods="DELETE")
     * @param Request $request
     * @param Sound $sound
     * @return Response
     */
    public function delete(Request $request, Sound $sound): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sound->getId(), $request->request->get('_token'))) {
            $this->em->remove($sound);
            $this->em->flush();
        }

        return $this->redirectToRoute('sound_index');
    }
}
