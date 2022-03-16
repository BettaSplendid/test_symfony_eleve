<?php

namespace App\Controller;

use App\Entity\Study;
use App\Form\StudyType;
use App\Repository\StudyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/study')]
class StudyController extends AbstractController
{
    #[Route('/', name: 'app_study_index', methods: ['GET'])]
    public function index(StudyRepository $studyRepository): Response
    {
        return $this->render('study/index.html.twig', [
            'studies' => $studyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_study_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StudyRepository $studyRepository): Response
    {
        $study = new Study();
        $form = $this->createForm(StudyType::class, $study);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studyRepository->add($study);
            return $this->redirectToRoute('app_study_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('study/new.html.twig', [
            'study' => $study,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_study_show', methods: ['GET'])]
    public function show(Study $study): Response
    {
        return $this->render('study/show.html.twig', [
            'study' => $study,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_study_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Study $study, StudyRepository $studyRepository): Response
    {
        $form = $this->createForm(StudyType::class, $study);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studyRepository->add($study);
            return $this->redirectToRoute('app_study_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('study/edit.html.twig', [
            'study' => $study,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_study_delete', methods: ['POST'])]
    public function delete(Request $request, Study $study, StudyRepository $studyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$study->getId(), $request->request->get('_token'))) {
            $studyRepository->remove($study);
        }

        return $this->redirectToRoute('app_study_index', [], Response::HTTP_SEE_OTHER);
    }
}
