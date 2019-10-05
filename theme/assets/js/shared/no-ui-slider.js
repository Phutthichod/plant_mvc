(function($) {
  'use strict';

  // Horizontal slider
  if ($("#ul-slider-1").length) {
    var startSlider = document.getElementById('ul-slider-1');
    noUiSlider.create(startSlider, {
      start: [72],
      connect: [true, false],
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-2").length) {
    var startSlider = document.getElementById('ul-slider-2');
    noUiSlider.create(startSlider, {
      start: [92],
      connect: [true, false],
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-3").length) {
    var startSlider = document.getElementById('ul-slider-3');
    noUiSlider.create(startSlider, {
      start: [43],
      connect: [true, false],
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-4").length) {
    var startSlider = document.getElementById('ul-slider-4');
    noUiSlider.create(startSlider, {
      start: [20],
      connect: [true, false],
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-5").length) {
    var startSlider = document.getElementById('ul-slider-5');
    noUiSlider.create(startSlider, {
      start: [75],
      connect: [true, false],
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }

  // Vertical slider
  if ($("#ul-slider-6").length) {
    var startSlider = document.getElementById('ul-slider-6');
    noUiSlider.create(startSlider, {
      start: [72],
      connect: [true, false],
      orientation: "vertical",
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-7").length) {
    var startSlider = document.getElementById('ul-slider-7');
    noUiSlider.create(startSlider, {
      start: [92],
      connect: [true, false],
      orientation: "vertical",
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-8").length) {
    var startSlider = document.getElementById('ul-slider-8');
    noUiSlider.create(startSlider, {
      start: [43],
      connect: [true, false],
      orientation: "vertical",
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-9").length) {
    var startSlider = document.getElementById('ul-slider-9');
    noUiSlider.create(startSlider, {
      start: [20],
      connect: [true, false],
      orientation: "vertical",
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }
  if ($("#ul-slider-10").length) {
    var startSlider = document.getElementById('ul-slider-10');
    noUiSlider.create(startSlider, {
      start: [75],
      connect: [true, false],
      orientation: "vertical",
      range: {
        'min': [0],
        'max': [100]
      }
    });
  }

  // Range Slider
  if ($("#value-range").length) {
    var bigValueSlider = document.getElementById('value-range'),
      bigValueSpan = document.getElementById('huge-value');

    noUiSlider.create(bigValueSlider, {
      start: 1,
      step: 0,
      range: {
        min: 0,
        max: 14
      }
    });

    var range = [
      '0', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'
    ];
    bigValueSlider.noUiSlider.on('update', function(values, handle) {
      console.log(range[Math.floor(values)]);

      bigValueSpan.innerHTML = range[Math.floor(values)];
    });
  }
  if ($("#skipstep").length) {
    var skipSlider = document.getElementById('skipstep');
    noUiSlider.create(skipSlider, {
      range: {
        'min': 0,
        '10%': 10,
        '20%': 20,
        '30%': 30,
        // Nope, 40 is no fun.
        '50%': 50,
        '60%': 60,
        '70%': 70,
        // I never liked 80.
        '90%': 90,
        'max': 100
      },
      snap: true,
      start: [20, 90]
    });
    var skipValues = [
      document.getElementById('skip-value-lower'),
      document.getElementById('skip-value-upper')
    ];

    skipSlider.noUiSlider.on('update', function(values, handle) {
      skipValues[handle].innerHTML = values[handle];
    });
  }

  // Connected Slider
  if ($("#skipstep-connect").length) {
    $(function() {
      var skipSlider = document.getElementById('skipstep-connect');
      noUiSlider.create(skipSlider, {
        connect: true,
        range: {
          'min': 0,
          '10%': 10,
          '20%': 20,
          '30%': 30,
          // Nope, 40 is no fun.
          '50%': 50,
          '60%': 60,
          '70%': 70,
          // I never liked 80.
          '90%': 90,
          'max': 100
        },
        snap: true,
        start: [20, 90]
      });
      var skipValues = [
        document.getElementById('skip-value-lower-2'),
        document.getElementById('skip-value-upper-2')
      ];

      skipSlider.noUiSlider.on('update', function(values, handle) {
        skipValues[handle].innerHTML = values[handle];
      });
    });
  }
  if ($("#skipstep-connect-3").length) {
    $(function() {
      var skipSlider = document.getElementById('skipstep-connect-3');
      noUiSlider.create(skipSlider, {
        connect: true,
        range: {
          'min': 0,
          '10%': 10,
          '20%': 20,
          '30%': 30,
          // Nope, 40 is no fun.
          '50%': 50,
          '60%': 60,
          '70%': 70,
          // I never liked 80.
          '90%': 90,
          'max': 100
        },
        snap: true,
        start: [20, 90]
      });
      var skipValues = [
        document.getElementById('skip-value-lower-3'),
        document.getElementById('skip-value-upper-3')
      ];

      skipSlider.noUiSlider.on('update', function(values, handle) {
        skipValues[handle].innerHTML = values[handle];
      });
    });
  }

  // Tooltip Slider
  if ($("#soft-limit").length) {
    var softSlider = document.getElementById('soft-limit');

    noUiSlider.create(softSlider, {
      start: [24, 50],
      tooltips: true,
      connect: true,
      range: {
        min: 0,
        max: 100
      },
      pips: {
        mode: 'values',
        values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        density: 10
      }
    });
  }
  if ($("#soft-limit-2").length) {
    var softSlider = document.getElementById('soft-limit-2');

    noUiSlider.create(softSlider, {
      start: [24, 50],
      tooltips: [true, true],
      connect: true,
      range: {
        min: 0,
        max: 100
      },
      pips: {
        mode: 'values',
        values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        density: 10
      }
    });
  }
  if ($("#soft-limit-3").length) {
    var softSlider = document.getElementById('soft-limit-3');

    noUiSlider.create(softSlider, {
      start: [0, 100],
      tooltips: [true, true],
      connect: true,
      range: {
        min: 0,
        max: 100
      },
      pips: {
        mode: 'values',
        values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        density: 10
      }
    });
  }
  if ($("#soft-limit-4").length) {
    var softSlider = document.getElementById('soft-limit-4');

    noUiSlider.create(softSlider, {
      start: [0, 300],
      tooltips: [true, true],
      connect: true,
      range: {
        min: 0,
        max: 300
      },
      pips: {
        mode: 'values',
        values: [0, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300],
        density: 10
      }
    });
  }
  if ($("#chrom-slider-1").length) {
    var skipSlider = document.getElementById('chrom-slider-1');
    noUiSlider.create(skipSlider, {
      connect: true,
      tooltips: [true, true], 
      range: {
         'min': 1,
        '9.09%': 2,
        '18.18%': 3,
        '27.27%': 4,
        '36.36%': 5,
        '45.45%': 6,
        '54.54%': 7,
        '63.63%': 8,
        '72.72%': 9,
        '81.81%': 10,
        '90.90%': 11,
        'max': 12,
        
        
      },
      snap: true, // ไม่เกิดทศนิยม
      start: [1, 12]
    });
    var skipValues = [
      document.getElementById('skip-value-lower-4'),
      document.getElementById('skip-value-upper-4')
    ];

    skipSlider.noUiSlider.on('update', function(values,handle) {
      skipValues[handle].innerHTML = values[handle];
        $('#slidechrom').val(values);
     
      //  console.log(values);
      //  console.log(handle);
     

    });
  }

  if ($("#quality-slider-1").length) {
    $(function() {
      var skipSlider = document.getElementById('quality-slider-1');
      noUiSlider.create(skipSlider, {
        connect: true,
        tooltips: [true, true],
        range: {
          'min': 0,
          '10%': 0.1,
          '20%': 0.2,
          '30%': 0.3,
          '40%': 0.4,
          '50%': 0.5,
          '60%': 0.6,
          '70%': 0.7,
          '80%': 0.8,
          '90%': 0.9,
          'max': 1
        },
        snap: true,
        start: [0, 1]
      });
      var skipValues = [
        document.getElementById('skip-value-lower-5'),
        document.getElementById('skip-value-upper-5')
      ];

      skipSlider.noUiSlider.on('update', function(values, handle) {
        skipValues[handle].innerHTML = values[handle];
        $('#slidequality').val(values);
      });
    });
    
  }
  if ($("#depth-slider-1").length) {
    $(function() {
      var skipSlider = document.getElementById('depth-slider-1');
      noUiSlider.create(skipSlider, {
        connect: true,
        tooltips: [true, true],
        range: {
          'min': 0,
          '10%': 10,
          '20%': 20,
          '30%': 30,
          '40%': 40,
          '50%': 50,
          '60%': 60,
          '70%': 70,
          '80%': 80,
          '90%': 80,
          'max': 100
        },
        snap: false,
        start: [0, 100]
      });
      var skipValues = [
        document.getElementById('skip-value-lower-6'),
        document.getElementById('skip-value-upper-6')
      ];

      skipSlider.noUiSlider.on('update', function(values, handle) {
        skipValues[handle].innerHTML = values[handle];
        $('#slidedepth').val(values);
      });
    });
  }


  
  
})(jQuery);