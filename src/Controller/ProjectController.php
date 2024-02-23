<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface;

use App\Entity\Project;
use App\Service\ProjectManager;
use App\Form\ProjectType;

class ProjectController extends AbstractController
{
    private $projectManager;
    private $serializer;

    public function __construct(ProjectManager $projectManager, SerializerInterface $serializer)
    {
        $this->projectManager = $projectManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/projects", methods={"POST"})
     */
    public function postProject(Request $request): JsonResponse
    {
        $project = $this->projectManager->createProject();
        $form = $this->formFactory->create(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $this->serializer->serialize($project, 'json', ['groups' => 'project']);
            return new JsonResponse($data, 200, [], true);
        }

        return $this->json(["error" => "An error occurred"]);
    }
}
