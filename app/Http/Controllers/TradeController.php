<?php

namespace App\Http\Controllers;

use App\Http\Requests\TradeRequest;
use App\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    /**
     * Show latest pending trade requests
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requests()
    {
        $requests = Trade::latest()
                         ->pending()
                         ->get();

        return view('requests', compact('requests'));
    }

    /**
     * Create new trade request.
     *
     * @param \App\Http\Requests\TradeRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TradeRequest $request)
    {
        Trade::create($request->only(['offered_book_id', 'requested_book_id']));

        flash()->success('Trade request successfully created');

        return redirect('/');
    }

    /**
     * Delete trade request.
     *
     * @param \App\Trade $trade
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Trade $trade)
    {
        $this->authorize('delete', $trade);

        $trade->delete();

        flash()->success('Trade request successfully canceled');

        return back();
    }

    /**
     * Accept or reject trade request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Trade               $trade
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function review(Request $request, Trade $trade)
    {
        $this->authorize('update', $trade);

        if ($request->has('accept')) {
            $trade = $this->approve($trade);
        }

        if ($request->has('reject')) {
            $trade->status = 'rejected';
        }

        $trade->save();

        flash("You {$trade->status} trade request");

        return back();
    }

    /**
     * Swap book owners and set approved status.
     *
     * @param \App\Trade $trade
     *
     * @return \App\Trade
     */
    protected function approve(Trade $trade)
    {
        $user = $trade->offeredBook->user;
        $authUser = $trade->requestedBook->user;

        $trade->offeredBook->user_id = $authUser->id;
        $trade->offeredBook->save();

        $trade->requestedBook->user_id = $user->id;
        $trade->requestedBook->save();

        $trade->status = 'approved';

        return $trade;
    }
}
