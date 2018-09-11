<?php 
namespace Api\Posts\Controllers;

use Api\Posts\Services\PostService;
use Api\Posts\Transformers\AllPostsTransformer;
use Api\Posts\Requests\StoreRequest;
use Api\Posts\Requests\ShowRequest;
use Api\Posts\Requests\UpdateRequest;
use Validator;
use Api\BaseController;
use Illuminate\Http\Request;

class PostController extends BaseController
{
	private $postService;

	public function __construct(PostService $postService)
	{
		$this->postService = $postService;
	}
	public function index()
	{

		try {
			$posts = $this->postService->getPosts();
			$response = $this->response()->collection($posts, new AllPostsTransformer);

		} catch (\Exception $e) {
			throw new \Symfony\Component\HttpKernel\Exception\HttpException(config('http_status_codes.SERVER_ERROR.INTERNAL_SERVER_ERROR'));
		}
		return $response;
	}
	public function store(StoreRequest $request)
	{
		$data = $request->only('image','body','title');
		
		try {
			$post = $this->postService->createPost($data);
			$response = $this->response()->item($post, new AllPostsTransformer)->setStatusCode(config('http_status_codes.SUCCESSFUL.OK'));
		} catch (\Exception $e) {
			throw new \Symfony\Component\HttpKernel\Exception\HttpException(config('http_status_codes.SERVER_ERROR.INTERNAL_SERVER_ERROR'));
		}
		return $response;
	}
	public function show($id)
	{
		$data = [
			'id' => $id,
		];
		$validator =  Validator::make($data,[
			'id' => 'bail|required|numeric|exists:posts,id'
		]);
		if ($validator->fails()) {
			throw new \Api\Exception\UnprocessableEntityHttpException(api_trans('posts.010301'), $validator->errors());
		}
		try {
			$post = $this->postService->showPost($data);
			$response = $this->response()->item($post, new AllPostsTransformer)->setStatusCode(config('http_status_codes.SUCCESSFUL.OK'));
		} catch (\Exception $e) {
			throw new \Symfony\Component\HttpKernel\Exception\HttpException(config('http_status_codes.SERVER_ERROR.INTERNAL_SERVER_ERROR'));
		}
		return $response;
	}
	public function update(UpdateRequest $request, $id)
	{
		try {
			$data = $request->only('title', 'body', 'image');
			$data['id'] = $id;

			$post = $this->postService->updatePost($data);
			$response = $this->response()->item($post, new AllPostsTransformer)->setStatusCode(config('http_status_codes.SUCCESSFUL.OK'));
		} catch (\Exception $e) {
			throw new \Symfony\Component\HttpKernel\Exception\HttpException(config('http_status_codes.SERVER_ERROR.INTERNAL_SERVER_ERROR'));
		}

		return $response;
	}

	public function destroy($id)
	{
		$data = [
			'id' => $id,
		];
		$validator =  Validator::make($data,[
			'id' => 'bail|required|numeric|exists:posts,id'
		]);
		if ($validator->fails()) {
			throw new \Api\Exception\UnprocessableEntityHttpException(api_trans('posts.010301'), $validator->errors());
		}

		try {
			$this->postService->destroyPost($data);
		} catch (\Exception $e) {
			throw new \Symfony\Component\HttpKernel\Exception\HttpException(config('http_status_codes.SERVER_ERROR.INTERNAL_SERVER_ERROR'));
		}

		return $this->response->noContent();
;
	}
}
