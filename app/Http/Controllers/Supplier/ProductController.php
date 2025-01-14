<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Product;
use App\Models\Category;
use App\Models\TypeProduct;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::where('user_id', auth()->user()->id)
            ->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('products.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/products/');
            $file->move($uploadPath, $fileName);
            $data['photo'] = $url = '/storage/rfc_supplier/products/'.$fileName;
        }

        $data['user_id'] = auth()->user()->id;
        $data['rfc_suppliers_id'] = Auth::user()->rfcsuppliers()->first()->id;

        
        $producto = Product::create($data);

        Notification::create([
            'rfc_suppliers_id' => auth()->user()->rfcsuppliers()->first()->id,
            'type' => 'Admin',
            'user_id' => auth()->user()->id,
            'title' => 'Nuevo Producto de Proveedor ',
            'message' => 'El usuario ' . auth()->user()->name . '
             del proveedor ' . auth()->user()->rfcsuppliers()->first()->name . '
              se ha registrado un producto en el sistema',
        ]);

        return redirect()->route('product.index')->with('success', 'Producto creado con exito');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function show($product)
    {
        $data = Product::find($product);
        return view('products.show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
        $data = Product::find($product);
        return view('products.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product)
    {
        $data = $request->all();
        if($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/products/');
            $file->move($uploadPath, $fileName);
            $data['photo'] = $url = '/storage/rfc_supplier/products/'.$fileName;
        }
        $data['user_id'] = auth()->user()->id;
        $data['rfc_suppliers_id'] = auth()->user()->rfcsuppliers()->first()->id;
        $product = Product::find($product);
        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Producto actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $data = Product::find($product);
        $data->delete();

        return redirect()->route('product.index')->with('success', 'Producto eliminado con exito');
    }
}
