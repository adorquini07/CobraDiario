<?php

namespace App\Console\Commands;

use App\Models\Pago;
use App\Models\Prestamo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RegistrarNoPagos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:registrar-no-pagos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registrar en pagos a quienes no pagaron hoy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hoy = Carbon::today();
        $diaSemana = mb_convert_case(trim(strtolower($hoy->locale('es')->dayName)), MB_CASE_TITLE, 'UTF-8');
       
        $prestamos = Prestamo::whereJsonContains('dias_apagar', $diaSemana)->get();

        $contador = 0;

        foreach ($prestamos as $prestamo) {

            $yaPagoHoy = Pago::where('id_prestamo', $prestamo->id)
                ->whereDate('fecha_pago', $hoy)
                ->exists();

            if (!$yaPagoHoy) {
                Pago::create([
                    'id_prestamo' => $prestamo->id,
                    'id_persona' => $prestamo->id_persona,
                    'fecha_pago' => $hoy,
                    'monto_pagado' => 0,
                ]);
                $contador++;
            }
        }

        $this->info("Se registraron {$contador} pagos en cero para el día {$hoy->format('Y-m-d')}.");
    }
}
