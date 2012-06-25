<?php
   $this->load->view('static_header');
   echo "<div class='row'>";
   $this->load->view('P&A/filter_view');
   $this->load->view('P&A/feed_view');
   echo "</div>";
?>