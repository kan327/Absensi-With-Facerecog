<?php

namespace App\Http\Controllers;

use App\Models\data_person;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DataPersonController extends Controller
{
    // use Process;
    public function index()
    {
        $process = new Process(['python ../../../app/tampilDataMasuk.py']);
        // $process->setTimeout(0);
        $process->run();

        if(!$process->isSuccessful())
        {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();
        // dd(json_decode($data, true));
        $datas = json_decode($data, true);
        return view("layouts.main", [
            "title" => "data_siswa",
            "data" => $datas,
        ]);
    }

    public function form()
    {
        return view("layouts.main", [
            "title" => "form_siswa",
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(data_person $data_person)
    {
        //
    }

    public function edit(data_person $data_person)
    {
        //
    }

    public function update(Request $request, data_person $data_person)
    {
        //
    }

    public function destroy(data_person $data_person)
    {
        //
    }
}
