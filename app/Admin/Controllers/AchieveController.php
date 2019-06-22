<?php

namespace App\Admin\Controllers;

use App\Models\Achieve;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AchieveController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '绩效管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Achieve);

        $grid->column('id', __('Id'));
        $grid->column('salesman', __('Salesman'));
        $grid->column('product', __('Product'));
        $grid->column('product_id', __('Product id'));
        $grid->column('price', __('Price'));
        $grid->column('customer', __('Customer'));
        $grid->column('phone', __('Phone'));
        $grid->column('idcard', __('Idcard'));
        $grid->column('card', __('Card'));
        $grid->column('contact', __('Contact'));
        $grid->column('sale_time', __('Sale time'));
        $grid->column('create_time', __('Create time'));
        $grid->column('term', __('Term'));
        $grid->column('saleman_id', __('Saleman id'));
        $grid->column('number', __('Number'));
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
        $show = new Show(Achieve::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('salesman', __('Salesman'));
        $show->field('product', __('Product'));
        $show->field('product_id', __('Product id'));
        $show->field('price', __('Price'));
        $show->field('customer', __('Customer'));
        $show->field('phone', __('Phone'));
        $show->field('idcard', __('Idcard'));
        $show->field('card', __('Card'));
        $show->field('contact', __('Contact'));
        $show->field('sale_time', __('Sale time'));
        $show->field('create_time', __('Create time'));
        $show->field('term', __('Term'));
        $show->field('saleman_id', __('Saleman id'));
        $show->field('number', __('Number'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Achieve);

        $form->text('salesman', __('Salesman'));
        $form->text('product', __('Product'));
        $form->number('product_id', __('Product id'));
        $form->decimal('price', __('Price'));
        $form->text('customer', __('Customer'));
        $form->mobile('phone', __('Phone'));
        $form->text('idcard', __('Idcard'));
        $form->text('card', __('Card'));
        $form->text('contact', __('Contact'));
        $form->datetime('sale_time', __('Sale time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('create_time', __('Create time'))->default(date('Y-m-d H:i:s'));
        $form->text('term', __('Term'));
        $form->number('saleman_id', __('Saleman id'));
        $form->number('number', __('Number'));
        $form->footer(function ($footer) {
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
