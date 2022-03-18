<?php

namespace App\Controller;

use App\Entity\BrochureTesto;
use App\Form\BrochureTestoType;
use App\Repository\BrochureTestoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;



#[Route('/brochure/testo')]
class BrochureTestoController extends AbstractController
{
    #[Route('/', name: 'app_brochure_testo_index', methods: ['GET'])]
    public function index(BrochureTestoRepository $brochureTestoRepository): Response
    {
        return $this->render('brochure_testo/index.html.twig', [
            'brochure_testos' => $brochureTestoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_brochure_testo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BrochureTestoRepository $brochureTestoRepository, SluggerInterface $slugger): Response
    {
        $brochureTesto = new BrochureTesto();
        $form = $this->createForm(BrochureTestoType::class, $brochureTesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                
                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                if(empty($newFilename))
                    $newFilename = "empty name";

                $brochureTesto->setBrochureFilename($newFilename);
                $brochureTestoRepository->add($brochureTesto);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
            }

            // return $this->redirectToRoute('app_product_list');
            return $this->redirectToRoute('app_brochure_testo_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('brochure_testo/new.html.twig', [
            'brochure_testo' => $brochureTesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_brochure_testo_show', methods: ['GET'])]
    public function show(BrochureTesto $brochureTesto): Response
    {
        return $this->render('brochure_testo/show.html.twig', [
            'brochure_testo' => $brochureTesto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_brochure_testo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BrochureTesto $brochureTesto, BrochureTestoRepository $brochureTestoRepository): Response
    {
        $form = $this->createForm(BrochureTestoType::class, $brochureTesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureTestoRepository->add($brochureTesto);
            return $this->redirectToRoute('app_brochure_testo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('brochure_testo/edit.html.twig', [
            'brochure_testo' => $brochureTesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_brochure_testo_delete', methods: ['POST'])]
    public function delete(Request $request, BrochureTesto $brochureTesto, BrochureTestoRepository $brochureTestoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $brochureTesto->getId(), $request->request->get('_token'))) {
            $brochureTestoRepository->remove($brochureTesto);
        }

        return $this->redirectToRoute('app_brochure_testo_index', [], Response::HTTP_SEE_OTHER);
    }
}
