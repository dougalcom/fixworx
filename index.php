<?php
include_once('system/config.php');
?>

<h4>Dashboard</h4>
<p>This is where there will be things about the shop.</p>

<? echo modal('myModal','This is my modal.',vehicleSelect(NULL,'dropdown'),'<a href="#">close?</a>'); ?>

<a data-toggle="modal" data-target="#myModal">modal launch test</a>

<!--
<style>

.GaugeMeter {
  position: Relative;
  text-align: Center;
  overflow: Hidden;
  cursor: Default;
  display: inline-block;
}

.GaugeMeter SPAN, .GaugeMeter B {
  width: 54%;
  position: Absolute;
  text-align: Center;
  display: Inline-Block;
  color: #FFFFFF;
  font-weight: 100;
  font-family: "Open Sans", Arial;
  overflow: Hidden;
  white-space: NoWrap;
  text-overflow: Ellipsis;
  margin: 0 23%;
}

.GaugeMeter[data-style="Semi"] B {
  width: 80%;
  margin: 0 10%;
}

.GaugeMeter S, .GaugeMeter U {
  text-decoration: None;
  font-size: .60em;
  font-weight: 200;
  opacity: .6;
}

.GaugeMeter B {
  color: #000;
  font-weight: 200;
  opacity: .8;
}
</style>

<div style="margin:150px auto; text-align:center;background:#0;">
  <div class="GaugeMeter" id="PreviewGaugeMeter_1" data-percent="60" data-prepend="<font style='color:White;font-size:35px;margin-left:-15px'>&ndash;</font>" data-size="188" data-theme="White" data-back="RGBa(0,0,0,.1)" data-animate_gauge_colors="1" data-animate_text_colors="1" data-width="2" data-label="Years" data-label_color="#FFF"></div>
  <div class="GaugeMeter" id="PreviewGaugeMeter_2" data-percent="88" data-append="mph" data-size="200" data-theme="White" data-back="RGBa(0,0,0,.1)" data-animate_gauge_colors="1" data-animate_text_colors="1" data-width="15" data-label="Speed" data-style="Arch" data-label_color="#FFF"></div>
  <div class="GaugeMeter" id="PreviewGaugeMeter_3" data-percent="100" data-text="<font style='color:White;font-size:35px;letter-spacing:-1px'>1.21</font>" data-append="<font style='color:white'>GW</font>" data-size="200" data-theme="White" data-back="RGBa(0,0,0,.1)" data-width="15" data-label="Mr Fusion" data-style="Semi" data-label_color="#FFF"></div>
  <div class="GaugeMeter" id="PreviewGaugeMeter_4" data-percent="100" data-append="Y" data-size="180" data-theme="White" data-back="RGBa(0,0,0,.1)" data-animate_gauge_colors="1" data-animate_text_colors="1" data-width="15" data-label="Flux Capacitor" data-label_color="#FFF" data-stripe="2"></div>
</div>-->

<?
include_once('system/foot.php');
?>