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

            $grid->column('id', 'Id');
            $grid->column('salesman', '销售者');
            $grid->column('product', '所购产品');
            $grid->column('product_id', '产品id');
            $grid->column('price', '产品单价');
            $grid->column('customer', '客户名称');
            $grid->column('phone', '手机号');
            $grid->column('idcard', '身份证号');
            $grid->column('card', '银行卡号');
            $grid->column('contact', '其他联系方式');
            $grid->column('sale_time', '售出时间');
            $grid->column('number', __('购买数量'));
            $grid->column('saleman_id', __('Saleman id'));
            $grid->column('create_time', __('Create time'));
            $grid->column('term', __('Term'));
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
