<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('member.index', ['member' => Member::latest()->get()]);
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        Member::create($request->only(['name', 'phone', 'address']));

        return redirect('member');
    }

    public function edit(Member $member)
    {
        return view('member.edit', ['member' => $member]);
    }

    public function update(Request $request, Member $member)
    {
        $member->name = $request->input('name');
        $member->phone = $request->input('phone');
        $member->address = $request->input('address');

        $member->save();

        return redirect('member');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect('member');
    }
}
