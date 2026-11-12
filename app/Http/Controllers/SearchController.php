<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Loan;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        $inventories = [];
        $loans = [];
        $users = [];

        if ($keyword) {
            $inventories = Inventory::where('nama_alat', 'like', "%{$keyword}%")
                                    ->orWhere('kode_inventaris', 'like', "%{$keyword}%")->get();
            
            $loans = Loan::where('kode_transaksi', 'like', "%{$keyword}%")->get();

            if (auth()->user()->role == 'admin') {
                $users = User::where('name', 'like', "%{$keyword}%")
                            ->orWhere('username', 'like', "%{$keyword}%")->get();
            }
        }

        return view('search.index', compact('keyword', 'inventories', 'loans', 'users'));
    }
}