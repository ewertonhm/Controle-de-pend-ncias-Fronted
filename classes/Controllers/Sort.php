<?php

namespace Controller;

class Sort
{
    public function date_sorting_inicio_fim($a, $b)
    {
        return strtotime($b->inicio) - strtotime($a->inicio);
    }

    public function date_sorting_fim_inicio($a, $b)
    {
        return strtotime($a->inicio) - strtotime($b->inicio);
    }

    public function sort_by_inicio($pendencias)
    {
        usort($pendencias, array($this, 'date_sorting_fim_inicio'));
        return $pendencias;
    }
}
