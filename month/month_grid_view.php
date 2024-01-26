<nav class="navbar">
    <?php
    $previousMonth = $month - 1 > 0 ? $month - 1 : 12;
    $nextMonth = $month + 1 < 13 ? $month + 1 : 1;
    $previousYear = $previousMonth > $month ? $year - 1 : $year;
    $nextYear = $nextMonth < $month ? $year + 1 : $year;

    echo '<a href="/month" class="btn btn-save">Hoje</a>';
    echo '<a href="/month?y=' . $previousYear . '&m=' . $previousMonth . '" class="btn btn-icon"><i class="fa-solid fa-chevron-left"></i></a>';
    echo '<a href="/month?y=' . $nextYear . '&m=' . $nextMonth . '" class="btn btn-icon"><i class="fa-solid fa-chevron-right"></i></a>';
    echo '<h1 class="navbar-title">' . Helpers::getMonthName($month) . ' de ' . $year . '</h1>';
    echo '<a href="/year?y=' . $year . '" class="btn btn-icon"><i class="fa-solid fa-calendar-days"></i> Ano</a>';
    echo '<a href="/month?display=list&y=' . $year . '&m=' . $month . '" class="btn btn-icon"><i class="fa-solid fa-list"></i></a>';
    ?>
</nav>
<div class="calendar-grid">
    <div class="calendar-row">
        <h2 class="calendar-weekday">Dom.</h2>
        <h2 class="calendar-weekday">Seg.</h2>
        <h2 class="calendar-weekday">Ter.</h2>
        <h2 class="calendar-weekday">Qua.</h2>
        <h2 class="calendar-weekday">Qui.</h2>
        <h2 class="calendar-weekday">Sex.</h2>
        <h2 class="calendar-weekday">Sáb.</h2>
    </div>
    <?php
    $startDate = date("$year-$month-01");
    $ts = strtotime($startDate);
    $weekDay = date('w', $ts);
    $ts -= $weekDay * 86400;

    echo '<pre>';
    // echo print_r($allEvents);
    echo '</pre>';

    for ($i = 1; $i < 7; $i++) {
        echo '<div class="calendar-row">';
        for ($j = 1; $j < 8; $j++) {
            $isOtherMonth = date('n', $ts) != date('n', strtotime($startDate));
            echo '<div class="calendar-day' . ($isOtherMonth ? ' other-month' : '') . '" onclick="focusForm(\'' . date('Y-m-d', $ts) . '\')">';
            echo '<div class="calendar-day-number'
                . ($isOtherMonth ? ' other-month' : '')
                . (date('d/m/Y', $ts) == date('d/m/Y') ? ' today' : '')
                . (date('w', $ts) == 0 ? ' holiday' : '')
                . '">';
            echo date('j', $ts);
            echo '</div>';
            echo '<ul class="calendar-event-list">';
            foreach ($allEvents as $evento) {
                if (date('Y-m-d', $evento->data) == date('Y-m-d', $ts)) {
                    echo '<li class="calendar-event">' . $evento->titulo . '</li>';
                }
            }
            echo '</ul>';
            echo '</div>';
            $ts += 86400;
        }
        echo '</div>';
    }

    ?>
</div>