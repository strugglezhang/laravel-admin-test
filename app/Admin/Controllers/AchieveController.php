<?php

    namespace App\Admin\Controllers;

    use App\Models\Achieve;
    use App\Models\Customer;
    use App\Models\Product;
    use App\Models\Roles;
    use App\Models\RolesUser;
    use App\Models\User;
    use Encore\Admin\Form;
    use Encore\Admin\Grid;
    use Encore\Admin\Show;
    use Illuminate\Support\Facades\Auth;

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
            $userInfo = Auth::guard('admin')->user()->toArray();
            $roleIdInfo = RolesUser::where('user_id', $userInfo['id'])->first()->toArray();
            $roleInfo = Roles::where('id', $roleIdInfo['user_id'])->first()->toArray();
            if (isset($roleInfo)) {
                if ($roleInfo['slug'] == 'companies') {
                    $grid->model()->where('company', $userInfo['company']);
                } elseif ($roleInfo['slug'] == 'customer') {
                    $grid->model()->where('saleman_id', $userInfo['id']);
                } elseif ($roleInfo['slug'] == 'businiess') {
                    $child = User::where('', $userInfo['id'])->pluck('id');
                    $grid->model()->whereIn('saleman_id', $child)
                        ->orWhere('saleman_id',$userInfo['id']);
                }
            }

            $grid->column('id', 'Id');
            $grid->filter(function ($filter) {
                $filter->between('sale_time', '售出时间')->datetime();
            });
            $grid->column('salesman', '销售者');
            $grid->column('product', '所购产品');
            $grid->column('product_id', '产品id');
            $grid->column('price', '售出金额');
            $grid->column('customer', '客户名称');
            $grid->column('phone', '手机号');
            $grid->column('sale_time', '售出时间');
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

            $show->field('id', 'Id');
            $show->field('salesman', '销售者');
            $show->field('saleman_id', '销售者Id');
            $show->field('product', '所购产品');
            $show->field('product_id', '产品Id');
            $show->field('price', '售出金额');
            $show->field('customer', '客户名称');
            $show->field('phone', '手机号');
            $show->field('idcard', '身份证号');
            $show->field('card', '银行卡号');
            $show->field('contact', '其他联系方式');
            $show->field('sale_time', '售出时间');
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
            $userInfo = Auth::guard('admin')->user()->toArray();
            $userModel = config('admin.database.users_model');
            $form = new Form(new Achieve);
            $form->select("saleman_id", "销售者")->options($userModel::all()->pluck('name', 'id'));
            $form->select("product_id", "产品")->options(Product::all()->pluck('name', 'id'));
            $form->decimal('price', '销售金额');
            $form->text('customer', '客户名称');
            $form->mobile('phone', '客户电话');
            $form->text('idcard', '身份证号');
            $form->text('card', '客户银行卡号');
            $form->text('contact', '其他联系方式');
            $form->datetime('sale_time', '销售时间')->default(date('Y-m-d H:i:s'));
            $form->model()->create_time = date("Y-m-d H:i:s");
            $form->footer(function ($footer) {
                $footer->disableViewCheck();
                $footer->disableEditingCheck();
                $footer->disableCreatingCheck();
                $footer->disableReset();

            });

            // 组合表单数据
            $form->submitted(function (Form $form) use ($userModel) {
                if (!empty($_POST['saleman_id'])) {
                    $product = Product::where('id', $_POST['product_id'])->first()->toArray();
                    $form->model()->product = $product['name'];
                }

                if (!empty($_POST['product_id'])) {
                    $userInfo = $userModel::where('id', $_POST['saleman_id'])->first()->toArray();
                    $form->model()->salesman = $userInfo['name'];
                }

                $form->model()->company = $userInfo['company'];
            });

            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();

            });


            // 保存客户信息
            $form->saved(function (Form $form) use ($userInfo) {
                $model = new Customer();
                $model->name = $form->model()->customer;
                $model->phone = $form->model()->phone;
                $model->contact = $form->model()->contact;
                $model->id_card = $form->model()->idcard;
                $model->card = $form->model()->card;
                $model->create_id = $userInfo['id'];
                $model->create_name = $userInfo['name'];
                $model->create_time = date("Y-m-d H:i:s");
                $model->save();
            });
            return $form;
        }
    }
