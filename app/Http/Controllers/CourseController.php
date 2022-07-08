<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Logs;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->model = new Courses();
    }

    public function create(Request $request)
    {
        try {
            if (isset($request->request) && !empty($request->request)) {
                $course = $request->except(['_token']);
                if (!isset($course['file'])) {
                    $course['file'] = '';
                }
                $this->model->create($course);
                $data = [
                    'status' => 'success',
                    'message' => 'Curso cadastrado com sucesso.'
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'message' => 'Erro ao cadastrar curso, por favor verifique as informações.'
                ];
            }

            return view('newCourse', $data);
        } catch (\Exception $e) {
            $log = [
                'message' =>  $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
                'file' => 'CourseController@create'
            ];
            $saveLog = new Logs();
            $saveLog->insert($log);
            $data = [
                'status' => 'error',
                'message' => 'Erro inesperado, por favor contate o suporte.'
            ];
            return view('newCourse', $data);
        }
    }

    public function getCourses()
    {
        try {
            $data = \DB::table('course')->get();//query build is more performant
            $data['count'] = count($data);
            return view('listCourses', ['data' => $data]);
        } catch (\Exception $e) {print_r('eeror');
            $log = [
                'message' =>  $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
                'file' => 'CourseController@getCourses'
            ];
            $saveLog = new Logs();
            $saveLog->insert($log);
            $data = [
                'status' => 'error',
                'message' => 'Erro inesperado, por favor contate o suporte.'
            ];
            return view('listCourses', $data);
        }
    }

}
