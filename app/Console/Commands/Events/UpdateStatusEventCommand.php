<?php

namespace App\Console\Commands\Events;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateStatusEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:open-or-close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Abrir ou fechar evento.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app('log')->info("iniciando rotina.");

        $date = app(Carbon::class);

        app('log')->info(sprintf("filtrar eventos para o dia: %s", $date->format('Y-m-d H')));

        /** @var Event $events */
        $events = app(Event::class)
            ->whereDate('start_at', $date->format('Y-m-d'))
            ->get();

        if ($events->isEmpty()) {
            app('log')->info("não existem eventos para serem atualizados.");
            return;
        }

        foreach ($events as $event) {
            app('log')->info("verificando evento -> $event->id inicio.");

            # verificar se momento atual é maior ou igual ao do envento
            if ($date->between($event->start_at, $event->end_at) && $event->status === 'pending') {
                app('log')->info("abrir evento -> $event->id.");
                # alterar status
                $event->status = 'open';
                $event->save();
            }
            # caso o momento seja maior ou igual a data de encerramento
            if ($date->gte($event->end_at) && $event->status === 'open') {
                app('log')->info("fechar evento -> $event->id.");
                $event->status = 'close';
                $event->save();
            }

            $diff = $date->diffInMinutes($event->end_at);

            # notificar via email que o evento vai encerrar
            if ($diff === 5) {
                app('log')->info("notificar que evento encerrará em breve -> $event->id");
            }

            app('log')->info("verificando evento -> $event->id fim.");
        }
    }
}
