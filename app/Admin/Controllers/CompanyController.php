<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公司管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company);

        $grid->column('id', __('Id'));
        $grid->column('name', '客户名称');
        $grid->column('address','客户地址');
        $grid->column('contact','联系方式');
        $grid->column('charge', '负责人');
        $grid->column('create_time','数据创建时间');
        $grid->column('create_user','数据创建人');
        $grid->column('create_id', '数据创建者id');
        $grid->column('add_time','公司创建时间');
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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('address', __('Address'));
        $show->field('contact', __('Contact'));
        $show->field('charge', __('Charge'));
        $show->field('create_time', __('Create time'));
        $show->field('create_user', __('Create user'));
        $show->field('create_id', __('Create id'));
        $show->field('add_time', __('Add time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Company);

        $form->text('name', __('Name'));
        $form->text('address', __('Address'));
        $form->text('contact', __('Contact'));
        $form->text('charge', __('Charge'));
        $form->datetime('create_time', __('Create time'))->default(date('Y-m-d H:i:s'));
        $form->text('create_user', __('Create user'));
        $form->number('create_id', __('Create id'));
        $form->datetime('add_time', __('Add time'))->default(date('Y-m-d H:i:s'));
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
