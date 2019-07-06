<?php

namespace App\Admin\Controllers;

    use App\Models\Company;
    use Encore\Admin\Controllers\AdminController;
    use Encore\Admin\Form;
    use Encore\Admin\Grid;
    use Encore\Admin\Show;
    use Illuminate\Support\Facades\Auth;

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
            $grid = new Grid(new Company());
            $grid->id('ID')->sortable();
            $grid->model()->orderBy("id","DESC");
            $grid->column('id', __('Id'));
            $grid->column('name', '客户名称');
            $grid->column('address', '客户地址');
            $grid->column('contact', '联系方式');
            $grid->column('charge', '负责人');
            $grid->column('create_user', '数据创建人');
            $grid->column('add_time', '公司创建时间');
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

            $show->field('id', '公司Id');
            $show->field('name', '公司名称');
            $show->field('address', '公司地址');
            $show->field('contact', '公司联系方式');
            $show->field('charge', '负责人');
            $show->field('add_time', '公司创建时间');
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
            $form = new Form(new Company);
            $userInfo = Auth::guard('admin')->user()->toArray();

            $form->text('name', '公司名称');
            $form->text('address', '公司地址');
            $form->text('contact', '公司联系方式');
            $form->text('charge', '公司负责人');
            $form->datetime('create_time', '公司创建时间')->default(date('Y-m-d H:i:s'));
            $form->model()->create_time = date("Y-m-d H:i:s");
            $form->model()->create_id = $userInfo['id'];
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
