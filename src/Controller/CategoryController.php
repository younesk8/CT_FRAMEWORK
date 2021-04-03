<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class annonceSiteController
 * @package App\Controller
 *
 * @Route(path="/category")
 */
class CategoryController
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/add", name="add_category", methods={"POST"})
     */
    public function addCategory(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];

        if (empty($name) ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->categoryRepository->saveCategory($name);

        return new JsonResponse(['status' => 'Category added!'], Response::HTTP_CREATED);
    }


/**
 * @Route("/categories", name="get_all_categories", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $categories = $this->categoryRepository->findAll();
    $data = [];

    foreach ($categories as $category) {
        $data[] = [
            'id' => $category->getId(),
            'name' => $category->getName(),
        ];
    }

    return new JsonResponse($data, Response::HTTP_OK);
}

}
