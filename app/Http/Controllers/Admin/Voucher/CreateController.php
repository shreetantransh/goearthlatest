<?php

namespace App\Http\Controllers\Admin\Voucher;

use App\Http\Requests\Admin\Voucher\CreateRequest;
use App\Models\Category;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        $voucher = new Voucher();

        $voucher->sequence = Voucher::count() + 1;

        $categories = Category::active()->pluck('name', 'id')->prepend('-- Select Category --', '');

        return view('admin.voucher.create', compact('voucher', 'categories'));
    }

    public function store(CreateRequest $request)
    {

        $request->request->set('is_active', $request->is_active ?: FALSE);

        $voucher = Voucher::create($request->all());

        return redirect()->route('admin.voucher.edit', $voucher->id)->with($this->setMessage('voucher successfully saved', self::MESSAGE_SUCCESS));
    }
}
