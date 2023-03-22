<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Buildings;
use App\Repository\BuildingsRepository;
use App\Repository\PiecesRepository;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }

    #[Route('api/buildings',name:'list_buildings',methods:['GET'])]
    public function getBuildings(BuildingsRepository $buildings,SerializerInterface $serializer): JsonResponse
    {
        // Récupérer tous les bâtiments de la base de données
        $buildingsList = $buildings->findAll();
        // Convertir la liste en JSON
        $jsonbuildingsList = $serializer->serialize($buildingsList, 'json',['groups' => ['normal']]);
        // Retourner la liste en JSON
        return new JsonResponse($jsonbuildingsList, Response::HTTP_OK, [], true);
    }

    #[Route('api/buildings/{id}/pieces',name:'pieces_buildings',methods:['GET'])]
    public function getBuildingsPieces(int $id,PiecesRepository $pieces,BuildingsRepository $buildings,SerializerInterface $serializer): JsonResponse
    {
        // Récupérer le bâtiment avec l'ID donné
        $building = $buildings->find($id);
        if (!$building) {
            // Si le bâtiment n'existe pas, retourner une erreur 404
            return new JsonResponse(['error' => 'Building not found'], Response::HTTP_NOT_FOUND);
        }
        // Récupérer toutes les pièces du bâtiment
        $pieces = $building->getPieces();
        // Convertir la liste en JSON
        $jsonpiecesList = $serializer->serialize($pieces, 'json',['groups' => ['normal']]);
        // Retourner la liste en JSON
        return new JsonResponse($jsonpiecesList, Response::HTTP_OK, [], true);
    }

    #[Route('api/buildings/presonnes_presentes?piece={pieceId}&building={buildingId}',name:'personnes_presentes',methods:['GET'])]
    public function getTotalPersonnes(Request $request, PiecesRepository $pieces, BuildingsRepository $buildings, SerializerInterface $serializer): JsonResponse
   {
        // Récupérer les paramètres de l'URL
        $buildingId = $request->query->get('buildingId');
        $pieceId = $request->query->get('pieceId');

        // Récupérer le bâtiment avec l'ID donné
        $building = $buildings->find($buildingId);
        if (!$building) {
            // Si le bâtiment n'existe pas, retourner une erreur 404
            return new JsonResponse(['error' => 'Building not found'], Response::HTTP_NOT_FOUND);
        }

        // Si l'ID de la pièce est donné, récupérer seulement cette pièce
        // Sinon, récupérer toutes les pièces du bâtiment
        if ($pieceId) {
            $piecesList = $pieces->findBy(['building' => $building->getIdBuildings(), 'id' => $pieceId]);
        } else {
            $piecesList = $building->getPieces();
        }

        // Calculer le nombre total de personnes dans toutes les pièces sélectionnées
       
        $totalPeople = 0;
        foreach ($piecesList as $piece) {
            $totalPeople += count($piece->getPersonnesPresentes());
        }

        $jsonData = $serializer->serialize([
            'building' => $building->getId(),
            'pieces' => $piecesList,
            'totalPeople' => $totalPeople,
        ], 'json', ['groups' => ['normal']]);

              // Retourner la liste en JSON
        return new JsonResponse($jsonData, Response::HTTP_OK, [], true);
  }

}
