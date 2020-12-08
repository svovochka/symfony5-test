<?php

declare(strict_types = 1);

namespace App\Controller\Api;

use App\Entity\Author;
use App\Entity\Book;
use App\EntityMapper\BookMapper;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class BookController
 * @package App\Controller\Api
 */
class BookController extends AbstractController
{
    /**
     * Search books
     *
     * @Route("/book/search", methods={"GET"}, name="api_v1_book_search")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request): Response
    {
        $search = $request->get('search');
        $locale = $request->get('locale');
        if (empty($search)){
            //TODO here must be something like "return new BadRequestResponse"
            die('search param must be specified');
        }

        /** @var BookRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Book::class);
        $books = $repository->searchByTitle($search, $locale);

        return new JsonResponse(BookMapper::mapAllToArray($books, $locale));
    }

    /**
     * View book
     *
     * @Route(
     *     "/{_locale}/book/{id}",
     *     methods={"GET"},
     *     name="api_v1_book_view",
     *     locale="en",
     *     requirements={
     *         "_locale": "en|ru",
     *         "id": "\d+"
     *     }
     * )
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function view(Request $request, int $id): Response
    {
        /** @var Book|null $book */
        $book = $this
            ->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);
        if(!$book){
            //TODO here must be something like "return new NotFoundResponse"
            die('book not found');
        }

        return new JsonResponse(BookMapper::mapToArray($book, $request->getLocale()));
    }

    /**
     * Create book
     *
     * @Route("/book/create", methods={"POST"}, name="api_v1_book_create")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): Response
    {
        $requestBody = $request->toArray();

        //TODO Here must be strict input validation :)

        /** @var Author|null $author */
        $author = $this->getDoctrine()->getRepository(Author::class)->find($requestBody['author']['id']);
        if(!$author){
            //TODO here must be something like "return new UnprocessableEntityRequestResponse"
            die('author not found');
        }

        $book = new Book();

        $book->setAuthor($author);

        foreach($requestBody['translations'] as $translation){
            $book->translate($translation['locale'])->setTitle($translation['title']);
        }

        //TODO Move this to upper layer :)
        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $book->mergeNewTranslations();
        $em->flush();

        return new JsonResponse(BookMapper::mapToArray($book));
    }
}