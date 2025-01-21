let inProgress = false;

function start() {
  inProgress = true;
  console.log("Started...");
  setTimeout(() => inProgress = false, 5000);
}

window.addEventListener("beforeunload", (e) => {
  if (inProgress) {
    e.preventDefault();
    if (!confirm("Running... Leave?")) e.preventDefault();
  }
});
