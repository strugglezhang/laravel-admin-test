<?php

    namespace App\Admin\Controllers;

    use App\Models\Customer;
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

            $grid->column('id', '客户id');
            $grid->column('name', '客户名称');
            $grid->column('phone', '客户手机号');
            $grid->column('contact', '其他联系方式');
            $grid->column('id_card', '身份证号');
            $grid->column('card', '银行卡号');
            $grid->column('address', '联系地址');
            $grid->column('create_time', '创建时间');
            $grid->disableExport();
            $grid->disableColumnSelector();
            $grid->disableCreateButton();
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

            $show->field('name', '客户名称');
            $show->field('phone', '客户手机号');
            $show->field('contact', '其他联系方式');
            $show->field('id_card', '身份证号');
            $show->field('card', '银行卡号');
            $show->field('address', '联系地址');
            $show->panel()->tools(function (Show\Tools $tools) {
                $tools->disableDelete();
            });
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

            $form->text('name', '客户名称');
            $form->mobile('phone', '客户电话');
            $form->text('contact', '其他联系方式');
            $form->text('id_card', '身份证号');
            $form->text('card', '银行卡号');
            $form->text('address', '联系地址');
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

            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();

            });
            return $form;
        }
    }
