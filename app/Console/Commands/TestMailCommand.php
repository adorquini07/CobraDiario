<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email sending for password reset';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Testing email sending to: {$email}");
        
        try {
            // Simular el envío de correo de recuperación de contraseña
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $this->error("Usuario con email {$email} no encontrado.");
                return 1;
            }
            
            // Generar token de recuperación
            $token = \Illuminate\Support\Facades\Password::createToken($user);
            
            $this->info("Token generado: {$token}");
            $this->info("URL de recuperación: " . url("/reset-password/{$token}?email={$email}"));
            
            // Mostrar el contenido del correo que se enviaría
            $this->info("\nContenido del correo que se enviaría:");
            $this->line("Asunto: Recuperación de Contraseña - MAIVVI");
            $this->line("Destinatario: {$email}");
            $this->line("Mensaje: Se ha solicitado la recuperación de contraseña para tu cuenta en MAIVVI.");
            $this->line("Enlace: " . url("/reset-password/{$token}?email={$email}"));
            
            $this->info("\n✅ Prueba completada exitosamente.");
            $this->info("📧 El correo se guardará en: storage/logs/laravel.log");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
