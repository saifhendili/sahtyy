<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PostLike;
use App\Entity\Publication;
use App\Form\Publication2Type;
use App\Repository\PublicationRepository;
use App\Repository\PostLikeRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

/**
 * @Route("/publication")
 */
class PublicationController extends AbstractController
{
    /**
     * @Route("/", name="publication_index", methods={"GET"})
     */
    public function index(PublicationRepository $publicationRepository  ): Response
    {
        
        return $this->render('publication/index.html.twig', [
            'publications' => $publicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="publication_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publication = new Publication();
        $form = $this->createForm(Publication2Type::class, $publication);
        $form->handleRequest($request);
        $user = $this->getUser()->getId();
    
        if ($form->isSubmitted() && $form->isValid()) {
            $publication->setIdUser($user);
            $publication->setNomUser($this->getUser()->getNom());
            $publication->setPrenomUser($this->getUser()->getPrenom());
            $publication->setImg("https://i.imgur.com/gFaPbi6_d.webp?maxwidth=760&fidelity=grand");
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('publication_index');
        }

        return $this->render('publication/new.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publication_show", methods={"GET"})
     */
    public function show(Publication $publication): Response
    {
        return $this->render('publication/show.html.twig', [
            'publication' => $publication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="publication_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publication $publication): Response
    {
        $form = $this->createForm(Publication2Type::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publication_index');
        }

        return $this->render('publication/edit.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publication_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Publication $publication,PostLikeRepository $likeRepo): Response
    {

      
        if ($this->isCsrfTokenValid('delete'.$publication->getId(), $request->request->get('_token'))) {
            $mylikes=$likeRepo->findBy([
                'post'=>$publication,
                ]);
                $entityManager = $this->getDoctrine()->getManager();
                foreach ($mylikes as $likeee) {
                    $entityManager->remove($likeee);  
                   
                }
                $entityManager->flush(); 
                $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publication);
            $entityManager->flush();
        }
        
    
        return $this->redirectToRoute('publication_index');
    }
    
    /**
     * @Route("/{id}/like",name="publication_like")
     * 
     * @param PostLikeRepository $likeRepo
     * @param Publication $publication
     * @param \Symfony\Component\HttpFoundation\Response
     */
    public function like(Publication $publication, PostLikeRepository $likeRepo):
    Response{
        $user=$this->getUser();
if(!$user)return $this->json([
    'code'=>403,
    'message'=>"Unauthorized"
],403);
if($publication->isLikedByUser($user)){
    $like=$likeRepo->findOneBy([
        'post'=>$publication,
        'user'=>$user
    ]);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($like);
    $entityManager->flush();
    return $this->json([
        'code'=>200,
        'message'=> 'like bien supprimé',
        'likes'=>$likeRepo->count(['post'=>$publication])
    ],200);
}
$like =new PostLike();
$like->setPost($publication)
     ->setUser($user);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($like);
    $entityManager->flush();

return $this->json(['code'=>200,
'message'=>'like bien ajouté',
'likes'=>$likeRepo->count(['post'=>$publication])],200);
    }
}
