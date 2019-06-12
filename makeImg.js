var parent = document.getElementById('graphCont');
var img = document.createElement('img');
var src = '/pChartLib.php?';
var pcw = parent.clientWidth;
var gt  = document.querySelector('.graphType');

src += 'tw='   + pcw          + '&';
src += 'th='   + pcw/3        + '&';
src += 'bw='   + 3            + '&';
src += 'gah='  + ((pcw/3)-70) + '&';
src += 'gaw='  + (pcw - 170)  + '&';
src += 'hfs='  + 10           + '&';
src += 'lgfs=' + 10           + '&';
src += 'lbfs=' + 8            + '&';
src += 'gn='   + "Report"     + '&';
src += 'gt='   + gt.value     + '&';

src += 'name=newGraph';
img.setAttribute('src',src);
parent.appendChild(img);
