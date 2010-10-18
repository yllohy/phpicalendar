{HEADER}
    <script type="text/javascript" src="{DEFAULT_PATH}/templates/{TEMPLATE}/js/jquery.js"></script>
    <script type="text/javascript">
      // when the DOM has loaded completely
      $(document).ready(function(){

        // insert event handler for showabstract links
        $("a[href=#show_abstract]").click(function(event){
          event.preventDefault();
          $(this).parent().parent().parent().find('.agenda_event_desc_box').animate(
            { opacity: "toggle", height: "toggle" },
            "slow");
          });
        });
    </script>
    <div align="left"><h1>{CALENDAR_NAME}</h1></div>
    <hr size="3" width="600px" align="left" />

      <p style="width: 600px">
        {CALENDAR_DESC}
      </p>

    <div id="agenda">
      <!-- switch some_events_next on -->
      <div id="agenda_next">
        <h2>Upcoming Talks:</h2>
        <!-- loop events_next on -->
        <div class="agenda_event">

          <div class="agenda_event_time">
            <div>{DAYOFMONTH}</div>
            <div class="V10">{EVENT_START}</div>
          </div>

          <!-- switch event_has_nonempty_desc on -->
          <div class="agenda_event_details">
            <div><b>{TALK_SPEAKER}</b></div>
            <div><a href="#show_abstract">{TALK_TITLE}</a></div>
            <!-- switch location_events on -->
            <div><i>{LOCATION}</i></div>
            <!-- switch location_events off -->
          </div>
          <div class="agenda_event_desc_box">{DESCRIPTION}</div>
          <!-- switch event_has_nonempty_desc off -->

          <!-- switch event_has_empty_desc on -->
          <div class="agenda_event_details">
            <div><b>{TALK_SPEAKER}</b></div>
            <div>{TALK_TITLE}</div>
            <!-- switch location_events on -->
            <div><i>{LOCATION}</i></div>
            <!-- switch location_events off -->
          </div>
          <!-- switch event_has_empty_desc off -->
        </div>
        <!-- loop events_next off -->
      </div>
      <!-- switch some_events_next off -->
      <!-- switch some_events_future on -->
      <div id="agenda_future">
        <!-- loop events_future on -->
        <div class="agenda_event">
          <div class="agenda_event_time">
              <div>{DAYOFMONTH}</div>
              <div class="V10">{EVENT_START}</div>
          </div>
          <!-- switch event_has_nonempty_desc on -->
          <div class="agenda_event_details">
            <div><b>{TALK_SPEAKER}</b></div>
            <div><a href="#show_abstract">{TALK_TITLE}</a></div>
            <!-- switch location_events on -->
            <div><i>{LOCATION}</i></div>
            <!-- switch location_events off -->
          </div>
          <div class="agenda_event_desc_box">{DESCRIPTION}</div>
          <!-- switch event_has_nonempty_desc off -->

          <!-- switch event_has_empty_desc on -->
          <div class="agenda_event_details">
            <div><b>{TALK_SPEAKER}</b></div>
            <div>{TALK_TITLE}</div>
            <!-- switch location_events on -->
            <div><i>{LOCATION}</i></div>
            <!-- switch location_events off -->
          </div>
          <!-- switch event_has_empty_desc off -->
        </div>
        <!-- loop events_future off -->
      </div>
      <!-- switch some_events_future off -->
      <!-- switch some_events_past on -->
      <div id="agenda_past">
        <h2>Past Talks:</h2>
        <!-- loop events_past on -->
        <div class="agenda_event">
          <div class="agenda_event_time">
              <div>{DAYOFMONTH}</div>
              <div class="V10">{EVENT_START}</div>
          </div>
          <!-- switch event_has_nonempty_desc on -->
          <div class="agenda_event_details">
            <div><b>{TALK_SPEAKER}</b></div>
            <div><a href="#show_abstract">{TALK_TITLE}</a></div>
            <!-- switch location_events on -->
            <div><i>{LOCATION}</i></div>
            <!-- switch location_events off -->
          </div>
          <div class="agenda_event_desc_box">{DESCRIPTION}</div>
          <!-- switch event_has_nonempty_desc off -->

          <!-- switch event_has_empty_desc on -->
          <div class="agenda_event_details">
            <div><b>{TALK_SPEAKER}</b></div>
            <div>{TALK_TITLE}</div>
            <!-- switch location_events on -->
            <div><i>{LOCATION}</i></div>
            <!-- switch location_events off -->
          </div>
          <!-- switch event_has_empty_desc off -->
        </div>
        <!-- loop events_past off -->
      </div>
      <!-- switch some_events_past off -->
      <!-- switch no_events_past on -->
      <!-- switch no_events_past off -->
    </div>
    <table border="0" width="{TABLE_WIDTH}" cellspacing="4" cellpadding="4">
    <tr>
    <td>
    <span class="V9">Shows all events in the interval {DISPLAY_DATE}</span>
    </td>
    <td align="right" valign="top">
    <!-- switch display_download on -->
    {L_SUBSCRIBE}: <a class="psf" href="{DEFAULT_PATH}/{DOWNLOAD_FILENAME}">{CALENDAR_NAME}</a>
    <!-- switch display_download off -->
    </td>
    </tr>
    </table>
    <div style="text-align: center; color: gray; font-size: x-small;">
      2010
    </div>
{FOOTER}
