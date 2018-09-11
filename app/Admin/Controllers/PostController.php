<?php
namespace App\Admin\Controllers;

use App\Post;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PostController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        try {
             return Admin::content(function (Content $content) {

            $content->header(trans('posts.grid.header'));
            $content->description(trans('posts.grid.description'));

            $content->body($this->grid());
        });
        } catch (\Exception $e) {
            dd($e);
        }
       
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header(trans('posts.form.header'));
            $content->description(trans('posts.form.description.update'));

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header(trans('posts.form.header'));
            $content->description(trans('posts.form.description.create'));

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Post::class, function (Grid $grid) {
            $grid->model()->orderBy('id','desc');
            $grid->id(trans('posts.grid.id'))->sortable();
            $grid->title(trans('posts.grid.title'));
            $grid->CustomeBody(trans('posts.grid.body'))->display(function($body){
                return $body;
            });
            $grid->image()->image();
            $grid->paginate(20);
            $grid->filter(function($filter){
                $filter->like('title',trans('posts.grid.filter.title'));
                $filter->like('body',trans('posts.grid.filter.description'));
            });
            $grid->disableRowSelector();
            $grid->disableExport();

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Post::class, function (Form $form) {

            $form->display('id', trans('posts.form.id'));
            $form->text('title', trans('posts.form.title'))->rules('required|min:5|max:50|string');
            $form->divider();
            $form->image('image', trans('posts.form.image'))->rules('required|image|max:50000|mimes:jpeg,jpg,png');
            $form->divider();
            $form->textarea('body', trans('posts.form.body'))->rules('required|min:100|max:500');
            $form->divider();
            $form->display('created_at', trans('posts.form.created_at'));
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

            $content->header(trans('posts.show.header'));
            $content->description(trans('posts.show.description'));

            $content->body(Admin::show(Post::findOrFail($id), function (Show $show) {

                $show->id(trans('posts.show.id'));
                $show->title(trans('posts.show.title'));
                $show->divider();
                $show->image(trans('posts.show.image'))->image();
                $show->divider();
                $show->body(trans('posts.show.body'));
                $show->divider();
                $show->created_at(trans('posts.show.created_at'));
                $show->updated_at(trans('posts.show.updated_at'));
            }));
        });
    }
}
