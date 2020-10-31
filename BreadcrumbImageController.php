<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\BreadcrumbImage;
use Intervention\Image\Facades\Image as Image;

class BreadcrumbImageController extends Controller
{
    public function index(){
    	$allBreadcrumbImages = BreadcrumbImage::all()->first();
    	return  view('super-admin.breadcrumbImage.create_breadcrumbImage')->with('allBreadcrumbImages',$allBreadcrumbImages);
    }
    public function addBreadcrumbImage(Request $request){
    	$validator = Validator::make($request->all(),[
    		'package_breadcrumb_image'=>['required','image','mimes:jpg,jpeg,png'],
    		'coverage_area_breadcrumb_image'=>['required','image','mimes:jpg,jpeg,png'],
    		'product_breadcrumb_image'=>['required','image','mimes:jpg,jpeg,png'],
    		'payment_breadcrumb_image'=>['required','image','mimes:jpg,jpeg,png'],
    		'contact_breadcrumb_image'=>['required','image','mimes:jpg,jpeg,png'],
    	],[
    		'package_breadcrumb_image.required' => 'Product Image Required',
			'package_breadcrumb_image.image' => 'Product Image will be jpg/jpeg/png file',
			'package_breadcrumb_image.mimes' => 'Product Image will be jpg/jpeg/png file',

    		'coverage_area_breadcrumb_image.required' => 'Product Image Required',
			'coverage_area_breadcrumb_image.image' => 'Product Image will be jpg/jpeg/png file',
			'coverage_area_breadcrumb_image.mimes' => 'Product Image will be jpg/jpeg/png file',

    		'product_breadcrumb_image.required' => 'Product Image Required',
			'product_breadcrumb_image.image' => 'Product Image will be jpg/jpeg/png file',
			'product_breadcrumb_image.mimes' => 'Product Image will be jpg/jpeg/png file',

    		'payment_breadcrumb_image.required' => 'Product Image Required',
			'payment_breadcrumb_image.image' => 'Product Image will be jpg/jpeg/png file',
			'payment_breadcrumb_image.mimes' => 'Product Image will be jpg/jpeg/png file',

    		'contact_breadcrumb_image.required' => 'Product Image Required',
			'contact_breadcrumb_image.image' => 'Product Image will be jpg/jpeg/png file',
			'contact_breadcrumb_image.mimes' => 'Product Image will be jpg/jpeg/png file',
    	]);
    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput();
    	}

