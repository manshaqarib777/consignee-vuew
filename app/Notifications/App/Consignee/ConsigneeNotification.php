<?php


namespace App\Notifications\App\Consignee;


use App\Mail\Tag\ConsigneeTag;
use App\Notifications\BaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConsigneeNotification extends BaseNotification implements ShouldQueue
{
    use Queueable;

    public function __construct($templates, $via, $crud)
    {
        $this->templates = $templates;
        $this->via = $via;
        $this->model = $crud;
        $this->auth = auth()->user();
        $this->tag = ConsigneeTag::class;
        parent::__construct();
    }

    public function parseNotification()
    {
        $this->mailView = 'tables.advance-datatable';
        $this->databaseNotificationUrl = route(config('notification.datatable_front_end_route_name'), [
            'consignee' => $this->model->id
        ]);

        $this->mailSubject = $this->template()->mail()->parseSubject([
            '{name}' => $this->model->name
        ]);

        $this->databaseNotificationContent = $this->template()->database()->parse([
            '{name}' => $this->model->name
        ]);
    }
}