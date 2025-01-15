<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\ValidReferenceId;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class PageController extends Controller
{
    public function about()
    {
        $data = ['title' => 'About us'];

        return view('pages.about', $data);
    }
    public function services()
    {
        $data = ['title' => 'Services'];

        return view('pages.services', $data);
    }
    public function contact()
    {
        $data = ['title' => 'Contact us'];

        return view('pages.contact', $data);
    }
    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data['uuid'] = Str::uuid();

        Contact::create($data);

        return redirect()->route('contact')->with('success', 'Message sent successfully');
    }
    public function faq()
    {
        $data = ['title' => 'Frequently Asked Questions'];

        return view('pages.faq', $data);
    }
    public function loan()
    {
        $data = ['title' => 'Apply for loan'];

        return view('pages.loan', $data);
    }
    public function loanStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'occupation' => 'required',
            'reference_id' => ['required', new ValidReferenceId],
            'reason' => 'required',
            'type' => 'required',
            'income' => 'required',
        ]);

        $data['uuid'] = Str::uuid();

        Loan::create($data);

        return redirect()->route('loan')->with('success', 'Loan application submitted successfully');
    }
}
