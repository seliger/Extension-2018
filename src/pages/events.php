<?php
get_header();
get_menu();
get_banner();
echo "<br>";
get_event_list(10, 0, "events");
get_resource_links();
get_footer();