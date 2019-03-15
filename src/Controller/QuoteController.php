<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Form\QuoteType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

use \DateTime;

/**
 * @Route("/quote", name="quote")
 * @IsGranted("ROLE_ADMIN")
 */
class QuoteController extends AbstractController
{
    /**
     * @Route("/new", name="_new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quote = new Quote();

        $quote->setCreator($this->getUser());
        $quote->setStatus(Quote::STATUS_PENDING);

        $quote->setDateCreated(new DateTime('now'));

        $editor = $this->createForm(QuoteType::class, $quote);

        $editor->handleRequest($request);

        if ($editor->isSubmitted() && $editor->isValid()) {
            /**
             * @todo Decide: use Facade service to abstract factorying, persistence
             * and flushing?
             *
             * For example:
             *
             *     $quoteFacade->new($quote);
             *
             * Would replace the following two lines. This is rather simple and perhaps
             * a no-brainer. If Quote becomes a QuoteDTO instead (see discussion in
             * App/Form/QuoteType::configureOptions), then the facade could be
             * responsible for calling a Factory to construct a DO from the DTO.
             *
             * Creator, status, and date created could also be abstracted through
             * the DTO.
             */

            $entityManager->persist($quote);
            $entityManager->flush();

            $this->addFlash('success', 'Your quote was successfully created');

            return $this->redirectToRoute('quote_new');
        }

        return $this->render('quote-new.html.twig', [
            'controller_name' => 'QuoteController',
            'form' => $editor->createView()
        ]);
    }
}
