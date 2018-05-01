<?php

namespace AppBundle\Controller\Zenna;

use AppBundle\Slider\Slider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ZennaController extends Controller
{

    /**
     * Page d'Accueil du Site
     * @param Slider $slider
     * @return Response
     */
    public function indexAction(Slider $slider)
    {

        # Récupération des Slides
        $slides = $slider->getSlides();
        # dump($slides);

        # return new Response("<html><body><h1>PAGE D'ACCUEIL</h1></body></html>");
        return $this->render('zenna/index.html.twig', [
            'slides' => $slides
        ]);
    }

    /**
     * Page permettant d'afficher les produits d'une catégorie
     * @Route("/categorie/{category}",
     *     name="zenna_category",
     *     methods={"GET"})
     * @param $category
     * @return Response
     */
    public function categoryAction($category)
    {
        # return new Response("<html><body><h1>Page Categorie : $category</h1></body></html>");
        return $this->render('zenna/category.html.twig');
    }

    /**
     * Page permettant d'afficher un produit
     * @Route("/{category}/{slug}_{id}.html",
     *     name="zenna_product",
     *     requirements={"id"="\d+"} )
     */
    public function productAction($id, $category, $slug)
    {
        # return new Response("<html><body><h1>Page Article : $category / $slug _ $id</h1></body></html>");
        return $this->render('zenna/product.html.twig');
    }

    /**
     * Page permettant d'afficher le Panier
     * @Route("/mon-panier.html",
     *     name="zenna_cart")
     */
    public function cartAction()
    {
        # return new Response("<html><body><h1>Page Panier</h1></body></html>");
        return $this->render('zenna/cart.html.twig');
    }

    /**
     * Permet l'affichage d'un Fil d'Ariane sur le site
     * @return Response
     */
    public function breadcrumbAction($title = "", $links = []) {
        return $this->render('components/_breadcrumb.html.twig', [
            'title' => $title,
            'links' => $links
        ]);
    }
}
