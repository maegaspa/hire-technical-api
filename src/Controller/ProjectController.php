<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Project;
use App\Service\ProjectManager;

class ProjectController extends AbstractController {

    private $projectManager;

    public function __construct(ProjectManager $projectManager)
    {
        $this->projectManager = $projectManager;
    }

    /**
     * @Route("/projects", methods={"POST"})
     */
    public function postProject(Request $request): JsonResponse
    {
        $project = $this->projectManager->createProject();
        $form = $this->createFormBuilder($project)
            ->add('name', TextType::class)
            ->add('slug', TextType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->json($project->serialize());
        }
        return $this->json(["error" => "An error occured"]);
    }
}
