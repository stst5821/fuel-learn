<?php

class Controller_Users extends Controller_Template
{

	public function action_index()
	{
		$view = View::forge('users/index');
		$view->set('name', 'username');

		return $view;
	}
}
