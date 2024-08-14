<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;


class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_table',
        'qr_code',
        'statut',
        'uuid',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // Générer un UUID unique
            $model->uuid = (string) Str::uuid();

            // Générer le QR code
            $model->generateQrCode();
        });
    }

    public function generateQrCode()
    {
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data($this->uuid)
            ->size(300)
            ->margin(10)
            ->build();

        // Enregistrer l'image dans le dossier public/qrcodes
        $fileName = 'qrcodes/' . $this->uuid . '.png';
        $qrCode->saveToFile(public_path($fileName));

        // Enregistrer le chemin du QR code dans le champ `qr_code`
        $this->qr_code = $fileName;
    }

    // Dans le modèle Table.php
public function marquerCommeOccupee()
{
    $this->statut = 'occupee';
    $this->save();
}

}
