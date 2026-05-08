<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'is_read'];
protected $casts = [
        'is_read' => 'boolean',
    ];
    /**
     * Cette fonction sera appelée à chaque fois qu'un message est créé
     */
  /*   protected static function booted()
    {
        static::created(function ($contact) {
            // Logique d'envoi de mail dès la réception
            Mail::raw("Nouveau message de : {$contact->name} \nEmail : {$contact->email} \nSujet : {$contact->subject} \n\nMessage : \n{$contact->message}", function ($message) use ($contact) {
                $message->to('contact@digital-akili.cd')
                        ->subject("Nouveau contact : " . $contact->subject);
            });
        });
    } */
}