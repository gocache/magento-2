<?php

namespace GoCache\CDN\Model\System\Config\Source;

class TtlCdn
{
    const HOUR = 3600;

    const DAY = 86400;

    public function toOptionArray()
    {
        return [
            [
                'value' => 10,
                'label' => "10 segundos"
            ],
            [
                'value' => 30,
                'label' => "30 segundos"
            ],
            [
                'value' => 60,
                'label' => "1 minuto"
            ],
            [
                'value' => 300,
                'label' => "5 minutos"
            ],
            [
                'value' => 600,
                'label' => "10 minutos"
            ],
            [
                'value' => 900,
                'label' => "15 minutos"
            ],
            [
                'value' => 1800,
                'label' => "30 minutos"
            ],
            [
                'value' => self::HOUR,
                'label' => "1 hora"
            ],
            [
                'value' => self::HOUR*2,
                'label' => "2 horas"
            ],
            [
                'value' => self::HOUR*4,
                'label' => "4 horas"
            ],
            [
                'value' => self::HOUR*12,
                'label' => "12 horas"
            ],
            [
                'value' => self::DAY,
                'label' => "1 dia"
            ],
            [
                'value' => self::DAY*2,
                'label' => "2 dias"
            ],
            [
                'value' => self::DAY*7,
                'label' => "7 dias"
            ],
            [
                'value' => self::DAY*15,
                'label' => "15 dias"
            ],
        ];
    }
}
