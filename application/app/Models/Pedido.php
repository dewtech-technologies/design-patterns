<?php

namespace App\Models;

use App\Events\PedidoConcluidoEvent;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Pedido extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['descricao', 'valor', 'quantidade'];

    public function __construct(array $attributes =[])
    {
        parent::__construct($attributes);

        if(!$this->id){
            $this->attributes['id'] = (string) Uuid::uuid4();
        }
    }

    public function concluirPedido()
    {
        $this->status = 'concluido';
        $this->save();

        event(new PedidoConcluidoEvent($this));
    }
}
