<?php

    namespace App\Admin\Controllers;

    use Illuminate\Support\Facades\Auth;


    use App\Models\Rroduct;
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
            $grid->filter(function ($filter) {
                $filter->between('create_name', '创建时间')->datetime();
            });
            $grid->column('id', '产品id');
            $grid->column('name', '产品名称');
            $grid->column('total', '产品总额');
            $grid->column('price', '产品余额')->display(function ($price) {
                if (empty($price)) {
                    return $this->total;
                }
                return $price;
            });
            $grid->column('desc', '产品描述');


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

            $show->field('id', '产品id');
            $show->field('name', '产品名称');
            $show->field('total', '产品总数');
            $show->field('price', '产品余额')->as(function ($price) {
                if (empty($this->price)) {
                    return $this->total;
                }
                return $price;
            });
            $show->panel()->tools(function (Show\Tools $tools) {
                $tools->disableDelete();
            });
            $show->field('desc', '产品描述');
            return $show;
        }

        /**
         * Make a form builder.
         *
         * @return Form
         */
        protected function form()
        {
            $userInfo = Auth::guard('admin')->user()->toArray();
            $form = new Form(new Rroduct);
            $form->text('name', '产品名称');
            $form->decimal('total', '产品总额');
            $form->textarea('desc', '产品描述');
            $form->model()->create_id = $userInfo['id'];
            $form->model()->create_name = $userInfo['name'];
            $form->model()->create_name = $userInfo['name'];
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
