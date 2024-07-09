<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    <?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'fullname' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $datainput = [
            'name' => $request->input('name'),
            'fullname' => $request->input('fullname'),
        ];

        $insert = Biodata::create($datainput);

        if ($insert) {
            return response()->json([
                'status' => true,
                'message' => 'berhasil dibuat',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'gagal terbuat',
            ], 500);
        }
    }

    public function update(Request $request)
    {
        if (!$request->input('id')){
            return 'id required';
        }
        $biodata = Biodatta::where('id', $request->input('id'))->first()
        if (!$biodata){
            return response(->json(['message' => 'biodata not found'], ))
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $biodata = Biodata::find($request->input('id'));
        $data = $request->except('id'); // Exclude 'id' from update data
        $biodata->update($data);

        return response()->json([
            'status' => true,
            'message' => 'user id ' . $biodata->id . ' updated',
        ], 200);
    }
    
    public function get(Request $request)
    {
        $id = $request->input('id');
        $biodataQuery = Biodata::select('*');
        if ($id) {
            $biodataQuery->where('id', $id);
        }
        $getbio = $biodataQuery->get();

        return response()->json($getbio, 200);
    }
}
}
