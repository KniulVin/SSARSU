<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sga_id',
        'dni',
        'nombres',
        'apellidos',
        'correo_institucional',
        'telefono',
        'direccion',
        'password',
        'estado',
        'email',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Proyectos creados por el usuario
    public function proyectosCreados()
    {
        return $this->hasMany(Proyecto::class, 'created_by');
    }

    // Participación en proyectos
    public function participaciones()
    {
        return $this->hasMany(Participante::class, 'user_id');
    }

    // Documentos subidos por el usuario
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'uploaded_by');
    }

    // Actividades donde es responsable
    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'responsable_id');
    }

    // Facultades donde puede ser jefe de RSU
    public function facultades()
    {
        return $this->hasMany(Facultad::class, 'jefe_rsu');
    }

    /*
    |--------------------------------------------------------------------------
    | Accesores y Mutadores
    |--------------------------------------------------------------------------
    */

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar solo usuarios activos
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    // Buscar usuarios por nombre, apellido o DNI
    public function scopeBuscar($query, $term)
    {
        return $query->where('nombres', 'like', "%{$term}%")
            ->orWhere('apellidos', 'like', "%{$term}%")
            ->orWhere('dni', 'like', "%{$term}%");
    }
}
