<?php

namespace App\Interfaces;

interface CongresoRepositoryInterface
{
    public function getAllDiputados();
    public function getDiputadoById($id);
    public function getDiputadoByName($nombre);
    public function getAllVotacionesSummary();
    public function getVotacionesSummaryByDate($date);
    public function getVotacionDetail($id);
    public function getVotacionDetailVotos($id);
    public function getVotacionesSumaryByDiputadoId($id);
    public function getAllIntervenciones();
    public function getIntervencionesByDate($date);
    public function getIntervencion($id);
    public function getIntervencionByDiputadoId ($id);

    //findOrCreate functions
    public function findOrCreateCircunscripcion ($nombre);
    public function findOrCreateGrupo ($nombre);
    public function findOrCreatePartido ($nombre);
}

