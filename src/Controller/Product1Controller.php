<?php

namespace App\Controller;

use App\Entity\Product1;
use App\Form\Product1Type;
use App\Repository\Product1Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product1")
 */
class Product1Controller extends AbstractController
{
    /**
     * @Route("/", name="app_product1_index", methods={"GET"})
     */
    public function index(Product1Repository $product1Repository): Response
    {
        return $this->render('product1/index.html.twig', [
            'product1s' => $product1Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_product1_new", methods={"GET", "POST"})
     */
    public function new(Request $request, Product1Repository $product1Repository): Response
    {
        $product1 = new Product1();
        $form = $this->createForm(Product1Type::class, $product1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product1Repository->add($product1, true);

            return $this->redirectToRoute('app_product1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product1/new.html.twig', [
            'product1' => $product1,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/phepCong", name="app_product1_plus", methods={"GET", "POST"})
     */
    public function plus(Request $request):Response
    {
        $firstNum =  $request -> query->get('a');
        $secondNum =  $request -> query->get('b');
//        $result = $firstNum + $secondNum;
        $Name = $request->query->get('name');

        return new Response(
            '<html><body>Tong: '.($firstNum+$secondNum).' Hello '.($Name).'</body></html>'
//            $result
        );
    }
    /**
     * @Route("/{id}", name="app_product1_show", methods={"GET"})
     */
    public function show(Product1 $product1): Response
    {
        return $this->render('product1/show.html.twig', [
            'product1' => $product1,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_product1_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Product1 $product1, Product1Repository $product1Repository): Response
    {
        $form = $this->createForm(Product1Type::class, $product1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product1Repository->add($product1, true);

            return $this->redirectToRoute('app_product1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product1/edit.html.twig', [
            'product1' => $product1,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_product1_delete", methods={"POST"})
     */
    public function delete(Request $request, Product1 $product1, Product1Repository $product1Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product1->getId(), $request->request->get('_token'))) {
            $product1Repository->remove($product1, true);
        }

        return $this->redirectToRoute('app_product1_index', [], Response::HTTP_SEE_OTHER);
    }
}
