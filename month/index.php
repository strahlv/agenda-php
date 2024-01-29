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
            $holidays = Helpers::getHolidays(
                strtotime("$year-$month-01"),
                strtotime("$year-$month-31")
            );
            $eventos = Db::getEventosFromPeriod(
                strtotime("$year-$month-01"),
                strtotime("$year-$month-31")
            );
            $allEvents = array_merge($eventos, $holidays);
            include './month_list_view.php';
        } else {
            $holidays = Helpers::getHolidays(
                strtotime("$year-$month-01") - date('w', strtotime("$year-01-01")) * 86400,
                strtotime("$year-" . ($month + 1) . "-31")
            );
            $eventos = Db::getEventosFromPeriod(
                strtotime("$year-$month-01") - date('w', strtotime("$year-01-01")) * 86400,
                strtotime("$year-" . ($month + 1) . "-31")
            );
            $allEvents = array_merge($eventos, $holidays);
            include './month_grid_view.php';
        }
        ?>
    </section>
</div>

<?php
include '../components/footer.php';
?>