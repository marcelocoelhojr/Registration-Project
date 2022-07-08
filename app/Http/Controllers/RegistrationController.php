<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Logs;
use App\Models\Registration;

class RegistrationController extends Controller
{

    public function __construct()
    {
        $this->model = new Registration();
    }

    public function getForm()
    {
        $course = new Courses();
        $course = $course->get('name');
        $course['count'] = count($course);
        return view('registrations', ['names' => $course]);   
    }

    public function create(Request $request)
    {
        try {
            if (isset($request->request) && !empty($request->request)) {
                $registration = $request->except(['_token']);
                $registration['course_id'] = \DB::table('course')->where('name', '=',$registration['course'])->get('id');
                $registration['course_id'] = $registration['course_id'][0]->id;
                if ($registration['password'] == $registration['passwordConfirme']) {
                    unset($registration['passwordConfirme']);
                    $registration['password'] = md5($registration['password']);
                    $this->model->create($registration);
                    $data = [
                        'status' => 'success',
                        'message' => 'Inscrição realizada com sucesso.'
                    ];
                } else {
                    $data = [
                        'status' => 'error',
                        'message' => 'Erro ao realizar a inscrição, por favor verifique as informações.',
                        'registration' => [
                            'name' => $registration['name'],
                            'email' => $registration['email']
                        ]
                     ];
                }
            }
            return view('registrations', $data);
        } catch (\Exception $e) {
            $log = [
                'message' =>  $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
                'file' => 'RegistrationController@create'
            ];
            $saveLog = new Logs();
            $saveLog->insert($log);
            $data = [
                'status' => 'error',
                'message' => 'Erro inesperado, por favor contate o suporte.'
            ];
            return view('registrations', $data);
        }
    }

    public function getRegistrations(Request $request)
    {
        $filter = $request->except(['_token']);
        if (isset($filter['campos']) || isset($filter['categoria']) || isset($filter['status']) || $filter['search']) {
            //TODO: create filters
            $this->applyFilters($filter);
        }
        
        $data = $this->model->with(['course_value'])->get();
        $data['count'] = count($data);
        foreach ($data as $key => &$value) {
            if (isset($value->password)) {
                unset($value->password);
            }
        }

        return view('listRegistrations', ['data' => $data]);
    }

    public function update(Request $request)
    {
        try {
            $registration = $request->except(['_token']);
            $this->model->where('id', $registration['id'])->update($registration);
            return $this->getRegistrations();
        } catch (\Exception $e) {
            $saveLog = new Logs();
            $saveLog->insert($log);
            $data = [
                'status' => 'error',
                'message' => 'Erro inesperado, por favor contate o suporte.'
            ];
            return view('registrations', $data);
        }
    }

    public function delete($id)
    {
        try {
            $this->model->where('id', $id)->delete();
            return $this->getRegistrations();
        } catch (\Exception $e) {
            $saveLog = new Logs();
            $saveLog->insert($log);
            $data = [
                'status' => 'error',
                'message' => 'Erro inesperado, por favor contate o suporte.'
            ];
            return view('registrations', $data);
        }
    }

    //TODO: create filters
    public function applyFilters($filters)
    {
        //$query = '';
        //     if ($filter['search']) {
        //        $query = $filter['search'];
        //        $query = "SELECT * FROM registration WHERE `name` LIKE '%$query%' OR `email` LIKE '%$query%' OR `telephone` LIKE '%$query%' OR `cell` LIKE '%$query%'";
        //     }
        //     $result = \DB::select($query);
        //     print_r(json_encode([$result])); echo "\n\n"; exit;
    }

    public function ticket()
    {
        //Error in pagseguro api
    }

}
