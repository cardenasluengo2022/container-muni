<?php

namespace App\Http\Controllers\Voyager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;

class VoyagerController extends Controller
{
    public function index()
    {
        return Voyager::view('voyager::index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('voyager.login');
    }

    public function upload(Request $request)
    {
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;
        $slug = $request->input('type_slug');
        $file = $request->file('image');

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->firstOrFail();

        if ($this->userCannotUploadImageIn($dataType, 'add') && $this->userCannotUploadImageIn($dataType, 'edit')) {
            abort(403);
        }

        $path = $slug.'/'.date('FY').'/';

        $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $filename_counter = 1;

        // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
        while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
            $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension()).(string) ($filename_counter++);
        }

        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

        $ext = $file->guessClientExtension();

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
            $image = Image::make($file)
                ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            if ($ext !== 'gif') {
                $image->orientate();
            }
            $image->encode($file->getClientOriginalExtension(), 75);

            // move uploaded file from temp to uploads directory
            if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                $status = __('voyager::media.success_uploading');
                $fullFilename = $fullPath;
            } else {
                $status = __('voyager::media.error_uploading');
            }
        } else {
            $status = __('voyager::media.uploading_wrong_type');
        }

        // Return URL for TinyMCE
        return Voyager::image($fullFilename);
    }

    public function assets(Request $request)
    {
        
        $archivo = '';
        try {
            if (class_exists(\League\Flysystem\Util::class)) {
                // Flysystem 1.x
                $path = public_path('assets/'.\League\Flysystem\Util::normalizeRelativePath(urldecode($request->path)) );
                $archivo = \League\Flysystem\Util::normalizeRelativePath(urldecode($request->path));
            } elseif (class_exists(\League\Flysystem\WhitespacePathNormalizer::class)) {
                // Flysystem >= 2.x
                $normalizer = new \League\Flysystem\WhitespacePathNormalizer();
                $path = public_path( 'assets/'. $normalizer->normalizePath(urldecode($request->path)) );
                $archivo = $normalizer->normalizePath(urldecode($request->path));
            }

            if(empty($archivo)){
                $pathDecoded = urldecode($request->path);
                preg_match('/\bpath=([^&]+)/', $pathDecoded, $matches);
                $path = public_path( 'assets/'. $matches[1]);
            }
            
            
        } catch (\LogicException $e) {
            abort(404);
        }
       
        $perms = fileperms($path);
        $info = '';

        if (($perms & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($perms & 0xA000) == 0xA000) {
            // Enlace simbólico
            $info = 'l';
        } elseif (($perms & 0x8000) == 0x8000) {
            // Archivo regular
            $info = '-';
        } elseif (($perms & 0x6000) == 0x6000) {
            // Archivo especial de bloque
            $info = 'b';
        } elseif (($perms & 0x4000) == 0x4000) {
            // Directorio
            $info = 'd';
        } elseif (($perms & 0x2000) == 0x2000) {
            // Archivo especial de caracteres
            $info = 'c';
        } elseif (($perms & 0x1000) == 0x1000) {
            // Tubería FIFO
            $info = 'p';
        } else {
            // Desconocido
            $info = 'u';
        }
    
        
        // Propietario
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));
    
        // Grupo
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));
    
        // Mundo
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));
    
        $info .= "\n" .$path . "\n" .$request;


        $n = new \League\Flysystem\WhitespacePathNormalizer();
        $path33 =  $n->normalizePath(urldecode($request->path)) ;
        $info .= "\n \n" .$path33;
        $ar = '/assets/'.$n->normalizePath(urldecode($request->path));
        $info .= "\n \n" .$ar;

        dd($info);

        if (File::exists($path)) {
            $mime = '';
            if (Str::endsWith($path, '.js')) {
                $mime = 'text/javascript';
            } elseif (Str::endsWith($path, '.css')) {
                $mime = 'text/css';
            } else {
                $mime = File::mimeType($path);
            }
            $response = response(File::get($path), 200, ['Content-Type' => $mime]);
            $response->setSharedMaxAge(31536000);
            $response->setMaxAge(31536000);
            $response->setExpires(new \DateTime('+1 year'));

            return $response;
        }

        return response('', 404);
    }

    protected function userCannotUploadImageIn($dataType, $action)
    {
        return auth()->user()->cannot($action, app($dataType->model_name))
                || $dataType->{$action.'Rows'}->where('type', 'rich_text_box')->count() === 0;
    }
}