    		$breadcrumbImage = new BreadcrumbImage();
    		$package_breadcrumb_image = $request->file('package_breadcrumb_image');
    		$coverage_area_breadcrumb_image = $request->file('coverage_area_breadcrumb_image');
    		$product_breadcrumb_image = $request->file('product_breadcrumb_image');
    		$payment_breadcrumb_image = $request->file('payment_breadcrumb_image');
    		$contact_breadcrumb_image = $request->file('contact_breadcrumb_image');
        	if ($package_breadcrumb_image && $coverage_area_breadcrumb_image && $product_breadcrumb_image && $payment_breadcrumb_image && $contact_breadcrumb_image) 
        {

            // if(file_exists($breadcrumbImage->package_breadcrumb_image)){
            //     unlink($breadcrumbImage->package_breadcrumb_image);
            //     }

            // if(file_exists($breadcrumbImage->coverage_area_breadcrumb_image)){
            //     unlink($breadcrumbImage->coverage_area_breadcrumb_image);
            //     }

            // if(file_exists($breadcrumbImage->product_breadcrumb_image)){
            //     unlink($breadcrumbImage->product_breadcrumb_image);
            //     }

            // if(file_exists($breadcrumbImage->payment_breadcrumb_image)){
            //     unlink($breadcrumbImage->payment_breadcrumb_image);
            //     }

            // if(file_exists($breadcrumbImage->contact_breadcrumb_image)){
            //     unlink($breadcrumbImage->contact_breadcrumb_image);
            //     }
            $this->packageBreadcrumbImage($breadcrumbImage, $package_breadcrumb_image);
            $this->coverageAreaBreadcrumbImage($breadcrumbImage, $coverage_area_breadcrumb_image);
            $this->productBreadcrumbImage($breadcrumbImage, $product_breadcrumb_image);
            $this->paymentBreadcrumbImage($breadcrumbImage, $payment_breadcrumb_image);
            $this->contactBreadcrumbImage($breadcrumbImage, $contact_breadcrumb_image);
            $breadcrumbImage->save();
            $notification = array(
            'message'   =>  'Breadcrumb Image Saved Successfully',
            'alert-type'=> 'success'
        	);
            return back()->with($notification);
        } else 
        {
        	$notification = array(
            'message'   =>  'Something Wrong',
            'alert-type'=> 'error'
        	);
        	return back()->with($notification);
        }

    	

    }



    protected function packageBreadcrumbImage($breadcrumbImage, $package_breadcrumb_image)
    	{
    		$package_breadcrumb_image_name = '1'.time().'.'.$package_breadcrumb_image->getClientOriginalExtension();
    		$package_breadcrumb_image_path = 'assets/images/breadcrumb_images/'.$package_breadcrumb_image_name;
    		Image::make($package_breadcrumb_image)->resize(1280, 200)->save($package_breadcrumb_image_path);
        	$breadcrumbImage->package_breadcrumb_image = $package_breadcrumb_image_path;
    	}
    	protected function coverageAreaBreadcrumbImage($breadcrumbImage, $coverage_area_breadcrumb_image)
    	{
    		$coverage_area_breadcrumb_image_name = '2'.time().'.'.$coverage_area_breadcrumb_image->getClientOriginalExtension();
    		$coverage_area_breadcrumb_image_path = 'assets/images/breadcrumb_images/'.$coverage_area_breadcrumb_image_name;
    		Image::make($coverage_area_breadcrumb_image)->resize(1280, 200)->save($coverage_area_breadcrumb_image_path);
        	$breadcrumbImage->coverage_area_breadcrumb_image = $coverage_area_breadcrumb_image_path;
    	}
    	protected function productBreadcrumbImage($breadcrumbImage, $product_breadcrumb_image)
    	{
    		$product_breadcrumb_image_name = '3'.time().'.'.$product_breadcrumb_image->getClientOriginalExtension();
    		$product_breadcrumb_image_path = 'assets/images/breadcrumb_images/'.$product_breadcrumb_image_name;
    		Image::make($product_breadcrumb_image)->resize(1280, 200)->save($product_breadcrumb_image_path);
        	$breadcrumbImage->product_breadcrumb_image = $product_breadcrumb_image_path;
    	}
    	protected function paymentBreadcrumbImage($breadcrumbImage, $payment_breadcrumb_image)
    	{
    		$payment_breadcrumb_image_name = '4'.time().'.'.$payment_breadcrumb_image->getClientOriginalExtension();
    		$payment_breadcrumb_image_path = 'assets/images/breadcrumb_images/'.$payment_breadcrumb_image_name;
    		Image::make($payment_breadcrumb_image)->resize(1280, 200)->save($payment_breadcrumb_image_path);
        	$breadcrumbImage->payment_breadcrumb_image = $payment_breadcrumb_image_path;
    	}
    	protected function contactBreadcrumbImage($breadcrumbImage, $contact_breadcrumb_image)
    	{
    		$contact_breadcrumb_image_name = '5'.time().'.'.$contact_breadcrumb_image->getClientOriginalExtension();
    		$contact_breadcrumb_image_path = 'assets/images/breadcrumb_images/'.$contact_breadcrumb_image_name;
    		Image::make($contact_breadcrumb_image)->resize(1280, 200)->save($contact_breadcrumb_image_path);
        	$breadcrumbImage->contact_breadcrumb_image = $contact_breadcrumb_image_path;
    	}


    	public function updateBreadcrumbImage(){

    		$allBreadcrumbImages = BreadcrumbImage::all()->first();
    		return view('super-admin.breadcrumbImage.update_breadcrumbImage',compact('allBreadcrumbImages'));
    	}


        public function savePackageUpdateBreadcrumbImage(Request $request){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if($request->hasFile('package_breadcrumb_image')){
                if(file_exists($breadcrumbImage->package_breadcrumb_image)){
                unlink($breadcrumbImage->package_breadcrumb_image);
                }
                $package_breadcrumb_image = $request->file('package_breadcrumb_image');
                $this->packageBreadcrumbImage($breadcrumbImage, $package_breadcrumb_image);
                $breadcrumbImage->save();
                return back();

        }
    }
        public function saveCoverageAreaUpdateBreadcrumbImage(Request $request){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if($request->hasFile('coverage_area_breadcrumb_image')){
                if(file_exists($breadcrumbImage->coverage_area_breadcrumb_image)){
                unlink($breadcrumbImage->coverage_area_breadcrumb_image);
                }
                $coverage_area_breadcrumb_image = $request->file('coverage_area_breadcrumb_image');
                $this->coverageAreaBreadcrumbImage($breadcrumbImage, $coverage_area_breadcrumb_image);
                $breadcrumbImage->save();
                return back();

        }
    }
        public function saveProductUpdateBreadcrumbImage(Request $request){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if($request->hasFile('product_breadcrumb_image')){
                if(file_exists($breadcrumbImage->product_breadcrumb_image)){
                unlink($breadcrumbImage->product_breadcrumb_image);
                }
                $product_breadcrumb_image = $request->file('product_breadcrumb_image');
                $this->productBreadcrumbImage($breadcrumbImage, $product_breadcrumb_image);
                $breadcrumbImage->save();
                return back();

        }
    }

        public function savePaymentUpdateBreadcrumbImage(Request $request){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if($request->hasFile('payment_breadcrumb_image')){
                if(file_exists($breadcrumbImage->payment_breadcrumb_image)){
                unlink($breadcrumbImage->payment_breadcrumb_image);
                }
                $payment_breadcrumb_image = $request->file('payment_breadcrumb_image');
                $this->paymentBreadcrumbImage($breadcrumbImage, $payment_breadcrumb_image);
                $breadcrumbImage->save();
                return back();

        }
    }

        public function saveContactUpdateBreadcrumbImage(Request $request){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if($request->hasFile('contact_breadcrumb_image')){
                if(file_exists($breadcrumbImage->contact_breadcrumb_image)){
                unlink($breadcrumbImage->contact_breadcrumb_image);
                }
                $contact_breadcrumb_image = $request->file('contact_breadcrumb_image');
                $this->contactBreadcrumbImage($breadcrumbImage, $contact_breadcrumb_image);
                $breadcrumbImage->save();
                return back();

        }
    }

    	// public function saveUpdateBreadcrumbImage( Request $request){
    	// 	$breadcrumbImage = BreadcrumbImage::all()->first();
    	// 	if($request->hasFile('package_breadcrumb_image')){
     //            if(file_exists($breadcrumbImage->package_breadcrumb_image)){
     //            unlink($breadcrumbImage->package_breadcrumb_image);
     //            }
    	// 		$package_breadcrumb_image = $request->file('package_breadcrumb_image');
    	// 		$this->packageBreadcrumbImage($breadcrumbImage, $package_breadcrumb_image);
    	// 	}
    	// 	if($request->hasFile('coverage_area_breadcrumb_image')){
     //            if(file_exists($breadcrumbImage->coverage_area_breadcrumb_image)){
     //            unlink($breadcrumbImage->coverage_area_breadcrumb_image);
     //                }
    	// 		$coverage_area_breadcrumb_image = $request->file('coverage_area_breadcrumb_image');
    	// 		$this->coverageAreaBreadcrumbImage($breadcrumbImage, $coverage_area_breadcrumb_image);
    	// 	}
    	// 	if($request->hasFile('product_breadcrumb_image')){
     //            if(file_exists($breadcrumbImage->product_breadcrumb_image)){
    	// 		unlink($breadcrumbImage->product_breadcrumb_image);
     //            }
    	// 		$product_breadcrumb_image = $request->file('product_breadcrumb_image');
    	// 		$this->productBreadcrumbImage($breadcrumbImage, $product_breadcrumb_image);
    	// 	}
    	// 	if($request->hasFile('payment_breadcrumb_image')){
     //            if(file_exists($breadcrumbImage->payment_breadcrumb_image)){
    	// 		unlink($breadcrumbImage->payment_breadcrumb_image);
     //            }
    	// 		$payment_breadcrumb_image = $request->file('payment_breadcrumb_image');
    	// 		$this->paymentBreadcrumbImage($breadcrumbImage, $payment_breadcrumb_image);
    	// 	}
    	// 	if($request->hasFile('contact_breadcrumb_image')){
     //            if(file_exists($breadcrumbImage->contact_breadcrumb_image)){
    	// 		unlink($breadcrumbImage->contact_breadcrumb_image);
     //            }
    	// 		$contact_breadcrumb_image = $request->file('contact_breadcrumb_image');
    	// 		$this->contactBreadcrumbImage($breadcrumbImage, $contact_breadcrumb_image);
    	// 	}
    	// 	$breadcrumbImage->save();
     //        $notification = array(
     //        'message'   =>  'Breadcrumb Image Saved Successfully',
     //        'alert-type'=> 'success'
     //        );
     //        return redirect('superadmin/breadcrumbImage')->with($notification);
    	// }


        public function deletePackageBreadcrumbImage(){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if(file_exists($breadcrumbImage->package_breadcrumb_image)){
                unlink($breadcrumbImage->package_breadcrumb_image);
                }
            $breadcrumbImage->package_breadcrumb_image ='';
            $breadcrumbImage->save();
            return back();
        }
        public function deleteCAreaoverageBreadcrumbImage(){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if(file_exists($breadcrumbImage->coverage_area_breadcrumb_image)){
                unlink($breadcrumbImage->coverage_area_breadcrumb_image);
                }
            $breadcrumbImage->coverage_area_breadcrumb_image ='';
            $breadcrumbImage->save();
            return back();
        }
        public function deleteProductBreadcrumbImage(){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if(file_exists($breadcrumbImage->product_breadcrumb_image)){
                unlink($breadcrumbImage->product_breadcrumb_image);
                }
            $breadcrumbImage->product_breadcrumb_image ='';
            $breadcrumbImage->save();
            return back();
        }
        public function deletePaymentBreadcrumbImage(){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if(file_exists($breadcrumbImage->payment_breadcrumb_image)){
                unlink($breadcrumbImage->payment_breadcrumb_image);
                }
            $breadcrumbImage->payment_breadcrumb_image ='';
            $breadcrumbImage->save();
            return back();
        }
        public function deleteContactBreadcrumbImage(){
            $breadcrumbImage = BreadcrumbImage::all()->first();
            if(file_exists($breadcrumbImage->contact_breadcrumb_image)){
                unlink($breadcrumbImage->contact_breadcrumb_image);
                }
            $breadcrumbImage->contact_breadcrumb_image ='';
            $breadcrumbImage->save();
            return back();
        }
}

            
            
           
            
            