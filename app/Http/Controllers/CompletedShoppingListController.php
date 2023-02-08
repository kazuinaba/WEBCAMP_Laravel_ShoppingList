<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingListRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingList as ShoppingListModel;
use Illuminate\Http\Request;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;
use Illuminate\Support\Facades\DB;

class CompletedShoppingListController extends Controller
{
    /**
     * 購入済み「買うもの」一覧ページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        /*
        // 1Page辺りの表示アイテム数を設定
        $per_page = 20;
        
        // 一覧の取得
        $list = $this->getListBuilder()
                     ->paginate($per_page);
        */

//$sql = $this->getListBuilder()
  //          ->toSql();
//echo "<pre>\n"; var_dump($sql, $list); exit;
//var_dump($sql);

        //
        //return view('task.completed_list', ['completed_list' => $list]);
        // return view('task.completed_list');
         
                 // 一覧の取得
       $list = CompletedShoppingListModel::get();
  $list = $this->getListBuilder()
                     ->paginate(1);
  
//$sql = TaskModel::toSql();
//echo "<pre>\n"; var_dump($sql, $list); exit;
     //   return view('shopping_list.completed_list');
           return view('shopping_list.completed_list', ['completed_shopping_list' => $list]);
    }
    
    protected function getListBuilder()
    {
        return CompletedShoppingListModel::where('user_id', Auth::id())
                     ->orderBy('created_at');
           
    }
    

}