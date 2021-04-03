<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class annonceSiteController
 * @package App\Controller
 *
 * @Route(path="/user")
 */
class UserController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/add", name="add_User", methods={"POST"})
     */
    public function addUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nom = $data['nom'];
        $password = $data['password'];

        if (empty($nom) ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->userRepository->saveUser($nom, $password );

        return new JsonResponse(['status' => 'User added!'], Response::HTTP_CREATED);
    }

 /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nom = $data['nom'];
        $password = $data['password'];

        if (empty($nom) ||empty($password)  ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->userRepository->loginUser($nom, $password );

        return new JsonResponse(['connected' => 'oui'], Response::HTTP_CREATED);
    }
}
