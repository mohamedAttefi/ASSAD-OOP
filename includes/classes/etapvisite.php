<?php
class etapevisite
{
    public $id;
    public $titreetape;
    public $description;
    public $orderetape;
    public $id_viste;
    public function __construt($titreetape, $description, $orderetape, $id_viste)
    {
        $this->id = null;
        $this->titreetape = $titreetape;
        $this->description = $description;
        $this->orderetape = $orderetape;
        $this->id_viste = $id_viste;
    }
}