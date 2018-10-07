<?php

namespace App\Http\Controllers\Admin\Voucher;

use App\Http\Requests\Admin\Voucher\UpdateRequest;
use App\Models\Category;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke(Voucher $voucher)
    {
        $categories = Category::active()->pluck('name', 'id')->prepend('Select Category', '');

        return view('admin.voucher.create', compact('voucher', 'categories'));
    }

    public function update(UpdateRequest $request, Voucher $voucher)
    {


        $request->request->set('is_active', $request->is_active ?: FALSE);

        $voucher->update($request->all());

        return redirect()->route('admin.voucher.edit', $voucher->id)->with($this->setMessage('voucher successfully updated', self::MESSAGE_SUCCESS));
    }

    public function destroy(Voucher $voucher)
    {

        $voucher->delete();

        return redirect()->route('admin.voucher.all')->with($this->setMessage('voucher successfully deleted', self::MESSAGE_SUCCESS));

    }
}
