<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfiguracionSitio;
use App\Municipio;
use App\HistoriaCiudad;
use App\Noticia;
use App\Alerta;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use Phim\Color\Scheme\NamedMonochromaticScheme;
use Phim\Color;
use Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;




class PrincipalController extends Controller
{
    public function index()
    {
        $config = ConfiguracionSitio::first();
        $muni = Municipio::first();
        $pagPrincipal = DB::table('pagina_principals')->first();

        if($config != null && isset($config->color_principal)){
            //$colorP = 'e96b56';
            $colores = new NamedMonochromaticScheme($config->color_principal, .3);

            $config->color_1 = $colores->getDarkestShade();
            $config->color_2 = $colores->getDarkShade();
            $config->color_base = $colores->getBaseColor();
            $config->color_3 = $colores->getLightTint();
            $config->color_4 = $colores->getLighterTint();
            $config->color_5 = $colores->getLightestTint();
        }

        $tiposAlertas = DB::table('tipo_alertas')->select('id', 'tipo')->get();
        
        
        $view = 'principal';
        return Voyager::view($view, compact('config', 'muni', 'pagPrincipal', 'tiposAlertas'));
    }

    public function autoridades()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $autoridades = DB::table('autoridads')
                    ->join('tipo_autoridads', 'autoridads.tipo_autoridad', 'tipo_autoridads.id')
                    ->select('autoridads.*', 'tipo_autoridads.nombre as tipo_autoridad', 
                             'tipo_autoridads.slug as slug_tipo_autoridad',
                             'tipo_autoridads.index as index_tipo_autoridads')
                    ->orderBy('tipo_autoridads.index', 'asc')
                    ->orderBy('autoridads.index', 'asc')
                    ->get();

        
        $view = 'autoridades';
        return Voyager::view($view, compact('config', 'muni', 'autoridades'));
    }
    public function tipoAutoridad(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $tipoAutoridad = DB::table('tipo_autoridads')->where('slug', $slug)->first();
        $autoridades = [];
        if($tipoAutoridad != null ){
            $autoridades = DB::table('autoridads')->where('tipo_autoridad', $tipoAutoridad->id)->get();
        }
        
        $view = 'tipoAutoridad';
        return Voyager::view($view, compact('config', 'muni', 'tipoAutoridad', 'autoridades'));
    }

    public function autoridad(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $autoridad = DB::table('autoridads')->where('slug', $slug)->first();
        $tipoAutoridad = null;
        if($autoridad != null ){
            $tipoAutoridad = DB::table('tipo_autoridads')->where('id', $autoridad->tipo_autoridad)->first();
        }
        
        $view = 'autoridad';
        return Voyager::view($view, compact('config', 'muni', 'autoridad', 'tipoAutoridad'));
    }

    public function direcciones()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $direcciones = DB::table('direccion_municipals')
                    ->orderBy('index', 'asc')
                    ->get();

        
        $view = 'direcciones';
        return Voyager::view($view, compact('config', 'muni', 'direcciones'));
    }


    public function direccion(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $direccion = DB::table('direccion_municipals')
                        ->where('slug', $slug)
                        ->whereNull('deleted_at')
                        ->orderBy('index', 'asc')
                        ->first();
        
                        

        $tipo_subdirecciones = DB::table('tipo_subdireccions')
                                ->whereNull('deleted_at')
                                ->orderBy('index', 'asc')
                                ->get();
        
        $count = 0;

        foreach ($tipo_subdirecciones as $ts) {
            $ts->subDirecciones = [];
            $ts->subDirecciones = DB::table('subdireccions')
                                                        ->where('tipo_subdireccion', $ts->id)
                                                        ->where('direccion_municipal', $direccion->id)
                                                        ->whereNull('deleted_at')
                                                        ->orderBy('index', 'asc')
                                                        ->get();
            if (count($ts->subDirecciones) > 0) {
                $count = $count + 1;
            }
                                                        
        }
        
        $direccion->subdirecciones_count = $count;
        
        $view = 'direccion';
        return Voyager::view($view, compact('config', 'muni', 'direccion', 'tipo_subdirecciones'));
    }

    public function tramite(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        
        $tramite = DB::table('tramites')
                        ->where('slug', $slug)
                        ->whereNull('deleted_at')
                        ->orderBy('index', 'asc')
                        ->first();

        $direccion = DB::table('direccion_municipals')
                        ->where('id', $tramite->direccion_municipal)
                        ->whereNull('deleted_at')
                        ->orderBy('index', 'asc')
                        ->first();
        
        $view = 'tramite';
        return Voyager::view($view, compact('config', 'muni', 'direccion', 'tramite'));
    }

    public function concejales()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $concejales = DB::table('concejales')
                    ->orderBy('index', 'asc')
                    ->get();

        
        $view = 'concejales';
        return Voyager::view($view, compact('config', 'muni', 'concejales'));
    }


    public function concejal(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $concejal = DB::table('concejales')->where('slug', $slug)->first();
        
        $view = 'concejal';
        return Voyager::view($view, compact('config', 'muni', 'concejal'));
    }

    public function personaje(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $personaje = DB::table('personajes')->where('slug',$slug)->first();
        
        $view = 'personaje';
        return Voyager::view($view, compact('config', 'muni', 'personaje'));
    }

    public function listadoPersonajes()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $personajes = DB::table('personajes')->orderBy('index','asc')->get();
        
        $view = 'listadoPersonajes';
        return Voyager::view($view, compact('config', 'muni', 'personajes'));
    }

    public function categoriasEmprendedores()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $categorias = DB::table('categoria_emprendimientos')->whereNull('deleted_at')->orderBy('index', 'asc')->get();

        $view = 'categoriasEmprendedores';
        return Voyager::view($view, compact('config', 'muni', 'categorias'));
    }
    public function listadoEmprendimientos($slug)
    {
        if($slug != null){
            $config = ConfiguracionSitio::get()->first();
            $muni = Municipio::get()->first();
            $categoria = DB::table('categoria_emprendimientos')
                                    ->whereNull('deleted_at')
                                    ->where('slug', $slug)
                                    ->first();

            $view = 'listadoEmprendedores';
            return Voyager::view($view, compact('config', 'muni', 'categoria'));
        }else{
            $this->categoriasEmprendedores();
        }
        
        
        
    }
    public function emprendimiento()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $historia = HistoriaCiudad::where('id', $muni->id)->first();
        $historia->imagenes = json_decode($historia->imagenes, true);
        
        $view = 'emprendimiento';
        return Voyager::view($view, compact('config', 'muni', 'historia'));
    }

    public function nuevoEmprendimiento()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $view = 'nuevoEmprendimiento';
        return Voyager::view($view, compact('config', 'muni'));
    }

    public function productos()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $historia = HistoriaCiudad::where('id', $muni->id)->first();
        $historia->imagenes = json_decode($historia->imagenes, true);
        
        $view = 'productos';
        return Voyager::view($view, compact('config', 'muni', 'historia'));
    }

    public function categoriasComplejos()
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $categorias = DB::table('tipo_complejos')->orderBy('index', 'asc')->get();
        
        $view = 'categoriasComplejos';
        return Voyager::view($view, compact('config', 'muni', 'categorias'));
    }

    public function listaComplejos(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $categoria = DB::table('tipo_complejos')->where('slug', $slug)->first();
        $complejos = [];
        if ($categoria != null) {
            $complejos = DB::table('complejos')->where('tipo_complejo', $categoria->id)->get();
        } 
        $view = 'listaComplejos';
        return Voyager::view($view, compact('config', 'muni', 'categoria', 'complejos'));
    }

    public function complejo(Request $req, $slug)
    {
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();

        $categoria = null;
        $complejo = DB::table('complejos')->where('slug', $slug)->first();

        if ($complejo != null) {
            $categoria = DB::table('tipo_complejos')->where('id', $complejo->tipo_complejo)->first();
        }
        
        $view = 'complejo';
        return Voyager::view($view, compact('config', 'muni', 'categoria', 'complejo'));
    }

    public function noticias(Request $req, $slug="")
    {
        
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        if($req->has('cat') && $req->cat == "Municipio"){
            $listaNoticias = Noticia::whereNull('perfil')->get();
        }else{
            $listaNoticias = Noticia::get();
        }
        
        $view = 'noticias';
        $noticia = null;
        if ($slug != "") {
            $noticia = Noticia::where('slug',$slug)->first();
            if ($noticia->perfil == null) {
                $noticia->categoria = "Municipio";

                $temas = DB::table('temas')
                    ->join('noticia_temas', 'temas.id', '=', 'noticia_temas.tema_id')
                    ->where('noticia_temas.noticia_id', $noticia->id)
                    ->select('temas.nombre')
                    ->get();
                $noticia->temas = $temas;
            }
            

            $view = "noticia";
        }

        return Voyager::view($view, compact('config', 'muni', 'listaNoticias', 'noticia'));
    }

    public function paginas(Request $req, $slug)
    {
        
        $config = ConfiguracionSitio::get()->first();
        $muni = Municipio::get()->first();
        $pagina = null;

        if ($slug != "") {
            $pagina = DB::table('paginas')->where('slug',$slug)->first();
            if ($pagina == null || empty($pagina)) {
                abort(404);
            }
        }else{
            abort(404);
        }

        $view = "pagina";

        return Voyager::view($view, compact('config', 'muni', 'pagina'));
    }

    public function store_alerta(Request $request){        
        
        $alerta = DB::table('alertas')->insertGetId([
            'nombre_rtt' => $request->nombre_rtt,
            'email_rtt' => $request->email_rtt,
            'direccion' => $request->direccion,
            'tipo_alerta' => $request->tipo_alerta,
            'comentario' => $request->comentario,
            'created_at' => \carbon\Carbon::now(),
            'updated_at' => \carbon\Carbon::now()
        ]);

        
        if ($alerta > 0) {
            return new JsonResponse(data: "OK", status: 200,);
        }else{
            return new JsonResponse(data: "No se puede crear la alerta en estos momentos", status: 200,);
        }
        
    }

    public function store_newlister(Request $request){        
        
        $newlister = DB::table('newlisters')->insertGetId([
            'email' => $request->email,
            'created_at' => \carbon\Carbon::now(),
            'updated_at' => \carbon\Carbon::now()
        ]);

        
        if ($newlister > 0) {
            return new JsonResponse(data: "OK", status: 200,);
        }else{
            return new JsonResponse(data: "No se puede crear la suscripción en estos momentos", status: 200,);
        }
        
    }

    public function store_emprende(Request $request){   
        
        $role_id = DB::table('roles')->select('id')->where('name', 'emprendedor')->pluck('id')->first();

        if($role_id == null){
            return new JsonResponse(data: "No se puede crear el perfil en estos momentos", status: 200,);
        }

        $config_role = DB::table('config_roles')->where('role_id', $role_id)->first();

        //if($request->email_emprendedor != null &&
          //  DB::table('users')->select('id')->where('email', $request->email_emprendedor)->first() == null){
            //    return new JsonResponse(data: "El email ingresado ya existe en nuestros registros", status: 200,);
           // }
        
        $existUser = DB::table('users')
                                ->where('email', $request->email_emprendedor)
                                ->where('role_id', $role_id)
                                ->get();

        $existEmprendedor = DB::table('emprendedors')
                                ->where('email', $request->email_emprendedor)
                                ->orWhere('rut', $request->rut_emprendedor)
                                ->get();

        if(count($existEmprendedor) > 0 || count($existUser)){
            return new JsonResponse(data: "No se puede crear el perfil porque ya existe", status: 200,);
        }

        $user = DB::table('users')->insertGetId([
            'role_id' => $role_id,
            'name' => $request->nombre_emprendedor . ' '. substr($request->apellidoP_emprendedor, 0, 1) ,
            'email' => $request->email_emprendedor,
            'avatar' => $config_role->default_avatar,
            'password' => Hash::make($request->passwd),
            'created_at' => \carbon\Carbon::now(),
            'updated_at' => \carbon\Carbon::now()
        ]);
        
        $emprendedor = DB::table('emprendedors')->insertGetId([
            'nombre' => $request->nombre_emprendedor,
            'apellido_p' => $request->apellidoP_emprendedor,
            'apellido_m' => $request->apellidoM_emprendedor,
            'email' => $request->email_emprendedor,
            'imagen_perfil' => $config_role->default_avatar,
            'rut' => $request->rut_emprendedor,
            'habilitado' => 0,
            'user_id' => $user,
            'created_at' => \carbon\Carbon::now(),
            'updated_at' => \carbon\Carbon::now()
        ]);

        $slug = Str::slug($request->nombre_emprendimiento, "-");
        $countSlug = DB::table('emprendimientos')->where('slug', $slug)->count();
        
        if($countSlug > 0){
            $slug .= '-'.($countSlug + 1);
        }

        $emprendimiento = DB::table('emprendimientos')->insertGetId([
            'nombre' => $request->nombre_emprendimiento,
            'user_id' => $user,
            'emprendedor_id' => $emprendedor,
            'categoria_id' => $request->categoria,
            'visible' => 0,
            'slug' => $slug,
            'created_at' => \carbon\Carbon::now(),
            'updated_at' => \carbon\Carbon::now()
        ]);
        
        if ($emprendimiento != null && $emprendedor != null && $user != null) {
            return new JsonResponse(data: "OK", status: 200,);
        }else{
            return new JsonResponse(data: "No se puede crear el perfil en estos momentos", status: 200,);
        }
        
    }

    public function getCategoriasEmprendimientos(){
        $categorias = DB::table('categoria_emprendimientos')
                                    ->select('id', 'nombre')
                                    ->whereNull('deleted_at')
                                    ->get();


        return response()->json($categorias);

    }

    public function getExistRut($rut){
        
        $eRut = DB::table('emprendedors')
                                ->where('rut', $rut)
                                ->get();

        if(count($eRut) > 0){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    


}
