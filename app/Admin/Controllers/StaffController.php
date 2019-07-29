<?php

    namespace App\Admin\Controllers;

    use App\Models\Staff;
    use Encore\Admin\Controllers\AdminController;
    use Encore\Admin\Form;
    use Encore\Admin\Grid;
    use Encore\Admin\Show;

    class StaffController extends AdminController
    {
        /**
         * Title for current resource.
         *
         * @var string
         */
        protected $title = '员工管理';

        /**
         * Make a grid builder.
         *
         * @return Grid
         */
        protected function grid()
        {
            $grid = new Grid(new Staff);

            $grid->column('id', '员工编号');
            $grid->column('name', '员工名称');
            $grid->column('join_time', '加入时间');
            $grid->column('contact', '联系方式');
            $grid->disableExport();
            $grid->disableColumnSelector();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
            });
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
            $show = new Show(Staff::findOrFail($id));

            $show->field('id', '员工编号');
            $show->field('name', '员工名称');
            $show->field('join_time', '加入时间');
            $show->field('contact', '联系方式');
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
            $form = new Form(new Staff);

            $form->text('name', '员工编号');
            $form->hidden('create_time', __('Create time'))->default(date('Y-m-d H:i:s'));
            $form->datetime('join_time', '加入时间')->default(date('Y-m-d H:i:s'));
            $form->text('contact', '联系方式');

            $form->header(function ($header) {
                $header->disableDelete();
            });
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
