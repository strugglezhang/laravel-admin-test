<?php


    namespace App\Admin\Controllers;

    use App\Models\Company;
    use Encore\Admin\Grid;
    use Encore\Admin\Form;
    use Encore\Admin\Layout\Content;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class explame
    {

        /**
         * @desc 分公司管理主页
         * @param Content $content
         * @return Content
         */
        public function index(Content $content)
        {
            $content->header('分公司管理');
            $grid = new Grid(new Company);
            $grid->id('ID')->sortable();
            $grid->column('name', '分公司名称');
            $grid->column('address', '分公司地址');
            $grid->column('contact', '联系方式');
            $grid->column('charge', '负责人');
            $grid->column('add_time', '公司创建时间');
            $grid->column('create_time', '数据添加时间');
            $grid->column('create_user', '创建者');
            $grid->paginate(15);
            $grid->disableExport();
            $grid->disableColumnSelector();
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
            $grid->actions(function ($actions) use ($grid){
                $actions->disableView();
            });
            $content->body($grid);
            return $content;
        }


        /*
         * @desc 创建分公司
         */
        public function create(Request $request, Content $content)
        {
            $content->header('添加分公司');
            $form = new Form(new Company);
            $form->display('id', 'ID');
            $form->text('name', '公司名称');
            $form->text('address', '分公司地址');
            $form->text('contact', '联系方式');
            $form->text('charge', '负责人');
            $form->datetime('add_time', '公司创建时间');
            $form->text('create_user', '创建者');
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
            $userInfo = $this->getUserInfo();
            $form->setAction('/admin/company/index/create');
            if ($request->method() == 'POST') {
                $form->create_user = $userInfo['username'];
                $form->create_id = $userInfo['id'];
                $form->store();
                return redirect('admin/company/index');
            }
            $content->body($form);
            return $content;
        }

        /*
         * @desc 修改分公司
         */
        public function edit(Request $request, Content $content)
        {
            $content->header('添加分公司');
            $form = new Form(new Company);
            $form->display('id', 'ID');
            $form->text('name', '公司名称');
            $form->text('address', '分公司地址');
            $form->text('contact', '联系方式');
            $form->text('charge', '负责人');
            $form->datetime('add_time', '公司创建时间');
            $form->text('create_user', '创建者');
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
            $userInfo = $this->getUserInfo();
            $form->setAction('/admin/company/index/create');
            if ($request->method() == 'POST') {
                $form->create_user = $userInfo['username'];
                $form->create_id = $userInfo['id'];
                $form->store();
                return redirect('admin/company/index');
            }
            $content->body($form);
            return $content;
        }

        /*
         * @desc 删除分公司
         */
        public function delete()
        {

        }

        protected function getUserInfo()
        {
            return (Auth::guard('admin')->user()->toArray());
        }
    }