<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '客户管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('phone', __('Phone'));
        $grid->column('contact', __('Contact'));
        $grid->column('id_card', __('Id card'));
        $grid->column('card', __('Card'));
        $grid->column('address', __('Address'));
        $grid->column('create_id', __('Create id'));
        $grid->column('create_name', __('Create name'));
        $grid->column('create_time', __('Create time'));
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
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('phone', __('Phone'));
        $show->field('contact', __('Contact'));
        $show->field('id_card', __('Id card'));
        $show->field('card', __('Card'));
        $show->field('address', __('Address'));
        $show->field('create_id', __('Create id'));
        $show->field('create_name', __('Create name'));
        $show->field('create_time', __('Create time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Customer);

        $form->text('name', __('Name'));
        $form->mobile('phone', __('Phone'));
        $form->text('contact', __('Contact'));
        $form->text('id_card', __('Id card'));
        $form->text('card', __('Card'));
        $form->text('address', __('Address'));
        $form->number('create_id', __('Create id'));
        $form->text('create_name', __('Create name'));
        $form->datetime('create_time', __('Create time'))->default(date('Y-m-d H:i:s'));
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
