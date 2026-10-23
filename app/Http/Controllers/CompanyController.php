<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;

class CompanyController extends Controller
{
    public function create()
    {
        // moved to Livewire
        // $countries = Country::all();

        return view('companies.create');
    }
}
