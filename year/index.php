<?php
include '../components/header.php';
?>

<div class="container">
    <section id="left" class="hidden">
        <?php
        include '../components/create_event_form.php';
        ?>
    </section>
    <section id="right">
        <?php
        if ($display == 'list') {
            $calendarStart = strtotime("$year-01-01");
            $calendarEnd = strtotime("$year-12-31");
            $holidays = Helpers::getHolidays(
                $calendarStart,
                $calendarEnd
            );
            $eventos = Db::getEventosFromPeriod(
                $calendarStart,
                $calendarEnd
            );
            $allEvents = array_merge($eventos, $holidays);
            include './year_list_view.php';
        } else {
            $calendarStart = strtotime("$year-01-01") - date('w', strtotime("$year-01-01")) * 86400;
            $calendarEnd = strtotime(($year + 1) . "-01-31");
            $holidays = Helpers::getHolidays(
                $calendarStart,
                $calendarEnd
            );
            $eventos = Db::getEventosFromPeriod(
                $calendarStart,
                $calendarEnd
            );
            $allEvents = array_merge($eventos, $holidays);
            include './year_grid_view.php';
        }
        ?>
    </section>
</div>

<?php
include '../components/footer.php';
?>