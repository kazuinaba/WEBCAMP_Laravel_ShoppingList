<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\User as UserModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingListController;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingList as ShoppingListModel;
use Illuminate\Http\Request;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRegisterPost;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    /**
     会員の新規登録
     */
    public function register(UserRegisterPost $request)
    {
        // validate済みのデータの取得
         $datum = $request->validated();
         $datum['password'] = Hash::make($datum['password']);
        //
        //$user = Auth::user();
        //$id = Auth::id();
        //var_dump($datum, $user, $id); exit;

        // user_id の追加
        $datum['user_id'] = Auth::id();

        // テーブルへのINSERT
        try {
            $r = UserModel::create($datum);
        } catch(\Throwable $e) {
            // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
            echo $e->getMessage();
            exit;
        }

        // 会員登録成功
        $request->session()->flash('front.user_register_success', true);

        //
        //return redirect('/user/register');
        return redirect(route('front.index'));
    }
    
    
    /**
     * ユーザの一覧 を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $group_by_column = ['users.id', 'users.name'];
        $list = UserModel::select($group_by_column)
                         ->selectRaw('count(shopping_lists.id) AS task_num')
                         ->leftJoin('shopping_lists', 'users.id', '=', 'shopping_lists.user_id')
                         ->groupBy($group_by_column)
                         ->orderBy('users.id')
                         ->get();
//echo "<pre>\n";
//var_dump($list->toArray()); exit;
        return view('user.register');
    }

}