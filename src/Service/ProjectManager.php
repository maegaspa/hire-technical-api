<?php
namespace App\Service;

use App\Entity\Project;

class ProjectManager
{
    public function createProject() :Project
    {
        $project = new Project();
        $project->setId(1);
        return $project;
    }
}