<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use function Symfony\Component\String\replace;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\src\Service\SearchService;

/**
 * Class ApiItemController
 * @package App\Controller
 * @Route("/item")
 */
class ApiItemController extends AbstractController
{
	/**
	 * @var SearchService
	 */
	private $searchService;

	/**
	 * ApiItemController constructor.
	 *
	 * @param SearchService
	 */
	public function __construct(SearchService $searchService) {
		$this->searchService = $searchService;
	}


	/**
	 * @param AnnonceRepository $repo
	 *
	 * @return JsonResponse
	 *
	 * @Route(name="api_annonces_collection_get", methods={"GET"})
	 *
	 */
    public function collection(AnnonceRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll(), 200, [], ['groups' => 'get']);
    }

	/**
	 * @param AnnonceRepository $repo
	 * @param string $searchedModele
	 *
	 * @return JsonResponse
	 *
	 * @Route("/search/{searchedModele}", name="api_annonce_search_get", methods={"GET"})
	 *
	 */
	public function search(string $searchedModele, AnnonceRepository $repo): JsonResponse {
		$annonces = $repo->findAll();

//		Préparer la chaîne d'entrée ($searchedModele) avant recherche proprement dite
		$searchedModele = $this->searchService->prepareInput($searchedModele);

//      Correspondance du modèle cherché pré-nettoyé
		foreach ($annonces as $annonce) {
			$modeles['modele'] = $annonce->getModele();
			$modele = $this->searchService->prepareInput($annonce->getModele());
//			$search = " ";
//			$replace = "";
//			$removed_space = str_replace($search, $replace, $searchedModele);
//			$added_space = preg_replace('#([0-9]+)#', ' $1', $searchedModele);


			if ($modele === $searchedModele) {
				return $this->json($annonce, 200, [], ['groups' => 'search']);
			}
//todo en cours
			$pp = preg_match('#$modele#', $searchedModele, $matches);
			dd( $matches);
//			elseif (){
//
//				return $this->json($annonce, 200, [], ['groups' => 'search']);
//			}
// else {
//				$searchedModele = $this->searchService->subStringExtraction($searchedModele);
//
//				return $this->json('un effort !');
//				$this->searchService->cas($searchedModele, $modele
//				$annonce = $this->json($repo->findBy(['modele' => $modele]), 200, [], ['groups' => 'search']);
//				return $annonce;
//			} elseif (strpbrk($modele, $added_space)) {
//				$annonce = $this->json($repo->findBy(['modele' => $modele]), 200, [], ['groups' => 'search']);
//				return $annonce;
//			}

//			} else {
//				return $this->json('erreur');
//			}
		}



//		$tab[] = preg_grep("#$searchedModele#", $mod);
//		$result = $this->searchService
//			->longestString($tab);
//		dd( $result);




//
//			$annonce = $this->searchService->cas($searchedModele, $modele);
//
//			dd( $annonce);





//		foreach ($annonces as $id => $annonce) {

//
//			} else {
//				$annonce = $this->json( $repo->findBy( [ 'modele' => $modele ] ), 200, [], [ 'groups' => 'search' ] );
//
//				return $annonce;
//
//			}
//		}

//		$annonce = $this->json($repo->find($id), 200, [], ['groups' => 'search']);
//		return $annonce;

//		return $annonces = $this->json($repo->findAll(), 200, [], ['groups' => 'search']);
////

//		renvoyer Json
//		json_encode ne sait pas prendre les données privées. Ca marche avec tableaux associatifs.
//		!! SERIALISATION:
//		- NORMALISATION : transformation d'Objects en Tab assoc simples (avec NormalizerInterface). Mais référence circulaire, donc taguer
//		avec les Groups. Pour pouvoir ensuite faire du:
//      - ENCODAGE : transformation de Tab assoc simples en texte (Json notamment) -> json_encode.
//      => le SERIALIZER de Sf fait tout cela:
	//		$json = $serializer->serialize($annonces, 'json', ['groups' => 'search']);
	//		$response = new JsonResponse($json, 200, [], true);
//		=> Réunir ces deux phrases grâce à l'AbstractController -> créer réponse au format Json facilement:
//
//

	}

	/**
	 * @Route("/{id}", name="api_annonce_get", methods={"GET"})
	 *
	 */
	public function getItem(int $id, AnnonceRepository $repo): JsonResponse
	{

		return $this->json($repo->find($id), 200, [], ['groups' => 'get']);

    }

	/**
	 * @param Request $request
	 * @param SerializerInterface $serializer
	 * @param EntityManagerInterface $em
	 * @param CategorieRepository $repo
	 * @param ValidatorInterface $validator
	 *
	 * @return JsonResponse
	 *
	 * @Route(name="api_annonces_collection_post", methods={"POST"})
	 */
    public function postItem(Request $request, SerializerInterface $serializer, EntityManagerInterface $em,
	    CategorieRepository $repo, ValidatorInterface $validator, UrlGeneratorInterface $generator): JsonResponse
    {
//    	 Boileau API Sf 5.1 à 1h43 création d'un ParamConvertor custom
//	    https://www.youtube.com/watch?v=UXhE9tqwbsI
        $jsonData = $request->getContent();

        try {
	        $annonce = $serializer->deserialize($jsonData, Annonce::class, 'json');

	        $categorieNom = $annonce->getCategorie()->getNom();
	        $cat = $repo->findOneBy(['nom' => $categorieNom]);

	        $annonce->setCategorie($cat);

	        $errors = $validator->validate( $annonce);

	        if (count($errors) > 0) {
	        	return $this->json($errors, 400);
	        }

	        $em->persist($annonce);
	        $em->flush();

	        return $this->json(
	        	$annonce,
		        201,
		        ["location" => $generator->generate("api_annonce_get", ["id"=> $annonce->getId()])],
		        ['groups' => 'get']
	        );
        } catch (NotEncodableValueException $e) {
        	return $this->json([
        		'status' => 400,
		        'message' => $e->getMessage()
	        ], 400);
        }

    }

	/**
	 * @param Annonce $annonce
	 * @param Request $request
	 * @param SerializerInterface $serializer
	 * @param EntityManagerInterface $em
	 *
	 * @return JsonResponse
	 *
	 * @Route("/{id}", name="api_annonce_put", methods={"PUT"})
	 *
	 */
	public function updateItem(Annonce $annonce, Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse {

		$jsonData = $request->getContent();
		$serializer->deserialize($jsonData, Annonce::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $annonce]);

		$em->flush();

		return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT,);
	}

	/**
	 * @param Annonce $annonce
	 * @param EntityManagerInterface $em
	 *
	 * @return JsonResponse
	 *
	 * @Route("/{id}", name="api_annonce_delete", methods={"DELETE"})
	 *
	 */
	public function deleteItem(Annonce $annonce, EntityManagerInterface $em): JsonResponse {

		$em->remove($annonce);
		$em->flush();

		return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT,);
	}

}
