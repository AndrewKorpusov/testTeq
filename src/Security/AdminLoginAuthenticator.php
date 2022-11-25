<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

final class AdminLoginAuthenticator extends AbstractLoginFormAuthenticator implements AuthenticatorInterface
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function authenticate(Request $request)
   {
       $loginForm = $request->get('admin_login_form');

       if ($loginForm) {
           $email = $loginForm['email'];
           $plainPassword = $loginForm['password'];
           return new Passport(new UserBadge($email), new PasswordCredentials($plainPassword));
       }
   }

   protected function getLoginUrl(Request $request): string
   {
       return $this->router->generate('admin_login');
   }

   public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
   {
       return new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
   }
}