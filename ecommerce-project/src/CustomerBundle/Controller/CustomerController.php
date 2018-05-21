<?php

namespace CustomerBundle\Controller;

use CustomerBundle\Entity\Customer;
use CustomerBundle\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CustomerController extends Controller
{
    /**
     * Formulaire pour inscrire un utilisateur
     * @Route("/inscription.html", name="customer_register", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        # Création d'un Nouveau Client
        $customer = new Customer();
        $customer->addRole('ROLE_CUSTOMER');

        # Création du Formulaire
        $form = $this->createForm(RegisterType::class, $customer);

        /*$form = $this->createFormBuilder($customer)
            # Champ prenom
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Saisissez votre Prénom'
                ]
            ])
            # Champ nom
            ->add('fullname', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Saisissez votre Nom'
                ]
            ])
            # Champ email
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Saisissez votre Email'
                ]
            ])
            # Champ mot de passe
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => '*******'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'M\'inscrire !'
            ])
            ->getForm();*/

        # Traitement des données POST
        $form->handleRequest($request);

        # Vérification des données du Formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            # Récupération de l'Encoder
            $passwordEncoder = $this->get('security.password_encoder');;

            # Encodage du Mot de Passe
            $password = $passwordEncoder->encodePassword($customer, $customer->getPassword());

            # Attribution du mot de passe encodé à l'utilisateur
            $customer->setPassword($password);

            # Insertion en BDD (Data Mapper Pattern)
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            # Redirection sur la page connexion
            return $this->redirect('connexion?inscription=success');
        }


        # Affichage du Formulaire dans la Vue
        return $this->render('@Customer/customer/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Connexion d'un utilisateur
     * @Route("/connexion.html", name="customer_login")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {

        # Récupération du Service
        $authenticationUtils = $this->get('security.authentication_utils');

        # Récupération du message d'erreur s'il y en a un.
        $error = $authenticationUtils->getLastAuthenticationError();

        # Dernier email saisie par l'utilisateur.
        $lastEmail = $authenticationUtils->getLastUsername();

        # Affichage du Formulaire
        return $this->render('@Customer/customer/login.html.twig', array(
            'last_email' => $lastEmail,
            'error' => $error,
        ));
    }

}
