<?php

namespace App\Admin\Controllers;

use App\Comment;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CommentController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header(trans('comments.grid.header'));
            $content->description(trans('comments.grid.description'));

            $content->body($this->grid());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Comment::class, function (Grid $grid) {

            $grid->id(trans('comments.grid.id'))->sortable();
            $grid->user()->name(trans('comments.grid.username'));
            $grid->body(trans('comments.grid.comment'))->limit(30);
            $grid->customPost(trans('comments.grid.post'))->display(function($val){
                return $val;
            });
            $grid->created_at(trans('comments.grid.created_at'));
            $grid->actions(function ($actions) {
                // $actions->disableDelete();
            });

            $grid->disableExport();
            $grid->disableCreation();
        });
    }
    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header(trans('comments.show.header'));
            $content->description(trans('comments.show.description'));

            $content->body(Admin::show(Comment::findOrFail($id), function (Show $show) {

                $show->id(trans('comments.show.id'));
                $show->user()->name(trans('comments.show.username'));
                $show->body(trans('comments.show.comment'));
                $show->divider();
                $show->label('Post');
                $show->divider();
                $show->post()->title(trans('comments.show.title'));
                $show->post()->body(trans('comments.show.post'));
                $show->created_at(trans('comments.show.created_at'));
            }));
        });
    }

    protected function form()
    {
        return Admin::form(Comment::class, function (Form $form) {

            $form->display('id', trans('posts.form.id'));
        });
    }

}
