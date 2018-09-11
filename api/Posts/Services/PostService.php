<?php 
namespace Api\Posts\Services;

use Api\Posts\Repositories\PostRepository;

class PostService
{
	private $postRepository;

	public function __construct(PostRepository $postRepository)
	{
		$this->postRepository = $postRepository;
	}
	public function getPosts()
	{
		try {
			$result = $this->postRepository->getAllPosts();
		} catch (\Exception $e) {
			throw $e;
		}

		return $result;
	}

	public function createPost($data)
	{
		try {
			$post = $this->postRepository->CreatePost($data);
		} catch (\Exception $e) {
			throw $e;
		}
		
		return $post;
	}

	public function showPost($data)
	{
		try {
			$post = $this->postRepository->showPost($data);
		} catch (\Exception $e) {
			throw $e;
		}

		return $post;
	}
	public function updatePost($data)
	{
		try {
			$post = $this->postRepository->updatePost($data);
		} catch (\Exception $e) {
			throw $e;
		}

		return $post;
	}
	public function destroyPost($data)
	{
		try {
			$this->postRepository->deletePost($data);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}