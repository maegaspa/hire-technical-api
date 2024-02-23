<?php
namespace App\Service;

use App\Entity\Project;

class ProjectManager
{
    public function createProject() :Project
    {
        //Set un ID en dur dans le code est une mauvaise pratique, le mieux serait que l'id s'autoincrémente à la création coté bdd
        // return new Project(); -> comme ceci
        $project = new Project();
        $project->setId(1);
        return $project;
    }
}