<?php

namespace AppBundle\Controller\Zenna;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\ProductRepository;
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

        # Récupération des 8 dernières nouveautés
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findLastProducts();
        # dump($products);

        # return new Response("<html><body><h1>PAGE D'ACCUEIL</h1></body></html>");
        return $this->render('zenna/index.html.twig', [
            'slides' => $slides,
            'products'  => $products
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

        # Récupération de la Catégorie
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['slug' => $category]);

        # Récupération des produits de la catégorie
        $products = $category->getProducts();
        # dump($category);
        # dump($products);

        # return new Response("<html><body><h1>Page Categorie : $category</h1></body></html>");
        return $this->render('zenna/category.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * Page permettant d'afficher un produit
     * @Route("/{category}/{slug}_{id}.html",
     *     name="zenna_product",
     *     requirements={"id"="\d+"} )
     * @param $id
     * @param $category
     * @param $slug
     * @param Product $product
     * @return Response
     */
    public function productAction($id, $category, $slug, Product $product)
    {

        # Récupération avec Doctrine
         /*$product = $this->getDoctrine()
             ->getRepository(Product::class)
             ->find($id);*/

        # Si aucun produit n'est trouvé...
        /*if (!$product) {
            # On génère une exception
            throw $this->createNotFoundException(
                'Nous n\'avons pas trouvé votre produit ID : '.$id
            );

            # Ou on peut aussi rediriger l'utilisateur sur la page index.
            # return $this->redirectToRoute('zenna_index',[],Response::HTTP_MOVED_PERMANENTLY);
        }*/
        
        # return new Response("<html><body><h1>Page Article : $category / $slug _ $id</h1></body></html>");
        return $this->render('zenna/product.html.twig', [
            'product' => $product
        ]);
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
     * @param string $title
     * @param array $links
     * @return Response
     */
    public function breadcrumbAction($title = "", $links = []) {
        return $this->render('components/_breadcrumb.html.twig', [
            'title' => $title,
            'links' => $links
        ]);
    }
}
