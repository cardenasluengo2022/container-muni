<?php

namespace App\View\Components;

use Illuminate\View\Component;
use carbon\Carbon;

class CalendarEventComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $fechaInicio;
     public $fechaTermino;

    public function __construct($fechaInicio, $fechaTermino)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaTermino = $fechaTermino;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //dd($this->fechaInicio." ".$this->fechaTermino);
        date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8');
        Carbon::setLocale('es');
        $date = empty($this->fechaInicio) ? Carbon::now() : Carbon::createFromFormat('d/m/Y', $this->fechaInicio);
        $date_fin = empty($this->fechaTermino) ? Carbon::now() : Carbon::createFromFormat('d/m/Y', $this->fechaTermino);
        //dd($date);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

        $html = '<div class="calendar">';

        $html .= '<div class="month-year">';
        //$html .= '<span class="month">' . $date->format('M') . '</span>';
        $html .= '<span class="month">' . $date->formatLocalized('%b') . '</span>';
        $html .= '<span class="year">' . $date->format('Y') . '</span>';
        $html .= '</div>';

        $html .= '<div class="days">';

        $dayLabels = ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'];
        foreach ($dayLabels as $dayLabel)
        {
            $html .= '<span class="day-label">' . $dayLabel . '</span>';
        }

        while($startOfCalendar <= $endOfCalendar)
        {
            $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'dull' : '';
            $extraClass .= $startOfCalendar->isToday() ? ' today' : '';
            $extraClass .= $startOfCalendar->format('d/m/Y') == $date->format('d/m/Y') ? ' daySelected' : '';
            $extraClass .= $startOfCalendar->between($date,$date_fin) ? ' daySelected' : '';


            $html .= '<span class="day '.$extraClass.'"><span class="content">' . $startOfCalendar->format('j') . '</span></span>';
            $startOfCalendar->addDay();
        }
        $html .= '</div></div>';
    

        return view('components.calendar-event-component', compact('html'));
    }


}
