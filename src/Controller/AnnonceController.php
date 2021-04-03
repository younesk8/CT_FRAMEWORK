<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class annonceSiteController
 * @package App\Controller
 *
 * @Route(path="/annonce")
 */
class AnnonceController
{
    private $annonceRepository;

    public function __construct(AnnonceRepository $annonceRepository)
    {
        $this->annonceRepository = $annonceRepository;
    }

    /**
     * @Route("/add", name="add_annonce", methods={"POST"})
     */
    public function addAnnonce(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $category = $data['category'];

        if (empty($name) || empty($description) || empty($price) || empty($category)  ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->annonceRepository->saveAnnonce($name, $description, $price, $category);

        return new JsonResponse(['status' => 'annonce added!'], Response::HTTP_CREATED);
    }

    /**
 * @Route("/annonces/{id}", name="get_one_annonce", methods={"GET"})
 */
public function get($id): JsonResponse
{
    $annonce = $this->annonceRepository->findOneBy(['id' => $id]);

    $data = [
        'id' => $annonce->getId(),
        'name' => $annonce->getName(),
        'description' => $annonce->getDescription(),
        'price' => $annonce->getPrice(),
        'category' => $annonce->getCategory(),
    ];

    return new JsonResponse($data, Response::HTTP_OK);
}

/**
 * @Route("/annonces", name="get_all_annonces", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $annonces = $this->annonceRepository->findAll();
    $data = [];

    foreach ($annonces as $annonce) {
        $data[] = [
            'id' => $annonce->getId(),
            'name' => $annonce->getName(),
            'description' => $annonce->getDescription(),
            'price' => $annonce->getPrice(),
            'category' => $annonce->getCategory()->getName(),
            'auteur' => $annonce->getUser()->getNom(),
        ];
    }

    return new JsonResponse($data, Response::HTTP_OK);
}
   /**
 * @Route("/update/{id}", name="update_annonce", methods={"PUT"})
 */
public function update($id, Request $request): JsonResponse
{
    $annonce = $this->annonceRepository->findOneBy(['id' => $id]);
    $data = json_decode($request->getContent(), true);

    // empty($data['name']) ? true : $annonce->setName($data['name']);
    // empty($data['description']) ? true : $annonce->setDescription($data['description']);
    // empty($data['price']) ? true : $annonce->setPrice($data['price']);

    $updatedAnnonce = $this->annonceRepository->updateAnnonce($annonce, $data);

    return new JsonResponse(['status' => 'annonce updated!']);
}

   /**
     * @Route("/delete/{id}", name="delete_annonce", methods={"DELETE"})
     */
    public function deleteAnnonce($id): JsonResponse
    {
        $annonce = $this->annonceRepository->findOneBy(['id' => $id]);

        $this->annonceRepository->removeAnnonce($annonce);

        return new JsonResponse(['status' => 'annonce deleted']);
    }

      /**
     * @Route("/annoncebycategory/{id}", name="annoncebycategory", methods={"GET"})
     */
    public function getAllAnnonceByCategory($id): JsonResponse
    {
        $annonces = $this->annonceRepository->findAll();
        $data = [];
    
        foreach ($annonces as $annonce) {
            if($annonce->getCategory()->getId() == $id){
                $data[] = [
                    'id' => $annonce->getId(),
                    'name' => $annonce->getName(),
                    'description' => $annonce->getDescription(),
                    'price' => $annonce->getPrice(),
                    'category' => $annonce->getCategory()->getName(),
                    'auteur' => $annonce->getUser()->getNom(),
                ];
            }
           
        }
    
        return new JsonResponse($data, Response::HTTP_OK);

    }

}
