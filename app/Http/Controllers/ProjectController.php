<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FormController;
use App\Repositories\ProjectRepository;
class ProjectController extends FormController
{
 
     public function __construct(ProjectRepository $project)
     {
          $this->controller = 'project';
          $this->container = $project;
          parent::__construct();
     }
}