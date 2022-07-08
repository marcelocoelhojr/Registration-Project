<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Traits\LogsTrait;
use App\Traits\Sanitize;

class CourseController extends Controller
{
    use LogsTrait;
    use Sanitize;
    
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
                $this->removeCharacters($course);
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
            $this->saveLog($e->getMessage(), $e->getLine(), $e->getCode(), 'RegistrationController@create');
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
        } catch (\Exception $e) {
            $this->saveLog($e->getMessage(), $e->getLine(), $e->getCode(), 'RegistrationController@getCourses');
            $data = [
                'status' => 'error',
                'message' => 'Erro inesperado, por favor contate o suporte.'
            ];
            return view('listCourses', $data);
        }
    }

}
