<?php

namespace App\Http\Controllers;

use IntlDateFormatter;

class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }
    
    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $days_name = [0 => 'Hétfő', 1 => 'Kedd', 2 => 'Szerda', 3 => 'Csütörtök', 4 => 'Péntek', 5 => 'Szombat', 6 => 'Vasárnap'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);

        $format = new IntlDateFormatter('hu_HU', IntlDateFormatter::NONE, IntlDateFormatter::NONE, NULL, NULL, "MMMM");
        $monthName = datefmt_format($format, strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));

        $nextYearMonth = date('Y/m', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day . '+1 month'));
        $prevYearMonth = date('Y/m', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day . '-1 month'));

        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= $this->active_year .'. '. $monthName;
        $html .= '</div>';
        $html .= '<a role="button" class="btn btn-primary" href="/schedule/'.$prevYearMonth.'">Előző hónap</a>  ';
        $html .= '<a role="button" class="btn btn-primary" href="/schedule/'.$nextYearMonth.'">Következő hónap</a> <br><br>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day_index => $day) {
            $html .= '
                <div class="day_name">
                ' . $days_name[$day_index] . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
?>