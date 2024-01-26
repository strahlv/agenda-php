<nav class="navbar">
    <?php
    $previousYear = $year - 1;
    $nextYear = $year + 1;

    echo '<a href="/year?" class="btn btn-save">Hoje</a>';
    echo '<a href="/year?y=' . $previousYear . '" class="btn btn-icon"><i class="fa-solid fa-chevron-left"></i></a>';
    echo '<a href="/year?y=' . $nextYear . '" class="btn btn-icon"><i class="fa-solid fa-chevron-right"></i></a>';
    echo '<h1 class="navbar-title">' . $year . '</h1>';
    echo '<a href="/month?y=' . $year . '" class="btn btn-icon"><i class="fa-solid fa-calendar-day"></i> Mês</a>';
    echo '<a href="/year?display=list&y=' . $year . '" class="btn btn-icon"><i class="fa-solid fa-list"></i></a>';
    ?>
</nav>
<div class="calendar-grid">
    <?php
    // dias
    function renderDaysFromMonth($eventos, $year, $month)
    {
        $startDate =  date("$year-$month-01");
        $ts = strtotime($startDate);
        $weekDay = date('w', $ts);
        $ts -= $weekDay * 86400;

        for ($i = 1; $i < 7; $i++) {
            echo '<div class="calendar-row-sm">';
            for ($j = 1; $j < 8; $j++) {
                $isOtherMonth = date('n', $ts) != date('n', strtotime($startDate));
                $hasEvent = false;
                foreach ($eventos as $evento) {
                    if (date('Y-m-d', $evento->data) == date('Y-m-d', $ts)) {
                        $hasEvent = true;
                        break;
                    }
                }
                echo '<div class="calendar-day-sm'
                    . ($isOtherMonth ? ' other-month' : '')
                    . ($hasEvent ? ' has-event' : '')
                    . '" onclick="focusForm(\'' . date('Y-m-d', $ts) . '\')">';
                echo '<div class="calendar-day-number'
                    . ($isOtherMonth ? ' other-month' : '')
                    . (date('d/m/Y', $ts) == date('d/m/Y') ? ' today' : '')
                    . (date('w', $ts) == 0 ? ' holiday' : '')
                    . '">';
                echo date('j', $ts);
                echo '</div>';
                echo '</div>';
                $ts += 86400;
            }
            echo '</div>';
        }
    }

    echo '<div class="year-grid">';
    for ($i = 1; $i < 13; $i++) {
        echo '<div class="year-grid-cell">';
        echo '<a href="/month?y=' . $year . '&m=' . $i . '" class="month-name">' . Helpers::getMonthName($i) . '</a>';
        echo '<div class="calendar-row-sm weekday-sm">';
        echo '<div class="calendar-week-sm holiday">D</div>';
        echo '<div class="calendar-week-sm">S</div>';
        echo '<div class="calendar-week-sm">T</div>';
        echo '<div class="calendar-week-sm">Q</div>';
        echo '<div class="calendar-week-sm">Q</div>';
        echo '<div class="calendar-week-sm">S</div>';
        echo '<div class="calendar-week-sm">S</div>';
        echo '</div>';
        renderDaysFromMonth($allEvents, $year, $i);
        echo '</div>';
    }
    echo '</div>';
    ?>
</div>