function Timer(callback, delay) {
  var timerId;
  var start;
  var remaining = delay;

  this.pause = function () {
    window.clearTimeout(timerId);
    remaining -= new Date() - start;
  };

  var resume = function () {
    start = new Date();
	timerId = window.setTimeout(function () {
      remaining = delay;
      resume();
      callback();
    }, remaining);
  }
  this.resume = resume;

  this.reset = function () {
    remaining = delay;
  };
}

var timer = new Timer(function () {
  window.location.reload();
}, 180000);
timer.resume();