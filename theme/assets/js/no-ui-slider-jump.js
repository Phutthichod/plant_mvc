(function($) {
  'use strict';

if ($(".range-1").length) {
    var softSlider = document.getElementsByClassName('range-1');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 1],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 1
        },
        pips: {
          mode: 'values',
          values: [0,1],
          density: 2
        }
      });
    }
  }
if ($(".range-2").length) {
    var softSlider = document.getElementsByClassName('range-2');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 2],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 2
        },
        pips: {
          mode: 'values',
          values: [0,1,2],
          density: 2
        }
      });
    }
  }
  if ($(".range-5").length) {
    var softSlider = document.getElementsByClassName('range-5');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 5],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 5
        },
        pips: {
          mode: 'values',
          values: [0,1,2,3,4,5],
          density: 2
        }
      });
    }
  }
  if ($(".range-10").length) {
    var softSlider = document.getElementsByClassName('range-10');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 10],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 10
        },
        pips: {
          mode: 'values',
          values: [0,1,2,3,4,5,6,7,8,9,10],
          density: 2
        }
      });
    }

  }
  if ($(".range-20").length) {
    var softSlider = document.getElementsByClassName('range-20');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 20],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 20
        },
        pips: {
          mode: 'values',
          values: [0,2,4,6,8,10,12,14,16,18,20],
          density: 2
        }
      });
    }

  }
  if ($(".range-50").length) {
    var softSlider = document.getElementsByClassName('range-50');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 50],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 50
        },
        pips: {
          mode: 'values',
          values: [0,5,10,15,20,25,30,35,40,45,50],
          density: 5
        }
      });
    }
  }
  if ($(".range-100").length) {
    var softSlider = document.getElementsByClassName('range-100');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 100],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 100
        },
        pips: {
          mode: 'values',
          values: [0,10,20,30,40,50,60,70,80,90,100],
          density: 10
        }
      });
    }
  }
  if ($(".range-200").length) {
    var softSlider = document.getElementsByClassName('range-200');

    for (var i = 0; i < softSlider.length; i++) {
      noUiSlider.create(softSlider[i], {
        start: [0, 200],
        tooltips: [true, true],
        connect: true,
        range: {
          min: 0,
          max: 200
        },
        pips: {
          mode: 'values',
          values: [0,20,40,60,80,100,120,140,160,180,200],
          density: 5
        }
      });
    }
  }

})(jQuery);