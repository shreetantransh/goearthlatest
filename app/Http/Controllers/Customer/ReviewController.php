<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/21/2018
 * Time: 10:30 AM
 */

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends CustomerController
{
    public function index()
    {
        $reviews = $this->getCustomer()->reviews()->paginate(5);

        return view('customer.review.index', compact('reviews'));
    }

    public function create(Request $request)
    {
        $product = Product::with('attributes', 'images', 'reviews')
            ->setRelationship()
            ->addSlugFilter(request('product'))
            ->firstOrFail();

        return view('customer.review.edit', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'nullable|max:255',
            'comment' => 'nullable|max:10000',
            'product_id' => 'required|exists:products,id'
        ]);

        $review = new Review($request->only('rating', 'title', 'description'));
        $review->customer()->associate($this->getCustomer());
        $review->product()->associate($request->input('product_id'));

        $review->save();

        return redirect()->route('')->with(
            $this->setMessage('Your review has been successfully submitted.', self::MESSAGE_SUCCESS)
        );
    }
}