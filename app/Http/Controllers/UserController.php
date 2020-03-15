<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{
	private $userRepository, $request;
	
	/**
	 * UserController constructor.
	 *
	 * @param \App\Repositories\UserRepository $userRepository
	 * @param \Illuminate\Http\Request $request
	 */
	public function __construct(
		UserRepository $userRepository,
		Request $request
	) {
		$this->userRepository = $userRepository;
		$this->request = $request;
	}
	
	/**
	 * index
	 * Listagem dos usuários
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 00:17
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$users = $this->userRepository
			->orderBy('id', 'DESC')
			->paginate(15);
		
		return view('users.index')
			->with(compact([
				'users',
			]));
	}
	
	/**
	 * create
	 * Página de criação de usuários
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 00:17
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return view('users.create');
	}
	
	/**
	 * store
	 * Cria um novo usuário
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 00:23
	 *
	 * @param \App\Http\Requests\CreateUserRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CreateUserRequest $request)
	{
		$this->userRepository
			->create($this->values($request, 'store'));
		
		flash(trans('system.text.store_user_success'))->success();
		
		return redirect()->route('users.index');
	}
	
	/**
	 * edit
	 * Página para editar um usuário
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 00:31
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function edit($id)
	{
		try {
			$user = $this->userRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_user'))
				->error()
				->important();
			return redirect()->route('users.index');
		}
		return view('users.edit')
			->with(compact([
				'user',
			]));
	}
	
	/**
	 * update
	 * Atualiza um usuário
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 00:35
	 *
	 * @param \App\Http\Requests\UpdateUserRequest $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdateUserRequest $request, $id)
	{
		try {
			$user = $this->userRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_user'))
				->error()
				->important();
			return redirect()->route('users.index');
		}
		$this->userRepository
			->updateById($user->id, $this->values($request, 'update'));
		
		flash(trans('system.text.update_user_success'))
			->success()
			->important();
		
		return redirect()->route('users.index');
	}
	
	/**
	 * destroy
	 * Remove um usuário
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 00:33
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		try {
			$user = $this->userRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_user'))
				->error()
				->important();
			return redirect()->route('users.index');
		}
		$this->userRepository
			->deleteById($user->id);
		
		flash(trans('system.text.destroy_user_success'))
			->success()
			->important();
		
		return redirect()->route('users.index');
	}
	
	/**
	 * values
	 * Valores para criar e editar um usuário
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 00:18
	 *
	 * @param $request
	 * @param $type
	 *
	 * @return array
	 */
	private function values($request, $type)
	{
		$values = [
			'name'  => $request->input('name'),
			'email' => $request->input('email'),
		];
		if ($type == 'store' || !is_null($request->input('password'))) {
			$values['password'] = bcrypt($request->input('password'));
			$values['password_confirmation'] = bcrypt($request->input('password_confirmation'));
		}
		return $values;
	}
}
