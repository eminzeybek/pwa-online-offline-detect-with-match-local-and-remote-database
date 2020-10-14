
window.addEventListener('load', () => {
  registerSW();
  window.addEventListener("online", handleNetworkChange);
  window.addEventListener("offline", handleNetworkChange);
});



async function registerSW() {
  if ('serviceWorker' in navigator) {
    try {
      await navigator.serviceWorker.register('./sw.js');
    } catch (e) {
      console.log(`SW registration failed`);
    }
  }
}

async function handleNetworkChange(event) {
  if (navigator.onLine) {
    alert("online");
  } else {
    alert("offline");
    window.location.replace("index_offline.php");
  }
}

