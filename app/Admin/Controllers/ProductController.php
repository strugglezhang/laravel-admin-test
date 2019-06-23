<?php

namespace App\Admin\Controllers;

use App\Models\Rroduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '产品管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Rroduct);

        $grid->column('id', '产品id');
        $grid->column('name','产品名称');
        $grid->column('price', '产品单价');
        $grid->column('total', '产品总额');
        $grid->column('number', '产品数量');
        $grid->column('desc','产品数量');
        $grid->column('create_time', __('Create time'));
        $grid->column('create_name', __('Create name'));
        $grid->column('create_id', __('Create id'));
        $grid->disableExport();
        $grid->disableColumnSelector();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Rroduct::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('price', __('Price'));
        $show->field('total', __('Total'));
        $show->field('number', __('Number'));
        $show->field('desc', __('Desc'));
        $show->field('create_time', __('Create time'));
        $show->field('create_name', __('Create name'));
        $show->field('create_id', __('Create id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Rroduct);

        $form->text('name', __('Name'));
        $form->decimal('price', __('Price'));
        $form->text('total', __('Total'));
        $form->number('number', __('Number'));
        $form->textarea('desc', __('Desc'));
        $form->datetime('create_time', __('Create time'))->default(date('Y-m-d H:i:s'));
        $form->text('create_name', __('Create name'));
        $form->number('create_id', __('Create id'));
        $form->footer(function ($footer) {

            // 去掉`重置`按钮
            $footer->disableReset();

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });
        return $form;
    }
}
