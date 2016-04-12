<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tides for Rosslare</title>
<link href="../../tides2.css" rel="stylesheet" type="text/css">
<script src="../../tides.js"></script>
<script src="../../tidess2.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<div id="wrapper">
  <div id="top">
    <h2>Rosslare Harbour Tides</h2>
     <p class="picker" id="picker2">Date Picker:
      <input type="text" id="datepicker" onChange="reStyle()">
    </p>
  </div>
  <div id="middle">
    <table id="highTable">
      <tr>
        <td  class="first">1<sup>st</sup></td>
        <td class="level">HIGH</td>
        <td  class="second">2<sup>nd</sup></td>
      </tr>
      <tr>
        <td id="firstHigh" class="side"><?php echo $firstHigh;?></td>
        <td class="level"></td>
        <td id="secondHigh" class="side"><?php echo $secondHigh;?></td>
      </tr>
    </table>
  </div>
  <div id="bottom">
    <table id="lowTable">
      <tr>
        <td  class="first">1<sup>st</sup></td>
        <td class="level">LOW</td>
        <td  class="second">2<sup>nd</sup></td>
      </tr>
      <tr>
        <td id="firstLow" class="side"><?php echo $firstLow; ?></td>
        <td class="level"></td>
        <td id="secondLow" class="side"><?php echo $secondLow; ?></td>
      </tr>
    </table>
    
    <a href="swap/pig/swan"><button  id="button1" type="button"><?php echo $button; ?></button></a>
    <h3 id="date"><?php echo ""; ?></h3>
    
  </div>
</div>

<body>
</body>
</html>

