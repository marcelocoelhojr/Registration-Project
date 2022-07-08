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
        $filter = $request != null ? $request->except(['_token']) : '';
        $result = 0;
        if (isset($filter['filter']) || isset($filter['search'])) {
            $this->applyFilters($filter, $result);
        }
    
        if (!$result) {
            $data = $this->model->with(['course_value'])->get();
            foreach ($data as $key => $value) {
                if (isset($value->password)) {
                    unset($value->password);
                }
            }
        } else {
            $data = $result;
            foreach ($data as $key => &$value) {
                $course = \DB::table('course')->where('name', $value->course)->get();
                $value->course_value = $course[0];
                if (isset($value->password)) {
                    unset($value->password);
                }
            }
        }
    
        $data['count'] = count($data);
        return view('listRegistrations', ['data' => $data]);
    }

    public function update(Request $request)
    {
        try {
            $registration = $request->except(['_token']);
            $this->model->where('id', $registration['id'])->update($registration);
            return $this->getRegistrations($request);
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
    public function applyFilters($filter, &$result)
    {
        $result = 0;
        if (($filter['filter'] == 1 || $filter['filter'] == 2)) {
            $status = $filter['filter'] - 1;
            $result = \DB::select("SELECT * FROM registration WHERE `status` = $status");
        } else if ($filter['filter'] == 'Inscrito' && !empty($filter['search'])) {
            $search = $filter['search'];
            $result = \DB::select("SELECT * FROM registration WHERE `name` LIKE '%$search%'");
        } else if ($filter['filter'] == 'periodo' && !empty($filter['search']) && isset($filter['end']) && !empty($filter['search'])) {
            $start = $filter['search'].' 00:00:00';
            $end = $filter['end'].' 23:59:59';
            $result = \DB::select("SELECT * FROM registration WHERE `created_at` >= '$start' AND `created_at` <= '$end'");
        }

    }

    public function ticket()
    {
        //Error in pagseguro api
    }

}
