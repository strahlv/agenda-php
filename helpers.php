<?php

class Helpers
{
    public static function getMonthName(int $month): string
    {
        return match ($month) {
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        };
    }

    public static function renderEventsFromMonth(array $array, int $month, int $year, string $redirectTo = '')
    {
        $item = '';
        $lastDay = '0';
        foreach ($array as $evento) {
            $day = date('d', $evento->data);
            if (date('n', $evento->data) == $month && date('Y', $evento->data) == $year) {
                $item .= '<li class="event-list-item">';
                $item .= "<span class=\"event-day\">" . ($day != $lastDay ? $day : "") . "</span>";
                if (!$evento->feriado) {
                    $item .= "<form action=\"/$redirectTo?display=list&update=" . $evento->id . "\" method=\"POST\">";
                    $item .= "<input type=\"text\" id=\"titulo\" name=\"titulo\" class=\"event-item-input-text\" value=\"$evento->titulo\">";
                    $item .= '</form>';
                    $item .= "<div><a href=\"/$redirectTo?display=list&delete=$evento->id\" class=\"btn btn-danger\"><i class=\"fa-solid fa-trash-can\"></i></a></div>";
                } else {
                    $item .= "<span class=\"event-item-input-text\">$evento->titulo</span>";
                }
                $item .= '</li>';
            }
            $lastDay = $day;
        }
        if (!empty($item)) {
            echo '<h2 class="event-list-month-title">' . Helpers::getMonthName($month) . '</h2>';
            echo $item;
        }
    }

    public static function getHolidays(int $startTime, int $endTime): array
    {
        $timeMin = date(DATE_RFC3339, $startTime);
        $timeMax = date(DATE_RFC3339, $endTime);

        $holidaysUrl = "https://www.googleapis.com/calendar/v3/calendars/pt.brazilian%23holiday%40group.v.calendar.google.com/events?key=AIzaSyD0_dXEF4xTrJ7JhKliDNT8DyfDbvVfigA&timeMin=$timeMin&timeMax=$timeMax";
        $json = file_get_contents($holidaysUrl);
        $jsonData = json_decode($json);

        $holidays = [];
        foreach ($jsonData->items as $item) {
            $holidays[] = new Evento(-1, $item->summary, strtotime($item->start->date), true);
        }

        return $holidays;
    }
}
