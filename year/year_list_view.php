<nav class="navbar">
    <?php
    $previousYear = $year - 1;
    $nextYear = $year + 1;

    echo '<a href="/year?display=list" class="btn btn-save">Hoje</a>';
    echo '<a href="/year?display=list&y=' . $previousYear . '" class="btn btn-icon"><i class="fa-solid fa-chevron-left"></i></a>';
    echo '<a href="/year?display=list&y=' . $nextYear . '" class="btn btn-icon"><i class="fa-solid fa-chevron-right"></i></a>';
    echo '<h1 class="navbar-title">' . $year . '</h1>';
    echo '<a href="/month?display=list&y=' . $year . '" class="btn btn-icon"><i class="fa-solid fa-calendar-day"></i> Mês</a>';
    echo '<a href="/year?y=' . $year . '" class="btn btn-icon"><i class="fa-solid fa-table-cells"></i></a>';
    ?>
</nav>
<ul class="event-list">
    <?php
    if (isset($_SESSION['eventos'])) {
        // Ordernar por data ascendente
        usort($allEvents, function ($a, $b) {
            return $a->data - $b->data;
        });

        for ($i = 1; $i < 13; $i++) {
            Helpers::renderEventsFromMonth($allEvents, $i, $year, 'year');
        }
    } else {
        echo 'Ainda não há eventos.';
    }
    ?>
</ul>