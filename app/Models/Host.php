<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;
    protected $table = 'hosts_addresses';

    public static function byMacAddress($mac)
    {
        return self::where('mac', $mac)->first();
    }
}
