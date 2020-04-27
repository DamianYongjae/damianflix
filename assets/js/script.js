$(document).scroll(function () {
  var isScrolled = $(this).scrollTop() > $(".topBar").height();
  $(".topBar").toggleClass("scrolled", isScrolled);
});

const onPreviewMuteButtonClick = () => {
  var input = document.querySelector(".muteButton");
  var volumn = document.querySelector(".previewVideo");
  var status = input.innerHTML.includes("fa-volume-mute") ? true : false;
  if (status === true) {
    input.innerHTML = "<i class='fas fa-volume-up'></i>";
  } else {
    input.innerHTML = "<i class='fas fa-volume-mute'></i>";
  }

  volumn.muted = !volumn.muted;
};

const previewEnded = () => {
  var image = document.querySelector(".previewImage");
  var video = document.querySelector(".previewVideo");

  image.hidden = !image.hidden;
  video.hidden = !video.hidden;
};

const goBack = () => {
  window.history.back();
};

const startHideTimer = () => {
  var timeout = null;
  var nav = document.querySelector(".videoControls.watchNav");

  clearTimeout(timeout);

  timeout = setTimeout(() => {
    nav.classList.add("active");
  }, 2000);

  nav.onmousemove = () => {
    clearTimeout(timeout);
    nav.classList.remove("active");
  };

  nav.onmouseleave = function () {
    timeout = setTimeout(() => {
      nav.classList.add("active");
    }, 2000);
  };
};

function initVideo(videoId, username) {
  startHideTimer();
  setStartTime(videoId, username);
  updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
  addDuration(videoId, username);

  var timer;

  $("video")
    .on("playing", function (event) {
      window.clearInterval(timer);
      timer = window.setInterval(function () {
        updateProgress(videoId, username, event.target.currentTime);
      }, 3000);
    })
    .on("ended", function () {
      setFinished(videoId, username);
      window.clearInterval(timer);
    });
}

function addDuration(videoId, username) {
  $.post(
    "ajax/addDuration.php",
    { videoId: videoId, username: username },
    function (data) {
      if (data !== null && data !== "") {
        alert(data);
      }
    }
  );
}

function updateProgress(videoId, username, progress) {
  $.post(
    "ajax/updateDuration.php",
    { videoId: videoId, username: username, progress: progress },
    function (data) {
      if (data !== null && data !== "") {
        alert(data);
      }
    }
  );
}

function setFinished(videoId, username) {
  $.post(
    "ajax/setFinished.php",
    { videoId: videoId, username: username },
    function (data) {
      if (data !== null && data !== "") {
        alert(data);
      }
    }
  );
}

function setStartTime(videoId, username) {
  $.post(
    "ajax/getProgress.php",
    { videoId: videoId, username: username },
    function (data) {
      if (isNaN(data)) {
        alert(data);
        return;
      }

      $("video").on("canplay", function () {
        this.currentTime = data;
        $("video").off("canplay");
      });
    }
  );
}

function restartVideo() {
  $("video")[0].currentTime = 0;
  $("video")[0].play();
  $(".upNext").fadeOut();
}

function watchVideo(videoId) {
  window.location.href = "watch.php?id=" + videoId;
}

function showUpNext() {
  $(".upNext").fadeIn();
}
