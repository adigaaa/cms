<?php 
namespace Api\Posts\Transformers;
use Api\Posts\Models\Post;
use League\Fractal\TransformerAbstract;
class AllPostsTransformer extends TransformerAbstract
{

	public function transform(Post $post)
	{
	    return [
	        'id'      => (int) $post->id,
	        'title'   => $post->title,
	        'body'    =>  $post->body,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/posts/'.$post->image,
                ]
            ],
	    ];
	}
}
