<?php

namespace App\Http\Controllers;

use App\Models\data_person;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

$process = new Process(['python ../../../public/python/app.py']);
$process->setTimeout(null);
$process->run();

if(!$process->isSuccessful())
{
    throw new ProcessFailedException($process);
}

echo $process->getOutput();

class DataPersonController extends Controller
{
    public function index()
    {
        return view("templates.mastersiswa");
    }

    public function form()
    {
        return view("templates.form");
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
