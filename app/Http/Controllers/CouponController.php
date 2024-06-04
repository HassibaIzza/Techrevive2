<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\VendorController;
use App\Http\Requests\CouponRequest;
use App\Models\CouponModel;
use App\Models\User;
use App\Models\Panier;
use App\Models\product\ProductModel;
use App\Notifications\CouponInsertedNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CouponController extends Controller
{

    /*******************************apply promo**************************************************** */
    public function applyPromo(Request $request)
{
    $request->validate([
        'code' => 'required|string',
    ]);

    $code = $request->input('code');
    $coupon = $this->getDiscountForCode($code);
    $discount = $coupon->discount_amount;
    $vendorid = $coupon->VendorId; 

    $user = Auth::user();
    $Paniers = Panier::where('user_id', $user->id)->with('product')->get();

    $total = 0;

    foreach ($Paniers as $panier) {
        $product = ProductModel::find($panier->product_id);
        $itemTotal = $product->product_price * $panier->quantity;

        if ($product->vendor_id == $vendorid) {
            $itemTotal -= ($itemTotal * ($discount / 100));
        }
        $total += $itemTotal ;
    }

    

    return response()->json(['success','total' => $total , 'itemTotal'=>$itemTotal]);
    
}

    /*****************************************récupérer le code promotion ************************************ */
    private function getDiscountForCode($code)
{
    $coupon = CouponModel::where('coupon_code', $code)->first();

    if ($coupon) {
        return $coupon;
    }

    return 0; // No discount
}
    public function getAllCoupons(){
        if (Auth::user()->role == 'admin')
            $data = CouponModel::all();
        else
            $data = CouponModel::where('vendorId', VendorController::getVendorId(Auth::id()))->get();

        return view('backend.coupon.coupon_default', compact('data'));
    }

    /**
     * @param CouponRequest $request
     * @return Response
     */
    public function couponCreate(CouponRequest $request){
        // validation
        $data = $request->validated();

        $data['VendorId'] = VendorController::getVendorId(Auth::id());

        // insertion
        if (CouponModel::insert($data)){
            // notify the admins
            $admins = User::where('role', 'admin')->get();
            $shopName = DB::table('vendor_shop')->where('user_id', Auth::id())->get('shop_name')[0]->shop_name;
            Notification::send($admins, new CouponInsertedNotification($shopName));
            return response(['msg' => 'Coupon is created successfully.'], 200);
        }

        else
            return redirect('coupons')->with('error', 'Failed to add this coupon, try again.');

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function couponRemove(Request $request){
        $role = Auth::user()->role;
        try {
            $coupon = CouponModel::findOrFail($request->id);
            if ($coupon->delete())
                return redirect()->route($role . '-coupon')->with('success', 'Successfully removed.');
            else
                return redirect('coupons')->with('error', 'Failed to remove this coupon.');
        }catch (ModelNotFoundException $exception){
            return redirect('coupon')->with('error', 'Failed to remove this coupon.');
        }
    }

    /**
     * @param CouponRequest $request
     * @return Response
     */
    public function couponUpdate(CouponRequest $request){
        // validation
        $data = $request->validated();

        // get the current coupon ( which being updated )
        try {
            $coupon = CouponModel::findOrFail($request->get('coupon_id'));
        }catch (ModelNotFoundException $exception){
            return redirect()->route('vendor-coupon')->with('error', 'Something went wrong, try again.');
        }

        // update
        if ($coupon->update($data))
            return response(['msg' => 'Coupon is updated successfully.'], 200);
        else
            return redirect()->route('vendor-coupon')->with('error', 'Something went wrong, try again.');
    }
}
