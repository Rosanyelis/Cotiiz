<?php

namespace App\Http\Controllers\Bussines;

use Illuminate\Http\Request;
use App\Models\BussinesRequest;
use App\Models\BussinesRequestChat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BussineRequestProduct;
use App\Models\BussineRequestService;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BussineRequestProfessional;
use App\Http\Requests\StoreRequestProductRequest;
use App\Http\Requests\StoreRequestServiceRequest;
use App\Http\Requests\StoreBussinesRequestRequest;
use App\Http\Requests\UpdateBussinesRequestRequest;
use App\Http\Requests\StoreRequestProfessionalRequest;
use Illuminate\Support\Facades\Storage;



class BussinesRequestController extends Controller
{
    public function datatable(Request $request)
    {

        if ($request->ajax()) {
            $data = BussinesRequest::where('rfc_bussines_id', Auth::user()->rfcbussines()->first()->id);
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('request-bussines.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('request-bussines.index');
    }

    public function createProduct()
    {
        return view('request-bussines.create-product');
    }

    public function storeProduct(StoreRequestProductRequest $request)
    {
        // Obtén el RFC Bussines asociado al usuario autenticado
        $rfcBussines = Auth::user()->rfcbussines()->first();

        // Si no se encuentra un RFC Bussines, regresa con un error
        if (!$rfcBussines) {
            return redirect()->back()->withErrors('No se encontró un RFC Bussines asociado al usuario.');
        }

        try {
            // Guarda el archivo y captura la URL
            $fileUrl = $this->saveFile($request->file('file'));

            // Crea la solicitud
            $solicitud = BussinesRequest::create([
                'user_id'           => Auth::user()->id,
                'rfc_bussines_id'   => $rfcBussines->id,
                'type'              => $request->type,
                'type_solicitude'   => 'Producto',
                'file'              => $fileUrl,
            ]);

            // Crea los datos del producto asociados a la solicitud
            $data = BussineRequestProduct::create([
                'bussines_request_id'   => $solicitud->id,
                'product_name'          => $request->product_name,
                'model'                 => $request->model,
                'brand'                 => $request->brand,
                'quantity'              => $request->quantity,
                'budget'                => $request->budget,
                'urgency'               => $request->urgency,
                'description'           => $request->description,
                'link_drive'            => $request->link_drive,
                'file'                  => $fileUrl,
            ]);

            // Crea el chat con la solicitud para el administrador
            BussinesRequestChat::create([
                'rfc_bussines_id'       => $rfcBussines->id,
                'bussines_request_id'   => $solicitud->id,
                'bussines_id'           => Auth::user()->id,
                'message'               => 'Solicitud de Producto',
            ]);

            return redirect()->route('bussines-request.index')->with('success', 'Solicitud de Producto creada con éxito');
        } catch (\Exception $e) {
            // Manejo de errores generales
            return redirect()->back()->withErrors(['error' => 'Hubo un problema al procesar tu solicitud: ' . $e->getMessage()]);
        }
    }


    public function createService()
    {
        return view('request-bussines.create-service');
    }

    public function storeService(StoreRequestServiceRequest $request)
    {
        # se crea la solicitud
        $solicitud = BussinesRequest::create([
            'user_id'           => Auth::user()->id,
            'rfc_bussines_id'   => Auth::user()->rfcbussines()->first()->id,
            'type'              => $request->type,
            'type_solicitude'   => 'Servicio',
            'file'              => $this->saveFile($request->file),
        ]);
        # formalizamos los datos de la solicitud del productos
        $data = BussineRequestService::create([
            'bussines_request_id'   => $solicitud->id,
            'service_name'          => $request->service_name,
            'description'           => $request->description,
            'budget'                => $request->budget,
            'urgency'               => $request->urgency,
            'description_problem'   => $request->description_problem,
            'link_drive'            => $request->link_drive,
            'file'                  => $this->saveFile($request->file('file')),
        ]);
        # Inicializamos el chat con la solicitud para el administrador
        BussinesRequestChat::create([
            'rfc_bussines_id'       => Auth::user()->rfcbussines()->first()->id,
            'bussines_request_id'   => $solicitud->id,
            'bussines_id'           => Auth::user()->id,
            'message'               => 'Solicitud de Servicio',
        ]);

        return redirect()->route('bussines-request.index')->with('success', 'Solicitud de Servicio creada con exito');
    }

    public function createProfessional()
    {
        return view('request-bussines.create-professional');
    }

    public function storeProfessional(StoreRequestProfessionalRequest $request)
    {
        # se crea la solicitud
        $solicitud = BussinesRequest::create([
            'user_id'           => Auth::user()->id,
            'rfc_bussines_id'   => Auth::user()->rfcbussines()->first()->id,
            'type'              => $request->type,
            'type_solicitude'   => 'Profesional',
            'file'              => $this->saveFile($request->file),
        ]);
        # formalizamos los datos de la solicitud del productos
        $data = BussineRequestProfessional::create([
            'bussines_request_id'   => $solicitud->id,
            'activity_name'         => $request->activity_name,
            'description'           => $request->description,
            'requirements'          => $request->requirements,
            'certifications'        => $request->certifications,
            'details_especialties'  => $request->details_especialties,
            'urgency'               => $request->urgency,
            'time'                  => $request->time,
            'link_drive'            => $request->link_drive,
            'file'                  => $this->saveFile($request->file('file')),
        ]);
        # Inicializamos el chat con la solicitud para el administrador
        BussinesRequestChat::create([
            'rfc_bussines_id'       => $solicitud->rfc_bussines_id,
            'bussines_request_id'   => $solicitud->id,
            'bussines_id'           => Auth::user()->id,
            'message'               => 'Solicitud de un Profesional',
        ]);

        return redirect()->route('bussines-request.index')->with('success', 'Solicitud de Profesional creada con exito');
    }


    public function saveFile($archivo)
    {
        try {
            // Verifica si el archivo es válido y es una instancia de UploadedFile
            if ($archivo && $archivo instanceof \Illuminate\Http\UploadedFile && $archivo->isValid()) {
                // Genera un nombre único para el archivo
                $fileName = time() . '.' . $archivo->getClientOriginalExtension();

                // Define la ruta de almacenamiento
                $uploadPath = public_path('/storage/rfc_bussines/requests/');

                // Crea el directorio si no existe
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Usa almacenamiento alternativo (almacenamiento en memoria temporal)
                $content = file_get_contents($archivo->getRealPath());
                file_put_contents($uploadPath . $fileName, $content);

                // Retorna la URL del archivo
                return '/storage/rfc_bussines/requests/' . $fileName;
            } else {
                throw new \Exception('El archivo no es válido o no fue subido correctamente.');
            }
        } catch (\Exception $e) {
            // Manejo de errores en el almacenamiento del archivo
            report($e); // Registra el error en los logs de Laravel
            return redirect()->back()->withErrors(['file' => 'Error al guardar el archivo: ' . $e->getMessage()]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBussinesRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BussinesRequest $bussinesRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BussinesRequest $bussinesRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBussinesRequestRequest $request, BussinesRequest $bussinesRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BussinesRequest $bussinesRequest)
    {
        //
    }


}
