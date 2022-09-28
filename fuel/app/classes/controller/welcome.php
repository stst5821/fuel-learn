<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{
	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		// 配列に入れてviewに送るパターン
		$data = array();
		$data['name'] = 'name';
		$data['body'] = 'body';

		return Response::forge(View::forge('welcome/index',$data));
	}

	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		// オブジェクトを生成して受けたわすパターン
		$view = View::forge('welcome/hello');
		$view->set('name', 'hello名前');
		$view->set('title', 'helloタイトル');
		$view->set('body', '内容です。');

		return $view;
	}
	
	public function action_test()
	{
		// ORMを使ったパターン

		// $q['rows'] =  Model_Post::find('first', array(
		// 	'where' => array(
		// 			array('id', 1),
		// 	),
		// ));

		// var_dump($q);
		// Debug::dump($q);

		// return Response::forge(View::forge('welcome/test',$q));
		// // return View::forege('welcome/test',$q);

		// クエリビルダを使ったパターン
		$q = DB::select()->from('posts')->where('id', 1);
		$view = $q->execute()->as_array();

		foreach($view as $value){
			$post['id'] = $value['id'];
			$post['title'] = $value['title'];
			$post['created_at'] = $value['created_at'];
			$post['updated_at'] = $value['updated_at'];
		}

		return Response::forge(View::forge('welcome/test',$post));
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}
}
