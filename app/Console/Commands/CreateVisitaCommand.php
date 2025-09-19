<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateVisitaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visita:create {nombre} {email} {latitude} {longitude}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear una nueva visita en la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nombre = $this->argument('nombre');
        $email = $this->argument('email');
        $latitude = $this->argument('latitude');
        $longitude = $this->argument('longitude');

         $request = new \Illuminate\Http\Request([
            'name' => $nombre,
            'email' => $email,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        $service = app(\App\Services\Visit\VisitService::class);

        $service->store($request);

        $this->info('Visita creada correctamente.');
    }
}
