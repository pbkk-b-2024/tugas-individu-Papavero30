<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FunctionPerhitungan;

class ControllerPertemuan1 extends Controller
{
    public function calculateFibonacci(Request $request)
    {
        $n = $request->input('n');
        $result = FunctionPerhitungan::calculateFibonacci($n);
        return view('isiSidebar.fibonacci', ['n' => $n, 'result' => $result]);
    }

    public function checkOddEven(Request $request)
    {
        $n = $request->input('number');
        $result = FunctionPerhitungan::checkOddEven($n);
        return view('isiSidebar.ganjil-genap', ['number' => $n, 'result' => $result]);
    }

    public function checkPrime(Request $request)
    {
        $n = $request->input('number');
        $result = FunctionPerhitungan::checkPrime($n);
        return view('isiSidebar.prima', ['number' => $n, 'result' => $result]);
    }
    
// Fungsi baru untuk handling parameter
public function showParameterForm()
{
    return view('isiSidebar.parameter-form');
}

public function handleSingleParameter(Request $request)
{
    $param1 = $request->input('param1');
    $param2 = $request->input('param2');
    if ($request->has('param2') && !empty($param2)) {
        return redirect()->route('Pertemuan1.fallback');
    }
    return redirect()->route('Pertemuan1.single-parameter', ['param1' => $param1]);
}

public function handleDoubleParameter(Request $request)
{
    $param1 = $request->input('param1');
    $param2 = $request->input('param2');
    if (empty($param1) || empty($param2)) {
        return redirect()->route('Pertemuan1.fallback');
    }
    return redirect()->route('Pertemuan1.double-parameter', ['param1' => $param1, 'param2' => $param2]);
}

public function showSingleParameterPage($param1)
{
    return view('isiSidebar.result', ['url' => url($param1)]);
}

public function showDoubleParameterPage($param1, $param2)
{
    return view('isiSidebar.result', ['url' => url($param1.'/'.$param2)]);
}
}
