<?php

namespace App\Notifications;

use App\Models\Bab;
use App\Models\Mapel;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class TugasNotif extends Notification implements ShouldQueue
{
    use Queueable;
    public $namatugas;
    private $id_bab;
    private $id_mapel;
    private $deadline;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($namatugas, $id_bab, $id_mapel, $deadline)
    {
        $this->namatugas = $namatugas;
        $this->id_bab = $id_bab;
        $this->id_mapel = $id_mapel;
        $this->deadline = $deadline;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $url = route('siswa.tugas', ['id' => $this->namatugas]);
        $url = URL::signedRoute('siswa.tugas', ['id' => $this->id_bab]);
        $mapel = Mapel::find($this->id_mapel)->nama;
        $bab = Bab::find($this->id_bab)->nama;
        $deadline = Carbon::createFromFormat('Y-m-d\TH:i', $this->deadline)->format('F j, Y, h:i A');

        return (new MailMessage)
            ->subject('Notifikasi Tugas Baru')
            ->line('Anda memiliki tugas baru di mapel ' . $mapel)
            ->line('Bab : ' . $bab)
            ->line('Nama Tugas Baru : ' . $this->namatugas)
            ->line('Deadline : ' . $deadline)
            ->action('Lihat Tugas', $url)
            ->line('Terima Kasih');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
