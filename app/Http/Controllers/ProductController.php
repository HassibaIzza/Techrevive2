<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\VendorController;
use App\Http\Requests\ProductRequest;
use App\Models\BrandModel;
use App\Models\Product;
use App\Models\product\ProductImagesModel;
use App\Models\product\ProductModel;
use App\Models\product\ProductOffersModel;
use App\Models\SubCategoryModel;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use App\Models\Favorite;
use App\Models\Panier;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{

    
    private const PRODUCT_AVAILABLE_OFFERS = [
        'hot_deal',
        'featured_product',
        'special_offer',
        'special_deal'
    ];
    private const PRODUCT_IMAGES_PATH = 'uploads/images/product';

    /**
     * @return int
     */
    private function getVendorId(): int{
       return  DB::table('get_vendor_data')->where('id', '=', Auth::id())->get('vendor_id')[0]->vendor_id;
    }

    /*****************************************modifier produit dans le panier ************************************ */
    public function updateQuantities(Request $request)
{
    $user = Auth::user();
    $quantities = $request->input('quantities');

    $items = [];
    $total = 0;

    foreach ($quantities as $quantityData) {
        $productId = $quantityData['product_id'];
        $newQuantity = $quantityData['quantity'];

        $panier = Panier::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

        if ($panier) {
            $panier->quantity = $newQuantity;
            $panier->save();
            $newPrice = $panier->product->product_price * $newQuantity;

            $items[] = [
                'product_id' => $productId,
                'new_price' => $newPrice
            ];

            $total += $newPrice;
        }
    }

    return response()->json([
        'success' => true,
        'items' => $items,
        'new_total' => $total
    ]);
}






    /********************************ajouter les produit aux panier **********************************/
    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $user_id = Auth::check() ? Auth::id() : null;

        $Panier = Panier::where('product_id', $product_id)
                            ->where('user_id', $user_id)
                            ->first();

        if ($Panier) {
            $Panier->quantity += $quantity;
            $Panier->save();
        } else {
            Panier::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);
        }
        $cartCount = Panier::where('user_id', $user_id)->count();
        return response()->json(['success' => true, 'message' => 'Produit ajouté au panier','cartCount'=>$cartCount]);
    }

    /*****************************************afficher les produit aux panier*********************************/
    public function viewCart()
    {
        $user_id = Auth::check() ? Auth::id() : null;

        $Paniers = Panier::where('user_id', $user_id)->with('product')->get();

        $total = 0;
        foreach ($Paniers as $panier) {
            $total += $panier->product->product_price * $panier->quantity;
        }

        return view('backend.product.panier', compact('Paniers','total'));

    }
    /******************************supprimer un produit aux panier **************************************************/
    public function removeItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:product,product_id',
        ]);
    
        $productId = $request->input('product_id');
        $user = Auth::user();
        
        // Assuming you have a Panier model for the cart items
        $panier = Panier::where('user_id', $user->id)->where('product_id', $productId)->first();
        
        if ($panier) {
            $panier->delete();
        }
    
        // Calculate new total
        $Paniers = Panier::where('user_id', $user->id)->with('product')->get();
        $total = 0;
        foreach ($Paniers as $panier) {
            $total += $panier->product->product_price * $panier->quantity;
        }
    
        return response()->json([
            'success' => true,
            'new_total' => $total
        ]);
    }

    /******************afficher les produit aux favoris *****************************/
    public function showFavorite(){
        
        $user = Auth::user();
        // Récupérer les produits favoris avec des relations valides
        $favoriteProducts = $user->favorites()->with('product.images')->get()->filter(function($favorite) {
            return $favorite->product !== null;
        });

        $products = ProductModel::with('images')->get();

        // Ajouter la propriété is_favorite à chaque produit
        $products->each(function ($product) use ($user) {
            $product->is_favorite = $product->isFavorite();
        });

        return view('backend.product.favoris', compact('favoriteProducts','products'));
    }


    /******************************ajouter aux favoris **************************************/
    public function toggleFavorite(Request $request)
    {
        Log::info('toggleFavorite called', ['request' => $request->all()]);
        $user = Auth::user();
        $productId = $request->input('product_id');

        // Vérifiez si le produit est déjà favori
        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($favorite) {
            // Si le produit est déjà favori, supprimez-le
            $favorite->delete();
            Log::info('Product removed from favorites', ['user_id' => $user->id, 'product_id' => $productId]);
            return response()->json(['success' => true, 'message' => 'Produit Retirer aux favoris ']);        } else {
            // Sinon, ajoutez-le comme favori
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            $favoriteCount = Favorite::where('user_id', $user->id)->count();
            Log::info('Product added to favorites', ['user_id' => $user->id, 'product_id' => $productId]);
            return response()->json(['success' => true, 'message' => 'Produit ajouter aux Favoris', 'favoriteCount' => $favoriteCount]);        }
    }


    //afficher les produit aux favoris 
    public function show($product_id)
    {
        $product = ProductModel::with('images')->findOrFail($product_id);
        $product->each(function ($product) {
            $product->is_favorite = $product->isFavorite();
        });
        return view('backend.boutique.view-details', compact('product'));
    }

    

    /**
     * @return View
     */
    public function productAdd(){
        $brands = BrandModel::all();
        $subCategories = SubCategoryModel::all();
        return view('backend.product.product_add', compact('brands', 'subCategories'));
    }

    /**
     * @param ProductRequest $request
     */
    public function productCreate(ProductRequest $request) {
        $data = $request->validated();
        \Log::info('Product data validated', $data);
    
        // Handling the product thumbnail
        $data['product_thumbnail'] = MyHelpers::uploadImage($request->file('product_thumbnail'), self::PRODUCT_IMAGES_PATH);
        \Log::info('Product thumbnail uploaded', ['thumbnail' => $data['product_thumbnail']]);
    
        // Handling the vendor id
        $data['vendor_id'] = $this->getVendorId();
    
        // Handling the product slug
        $data['product_slug'] = $this->getProductSlug($data['product_name']);
    
        // Status of the product
        $data['product_status'] = $request->get('product_status') ? 1 : 0;
    
        // Inserting the product
        if ($data['product_images']) unset($data['product_images']);
    
        try {
            $insertedProductId = ProductModel::insertGetId($data);
        } catch(\Exception $e) {
            return redirect('add_product')->with('error', 'Failed to add this product: ' . $e->getMessage());
        }
    
        if ($insertedProductId) {
            // Handling the product images
            if ($request->file('product_images')) {
                \Log::info('Handling multiple product images', $request->file('product_images'));
                $this->handleProductMultiImages($request->file('product_images'), $insertedProductId);
            }
    
            // Handling the product offers
            $this->handleProductOffers($request, $insertedProductId);
    
            return response(['msg' => 'Produit Ajouter Avec Succées.'], 200);
        } else {
            return redirect('add_product')->with('error', 'Un Probléme lors de l\'ajout de cette produit , Reésseyer.');
        }
    }

    /**
     * @param string $productName
     * @return array|string|string[]
     */
    private function getProductSlug(string $productName){
        return str_replace(' ', '-', strtolower(trim($productName)));
    }

    /**
     * @param array $images
     * @param int $productId
     * @return void
     */
    private function handleProductMultiImages(array $images, int $productId): void {
        $data['image_product_id'] = $productId;
        foreach ($images as $image) {
            $data['product_image'] = MyHelpers::uploadImage($image, self::PRODUCT_IMAGES_PATH);
            // Log image data for debugging
            \Log::info('Inserting product image:', ['product_id' => $productId, 'image' => $data['product_image']]);
            ProductImagesModel::create($data); // Use create instead of insert for Eloquent
        }
    }

    /**
     * @param Request $requestData
     * @param int $productId
     * @param bool $editCase
     * @return void
     */
    private function handleProductOffers(Request & $requestData, int $productId, bool $editCase = false): void{
        $offers['offer_product_id'] = $productId;
        foreach (self::PRODUCT_AVAILABLE_OFFERS as $offerName) {
            $offers[$offerName] = ($requestData->get($offerName)) != null? 1 : 0;
        }
        if ($editCase)
        {

            try {
                ProductOffersModel::firstOrFail()
                    ->where('offer_product_id', $productId)->update($offers);
            }   catch (ModelNotFoundException $exception) {
            }
        }
        else ProductOffersModel::insert($offers);
    }

    /**
     * @param int $productId
     * @return mixed
     */
    public static function getProductImages(int $productId){
        return ProductImagesModel::where('image_product_id', '=', $productId)->get('product_image');
    }

    /**
     * @param string $tags
     * @return array
     */
    public static function getProductSeparatedTags(string $tags): array{
        if ($tags)
            return explode(',', $tags);
        return [];
    }

    /**
     * @param string $colors
     * @return array
     */
    public static function getProductSeparatedColors(string $colors): array{
        if ($colors)
            return explode(',', $colors);
        return [];
    }

    /**
     * @param Request $request
     */
    public function productRemove(Request $request){
        $productId = $request->id;
        $images = self::getProductImages($productId);
        try {
            $product = ProductModel::findOrFail($productId);
            if ($product->delete()){
                // removing the thumbnail
                MyHelpers::deleteImageFromStorage($product->product_thumbnail, self::PRODUCT_IMAGES_PATH . '/');

                // removing images
                foreach ($images as $item)
                    MyHelpers::deleteImageFromStorage($item->product_image, self::PRODUCT_IMAGES_PATH . '/');

                return redirect('vendor/products')->with('success', 'Removed Successfully.');
            }
            else return redirect('vendor/products')->with('error', 'Failed to remove this product.');
        }catch (ModelNotFoundException $exception){
            return redirect('products')->with('error', 'Failed to remove this product.');

        }
    }

    /**
     * @param int $productId
     */
    public function productEdit(int $productId){

        try {
            ProductModel::findOrFail($productId);
            $data = DB::table('get_product_data')
                ->where('offer_product_id', '=', $productId)->get()[0];
            $brands = BrandModel::all();
            $subCategories = SubCategoryModel::all();
            $productImages = ProductImagesModel::where('image_product_id', $productId)->get();
            return view('backend.product.product_edit', compact('data', 'brands', 'subCategories', 'productImages'));
        }catch (ModelNotFoundException $exception){
            return redirect()->route('vendor-product')->with('error', 'Failed, try again later.');
        }
    }

    /**
     * @param ProductRequest $request
     */
    public function productUpdate(ProductRequest $request){
        $data = $request->validated();

        $product_id = $request->get('product_id');

        // getting the old data
        try {
            $oldProduct = ProductModel::findOrFail($product_id);
        }catch (ModelNotFoundException $exception){
            return redirect()->route('vendor-product-edit')->with('error', 'Something went wrong, try again.');
        }

        // handling the product thumbnail
        if ($request->file('product_thumbnail')){
            $data['product_thumbnail'] = MyHelpers::uploadImage($request->file('product_thumbnail'),
                self::PRODUCT_IMAGES_PATH);

            // removing the old image from uploads directory
            MyHelpers::deleteImageFromStorage($oldProduct->product_thumbnail, self::PRODUCT_IMAGES_PATH .  '/');
        }


        // handling the vendor id
        $data['vendor_id'] = $this->getVendorId();

        // handling the product slug
        $data['product_slug'] = $this->getProductSlug($data['product_name']);

        // status of the product
        $data['product_status'] = $request->get('product_status') ? 1 : 0;


        // inserting the product
        if (isset($data['product_images']))
            unset($data['product_images']);

        if ($oldProduct->update($data)){
            // handling the product images
            if ($request->file('product_images')){
                // removing the old images
                $oldImages = ProductImagesModel::where('image_product_id', '=', $product_id)->get();
                foreach ($oldImages as $item)
                    MyHelpers::deleteImageFromStorage($item->product_image, self::PRODUCT_IMAGES_PATH . '/');

                ProductImagesModel::where('image_product_id', '=', $product_id)->delete();

                // inserting the new images
                $this->handleProductMultiImages($request->file('product_images'), $product_id);

            }

            // handling the product offers
            $this->handleProductOffers($request, $product_id, true);

            return response(['msg' => 'Produit Modifier Avec Succées.'], 200);
        }else return redirect('update_product')->with('error', 'Produit Non Modifier, Réesseyer.');
    }

    /**
     * @param Request $request
     */
    public function productActivate(Request $request){
        $product_id = $request->product_id;

        // check whether activate or de-activate
        if ($request->current_status == "1"){
            return $this->productDeActivate($product_id);
        }

        try {
            ProductModel::findOrFail($product_id)->update(['product_status' => 1]);
            return response()->json(['success' => true, 'message' => 'produit activer avec succées ']);       
        }catch (ModelNotFoundException $exception){
            return redirect()->route('vendor-product')->with('error', 'Failed to activate this product, try again');
        }
    }

    /**
     * @param int $productId
     */
    public function productDeActivate(int $productId){
        try {
            ProductModel::findOrFail($productId)->update(['product_status' => 0]);
            return response()->json(['success' => true, 'message' => 'produit deactiver avec succées ']);       
        }catch (ModelNotFoundException $exception){
            return redirect()->route('vendor-product')->with('error', 'Failed to activate this product, try again');
        }
    }

    /**
     * To get the products of the current authenticated vendor/shop
     */
    public function getProducts(){

        // getting current shop id
        $currentVendorId = DB::table('vendor_shop')
            ->where('user_id', Auth::id())->get('vendor_id')[0]->vendor_id;

        // selecting all products related to this shop
        $data = ProductModel::where('vendor_id', $currentVendorId)->get();
        return view('backend.product.product_default', compact('data'));
    }



}
