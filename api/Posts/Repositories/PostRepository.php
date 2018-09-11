<?php 
namespace Api\Posts\Repositories;
use Api\Posts\Models\Post;
class PostRepository
{
	public function getModel()
	{
		return new Post;
	}
	public function getAllPosts()
	{
		try {
			$postModel = $this->getModel();
			$posts = $postModel->get();
		} catch (\Exception $e) {
			throw $e;
		}
		
		return $posts;
	}
	public function CreatePost($data)
	{
		try {
			$postModel = $this->getModel();
			$image = $data['image'];
			$imageName = time() .'.'. $image->getClientOriginalExtension();
			$data['image'] = $imageName;
			$data['user_id'] = auth()->user()->id;
			$post = $postModel->fill($data);
			$post->save();
			$image->move(public_path('/uploads/images'), $imageName);
		} catch (\Exception $e) {
			throw $e;
		}
		return $post;
	}
	public function showPost($data)
	{
		try {
			$postModel = $this->getModel();
			$post = $postModel->where('id',$data['id'])->first();
		} catch (\Exception $e) {
			throw $e;
		}
		
		return $post;
	}

	public function updatePost($data)
	{
		try {
			$postModel = $this->getModel();
			$post = $postModel->findOrFail($data['id']);
			$post->update($data);
		} catch (\Exception $e) {
			throw $e;
		}
		
		return $post;
	}
	public function deletePost($data)
	{
		try {
			$postModel = $this->getModel();
			$post = $postModel->findOrFail($data['id']);
			$post->delete();

		} catch (\Exception $e) {
			throw $e;
			
		}
	}
}