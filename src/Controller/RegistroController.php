<?php

namespace App\Controller;

use App\Entity\Registro;
use App\Form\RegistroType;
use App\Repository\RegistroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/registro")
 */
class RegistroController extends AbstractController
{
    /**
     * @Route("/", name="registro_index", methods={"GET"})
     */
    public function index(RegistroRepository $registroRepository): Response
    {
        return $this->render('registro/index.html.twig', [
            'registros' => $registroRepository->findByActivo(true),
        ]);
    }

    /**
     * @Route("/new", name="registro_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,\Swift_Mailer $mailer): Response
    {
        $registro = new Registro();
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($registro);
            $entityManager->flush();

            // Mail
            $message = (new \Swift_Message('Centro de Ciencias Matemáticas - Acuse de recibo'))
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($registro->getEmail() ))
                //->setTo('gerardo@matmor.unam.mx')
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('mails/confirmacion.txt.twig', array('registro' => $registro)));

            ;
            $mailer->send($message);

           // return $this->redirectToRoute('registro_index', [], Response::HTTP_SEE_OTHER);
            return $this->render('registro/confirmacion.html.twig', [
                'registro' => $registro,
            ]);
        }

        return $this->renderForm('registro/new.html.twig', [
            'registro' => $registro,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{slug}", name="registro_show", methods={"GET"})
     */
    public function show(Registro $registro): Response
    {
        return $this->render('registro/show.html.twig', [
            'registro' => $registro,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="registro_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Registro $registro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('registro_index', [], Response::HTTP_SEE_OTHER);
        }
        $template = $request->isXmlHttpRequest() ? '_form.html.twig' : 'edit.html.twig';


        return $this->render('registro/' . $template, [
            'registro' => $registro,
            'form' => $form->createView(),
        ]);

/*        return $this->renderForm('registro/edit.html.twig', [
            'registro' => $registro,
            'form' => $form,
        ]);*/
    }

    /**
     * @Route("/{id}", name="registro_delete", methods={"POST"})
     */
    public function delete(Request $request, Registro $registro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$registro->getId(), $request->request->get('_token'))) {
            $entityManager->remove($registro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('registro_index', [], Response::HTTP_SEE_OTHER);
    }
}
