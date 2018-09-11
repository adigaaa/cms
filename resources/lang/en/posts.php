<?php 

return [
	'grid'=>[
		'header' => 'Posts',
		'description' => 'List',
		'id'=>'ID',
		'title'=> 'Title',
		'image'=>'Image',
		'body'=>'Post',
		'filter'=>[
			'title' => 'Title',
			'description'=>'Description',
		],
	],
	'form'=>[
		'header' => 'Posts',
		'description' => [
			'create'=> 'New',
			'update'=>'Edit'
		],
		'id'=>'ID',
		'title'=> 'Title',
		'image'=>'Image',
		'body'=>'Post',
		'created_at' => 'Created At',
	],
	'show'=>[
		'header' => 'Post',
		'description' => 'Show',
		'id'=>'ID',
		'title'=> 'Title',
		'image'=>'Image',
		'body'=>'Post',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
	],
];