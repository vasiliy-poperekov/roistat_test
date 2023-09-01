<?php

namespace App\Http\Controllers;

use App\Models\AmoToken;
use Illuminate\View\View;

class LeadFormController extends Controller
{
    public function showForm(): View
    {
        return view('form', ['accountId' => AmoToken::all()->first()->account_id]);
    }
}
