<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\AdminLoginForm;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

final class AdminLoginController extends AbstractController
{
    public function __construct(private AuthenticationUtils $authenticationUtils) {}

     #[Route("/admin/login", name: "admin_login")]
    public function loginAction(): Response
    {
        $form = $this->createForm(AdminLoginForm::class, [
            'email' => $this->authenticationUtils->getLastUsername()
        ]);

        return $this->render('security/login.html.twig', [
            'last_username' => $this->authenticationUtils->getLastUsername(),
            'form' => $form->createView(),
            'error' => $this->authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route("/admin/logout", name: "admin_logout")]
    public function logoutAction(): void
    {
        // Left empty intentionally because this will be handled by Symfony.
    }
}