<nav class="navbar">
    <?php
    $previousMonth = $month - 1 > 0 ? $month - 1 : 12;
    $nextMonth = $month + 1 < 13 ? $month + 1 : 1;
    $previousYear = $previousMonth > $month ? $year - 1 : $year;
    $nextYear = $nextMonth < $month ? $year + 1 : $year;

    echo '<a href="/month?display=list" class="btn btn-save">Hoje</a>';
    echo '<a href="/month?display=list&y=' . $previousYear . '&m=' . $previousMonth . '" class="btn btn-icon"><i class="fa-solid fa-chevron-left"></i></a>';
    echo '<a href="/month?display=list&y=' . $nextYear . '&m=' . $nextMonth . '" class="btn btn-icon"><i class="fa-solid fa-chevron-right"></i></a>';
    echo '<h1 class="navbar-title">' . Helpers::getMonthName($month) . ' de ' . $year . '</h1>';
    echo '<a href="/year?display=list&y=' . $year . '" class="btn btn-icon"><i class="fa-solid fa-calendar-days"></i> Ano</a>';
    echo '<a href="/month?y=' . $year . '&m=' . $month . '" class="btn btn-icon"><i class="fa-solid fa-table-cells"></i></a>';
    ?>
</nav>
<ul class="event-list">
    <?php
    if (isset($_SESSION['eventos'])) {
        // Ordernar por data ascendente
        usort($allEvents, function ($a, $b) {
            return $a->data - $b->data;
        });

        Helpers::renderEventsFromMonth($allEvents, $month, $year, 'month');
    } else {
        echo 'Ainda não há eventos.';
    }
    ?>
</ul>