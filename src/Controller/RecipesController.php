<?php

namespace App\Controller;
#use Cake\Controller\Controller;

class RecipesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function index()
	{
		$recipes = $this->Recipes->find('all');
		$this->set([
		'recipes' => $recipes,
		'_serialize' => ['recipes']
		]);
		//$this->render('custom');
	}
	public function view($id)
	{
		$recipe = $this->Recipes->get($id);
		$this->set([
		'recipe' => $recipe,
		'_serialize' => ['recipe']
		]);
	}
	public function add()
	{
		$recipe = $this->Recipes->newEntity($this->request->getData());
		if ($this->Recipes->save($recipe)) {
		$message = 'Saved';
		} else {
		$message = 'Error';
		}
		$this->set([
		'message' => $message,
		'recipe' => $recipe,
		'_serialize' => ['message', 'recipe']
		]);
	}
	public function edit($id)
	{
		$recipe = $this->Recipes->get($id);
		if ($this->request->is(['post', 'put'])) {
		$recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
		if ($this->Recipes->save($recipe)) {
		$message = 'Saved';
		} else {
		$message = 'Error';
		}
		}
		$this->set([
		'message' => $message,
		'_serialize' => ['message']
		]);
	}
	public function delete($id)
	{
		$recipe = $this->Recipes->get($id);
		$message = 'Deleted';
		if (!$this->Recipes->delete($recipe)) {
		$message = 'Error';
		}
		$this->set([
		'message' => $message,
		'_serialize' => ['message']
		]);
	}



}