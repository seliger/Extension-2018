<?php
/**
 * Event Feed List
 */
?>
<div class="container">
  <div class="events">
    <?php if($page == "home") : // change heading depending on page events are included on ?>
      <h2>Upcoming Events</h2>
    <?php elseif($page == "events") : ?>
      <h1>Upcoming Events</h1>
    <?php endif; ?>
    <?php foreach($events as $event) :

      // deconstruct event date
      $eventDay = date("D", strtotime($event->datStartDate));
      $eventMonth = date("M", strtotime($event->datStartDate));
      $eventDate = date("d", strtotime($event->datStartDate));
      // format event time
      $eventTime = date('h:i A', strtotime($event->datStartTime));
      //set class for different event states
      // TODO: API does not have Featured Event status
      $eventClassFlag = "";
      // if($event->blnFeatureEvent) {
      //   $eventClassFlag = "events__event--featured";
      // }
      if($event->blnCancelEvent) {
        $eventClassFlag = "events__event--canceled";
      }
      $multiday = false;
      if($event->intEventDateCount > 1){
        //Multiday Event
        $multiday = true;
      }
      $eventED = false;
      // if($page != "home"){
      //   //the event filter call nests the event info into an eventList that appears to always be a count of 1
      //   $event = $event->eventList[0];
      //   if($event->DateList->intEventDateID){
      //     $eventED = $event->DateList->intEventDateID;
      //   }
      // }
    ?>
    <?php if($eventED): ?>
    <a class="events--link" href="<?php echo get_event_link($event->intEventID, $eventED); ?>">
    <?php else: ?>
    <a class="events--link" href="<?php echo get_event_link($event->intEventID); ?>">
    <?php endif; ?>
      <div class="events__event <?php echo $eventClassFlag; ?> reveal">
        <div class="row justify-content-md-center">
          <div class="col-md-auto">
            <div class="events__event-date">
              <p class="events__event-day"><?php echo $eventDay; ?></p>
              <p class="events__event-num"><?php echo $eventDate; ?></p>
              <p class="events__event-month"><?php echo $eventMonth; ?></p>
            </div>
          </div>
          <div class="col">
            <div class="events__event-title">
              <h3><?php echo $event->strTitle; ?></h3>
              <?php if ($multiday) : ?>
                <p class="badge badge-secondary" data-toggle="tooltip" data-title="This event occurs over multiple days."><i class="fas fa-clone"></i> Multiday Event</p>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="events__event-details">
              <?php if($event->blnCancelEvent)  : ?>
                <p class="events__event-canceled">Canceled</p>
              <?php endif; ?>
              <?php if($event->strCity != "N/A") : ?>
                <p class="events__event-location"><?php echo $event->strCity; ?></p>
              <?php endif; ?>
              <?php if($eventTime != "12:00 AM") : ?>
                <p class="events__event-time"><?php echo $eventTime; ?></p>
              <?php else : ?>
                <p class="events__event-time">All Day</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </a>
    <?php endforeach;?>
    <div class="container">
      <div class="row">
        <?php
        if($page != "home") : //don't show pagination on home page
          if(isset($_GET['pc']) ) :
            $page_count = (int) $_GET['pc'];
          endif;
          if($page_count < 1) :
          ?>
            <a href="?pc=<?php echo $page_count+1;?>" class="cta cta__primary" style='position:relative;z-index: 3;'>Next Page &raquo;</a>
          <?php
          else :
          ?>
            <div class="col-sm-6">
              <a href="?pc=<?php echo $page_count-1;?>" class="cta cta__primary" style='position:relative;z-index: 3;'>&laquo; Previous Page</a>
            </div>
            <div class="col-sm-6">
              <a href="?pc=<?php echo $page_count+1;?>" class="cta cta__primary" style='position:relative;z-index: 3;'>Next Page &raquo;</a>
            </div>
          <?php endif;
        else : ?>
          <a href="<?php echo get_event_link(); ?>" class="cta cta__primary">View All Events</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>