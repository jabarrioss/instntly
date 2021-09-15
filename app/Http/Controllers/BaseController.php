<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);
        if($validator) { return $validator; }

        $class = $this->class;
        $model = $class::create($request->all());

        return $this->modelResponse($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateRequest($request);
        if($validator) { return $validator; }

        $class = $this->class;
        $model = $class::findOrFail($id);
        $model->update($request->all());

        return $this->modelResponse($model);
    }
    
    protected function modelResponse($model,$code = 200)
    {
        $response = [
            'success' => true,
            'data' => $model
        ];

        return response()->json($response, $code);
    }

    protected function errorResponse($errors, $code = 400)
    {
        $response = [
            'success' => false,
            'error' => $errors,
            'error_code' => $code,

        ];

        return response()->json($response, $code);
    }

    protected function validateRequest($request)
    {
        $class = $this->class;
        if(isset($class::$rules)) {
            $validator = \Validator::make($request->all(), $class::$rules);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->getMessages(), 422);
            }
        }
    }
}
