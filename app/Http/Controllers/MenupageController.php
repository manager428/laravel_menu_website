<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;


class MenupageController extends Controller
{

    public function index()
    {
        $pages = Page::get();
        return view('menupage.index')->with('pages', $pages);
    }
    public function getpageid($pagename){
        try{
            $page = new Page;
            $page->name = $pagename;
            $page->save();
            $id = $page->id;
            return response()->json(['success'=>$id]);
        }
        catch(Exception $e){
            return response()->json(['success'=>false]);
        }
    }
    public function createpage($pagename, $id){
        $categories = Category::where('page_id', $id)->get();
        $firstids = DB::table('categories')->where('page_id', $id)->orderBy('id')->get('id')->count() ? DB::table('categories')->where('page_id', $id)->orderBy('id')->get('id') : '';
        
        $firstid = $firstids ? $firstids[0]->id : '';
        
        return view('pages.lunch.index')->with('pagename', $pagename)->with('page_id', $id)->with('categories', $categories)->with('firstid', $firstid);
    }

    public function categorycreate(Request $request){
        try{
            $category = new Category;
            $category->name = $request->name;
            $category->page_id = $request->page_id;
            $category->save();
            $id = $category->id;
            return response()->json(['success'=>$id]);
        }
        catch(Exception $e){
            return response()->json(['success'=>false]);
        }
    }
    
}