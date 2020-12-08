<?php

declare(strict_types = 1);

namespace App\Controller\Api;

use App\Entity\Author;
use App\EntityMapper\AuthorMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AuthorController
 * @package App\Controller\Api
 */
class AuthorController extends AbstractController
{
    /**
     * Create author
     *
     * @Route("/author/create", methods={"POST"}, name="api_v1_author_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        $requestBody = $request->toArray();

        //TODO Here must be strict input validation :)

        $author = new Author();
        foreach($requestBody['translations'] as $translation){
            $author->translate($translation['locale'])->setName($translation['name']);
        }

        //TODO Move this to upper layer :)
        $em = $this->getDoctrine()->getManager();
        $em->persist($author);
        $author->mergeNewTranslations();
        $em->flush();

        return new JsonResponse(AuthorMapper::mapToArray($author));
    }
}