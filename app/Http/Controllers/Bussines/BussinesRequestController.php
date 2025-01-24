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
            $user = Auth::user();

            if ($user->rfcbussines()->exists()) {
                // Usuario relacionado con una EMPRESA
                $data = BussinesRequest::where('rfc_bussines_id', $user->rfcbussines->first()->id);
            } elseif ($user->rfcpruebas()->exists()) {
                // Usuario relacionado con una EMPRESA PRUEBA
                $data = BussinesRequest::where('rfc_prueba_id', $user->rfcpruebas->first()->id);
            } else {
                // No asociado a ninguna EMPRESA o EMPRESA PRUEBA
                $data = BussinesRequest::query()->whereRaw('1 = 0'); // Retorna vacío
            }

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

        $request->validate([
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);
        $user = Auth::user();
        $fileUrl = $request->hasFile('file')
        ? $this->saveFile($request->file('file'), $user->rfcpruebas()->exists())
        : null; // O asigna un valor por defecto como ''
        if ($user->rfcbussines()->exists()) {
            // Para EMPRESAS
            $rfcId = $user->rfcbussines->first()->id;

            $solicitud = BussinesRequest::create([
                'user_id'           => $user->id,
                'rfc_bussines_id'   => $rfcId,
                'type'              => $request->type,
                'type_solicitude'   => 'Producto',
                'file'              => $fileUrl,
            ]);
        } elseif ($user->rfcpruebas()->exists()) {
            // Para EMPRESAS PRUEBA
            $rfcId = $user->rfcpruebas->first()->id;

            $solicitud = BussinesRequest::create([
                'user_id'           => $user->id,
                'rfc_prueba_id'     => $rfcId,
                'type'              => $request->type,
                'type_solicitude'   => 'Producto',
                'file'              => $fileUrl,
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => 'No se encontró una relación válida con RFC.']);
        }

        BussineRequestProduct::create([
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

        BussinesRequestChat::create([
            'bussines_request_id' => $solicitud->id,
            'message'             => 'Solicitud de Producto', // o el mensaje correspondiente
            'bussines_id'         => $user->id,
            'rfc_bussines_id'     => $user->rfcbussines()->exists() ? $user->rfcbussines->first()->id : null,
            'rfc_prueba_id'       => $user->rfcpruebas()->exists() ? $user->rfcpruebas->first()->id : null,
        ]);

        return redirect()->route('bussines-request.index')->with('success', 'Solicitud de Producto creada con éxito');
    }


    public function createService()
    {
        return view('request-bussines.create-service');
    }

    public function storeService(StoreRequestServiceRequest $request)
    {
        $user = Auth::user();
        $fileUrl = $this->saveFile($request->file('file'), $user->rfcpruebas()->exists());


        if ($user->rfcbussines()->exists()) {
            $rfcId = $user->rfcbussines->first()->id;

            $solicitud = BussinesRequest::create([
                'user_id'           => $user->id,
                'rfc_bussines_id'   => $rfcId,
                'type'              => $request->type,
                'type_solicitude'   => 'Servicio',
                'file'              => $fileUrl,
            ]);
        } elseif ($user->rfcpruebas()->exists()) {
            $rfcId = $user->rfcpruebas->first()->id;

            $solicitud = BussinesRequest::create([
                'user_id'           => $user->id,
                'rfc_prueba_id'     => $rfcId,
                'type'              => $request->type,
                'type_solicitude'   => 'Servicio',
                'file'              => $fileUrl,
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => 'No se encontró una relación válida con RFC.']);
        }

        BussineRequestService::create([
            'bussines_request_id'   => $solicitud->id,
            'service_name'          => $request->service_name,
            'description'           => $request->description,
            'budget'                => $request->budget,
            'urgency'               => $request->urgency,
            'description_problem'   => $request->description_problem,
            'link_drive'            => $request->link_drive,
            'file'                  => $fileUrl,
        ]);

        BussinesRequestChat::create([
            'bussines_request_id' => $solicitud->id,
            'message'             => 'Solicitud de Producto', // o el mensaje correspondiente
            'bussines_id'         => $user->id,
            'rfc_bussines_id'     => $user->rfcbussines()->exists() ? $user->rfcbussines->first()->id : null,
            'rfc_prueba_id'       => $user->rfcpruebas()->exists() ? $user->rfcpruebas->first()->id : null,
        ]);

        return redirect()->route('bussines-request.index')->with('success', 'Solicitud de Servicio creada con éxito');
    }


    public function createProfessional()
    {
        return view('request-bussines.create-professional');
    }

    public function storeProfessional(StoreRequestProfessionalRequest $request)
    {
        $user = Auth::user();
        $fileUrl = $this->saveFile($request->file('file'), $user->rfcpruebas()->exists());

        // Verifica si el usuario pertenece a EMPRESA o EMPRESA PRUEBA
        if ($user->rfcbussines()->exists()) {
            // Usuario relacionado con una EMPRESA
            $rfcId = $user->rfcbussines->first()->id;

            $solicitud = BussinesRequest::create([
                'user_id'           => $user->id,
                'rfc_bussines_id'   => $rfcId,
                'type'              => $request->type,
                'type_solicitude'   => 'Profesional',
                'file'              => $fileUrl,
            ]);
        } elseif ($user->rfcpruebas()->exists()) {
            // Usuario relacionado con una EMPRESA PRUEBA
            $rfcId = $user->rfcpruebas->first()->id;

            $solicitud = BussinesRequest::create([
                'user_id'           => $user->id,
                'rfc_prueba_id'     => $rfcId,
                'type'              => $request->type,
                'type_solicitude'   => 'Profesional',
                'file'              => $fileUrl,
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => 'No se encontró una relación válida con RFC.']);
        }

        // Crea los datos adicionales para la solicitud
        BussineRequestProfessional::create([
            'bussines_request_id'   => $solicitud->id,
            'activity_name'         => $request->activity_name,
            'description'           => $request->description,
            'requirements'          => $request->requirements,
            'certifications'        => $request->certifications,
            'details_especialties'  => $request->details_especialties,
            'urgency'               => $request->urgency,
            'time'                  => $request->time,
            'link_drive'            => $request->link_drive,
            'file'                  => $fileUrl,
        ]);

        // Inicializa el chat asociado a la solicitud
        BussinesRequestChat::create([
            'bussines_request_id' => $solicitud->id,
            'message'             => 'Solicitud de Producto', // o el mensaje correspondiente
            'bussines_id'         => $user->id,
            'rfc_bussines_id'     => $user->rfcbussines()->exists() ? $user->rfcbussines->first()->id : null,
            'rfc_prueba_id'       => $user->rfcpruebas()->exists() ? $user->rfcpruebas->first()->id : null,
        ]);

        return redirect()->route('bussines-request.index')->with('success', 'Solicitud de Profesional creada con éxito');
    }



    public function saveFile($archivo, $isEmpresaPrueba = false)
    {
        try {
            // Verifica si el archivo es válido
            if ($archivo && $archivo->isValid()) {
                // Genera un nombre único para el archivo
                $fileName = time() . '.' . $archivo->getClientOriginalExtension();

                // Define la ruta de almacenamiento según el tipo de entidad
                $uploadPath = $isEmpresaPrueba
                    ? public_path('/storage/rfc_pruebas/requests/')
                    : public_path('/storage/rfc_bussines/requests/');

                // Crea el directorio si no existe
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Mueve el archivo al directorio especificado
                $archivo->move($uploadPath, $fileName);

                // Retorna la URL relativa del archivo
                return $isEmpresaPrueba
                    ? '/storage/rfc_pruebas/requests/' . $fileName
                    : '/storage/rfc_bussines/requests/' . $fileName;
            }

            throw new \Exception('El archivo no es válido o no fue subido correctamente.');
        } catch (\Exception $e) {
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
