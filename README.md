
# Pwa test APP. Online, offline detection. When internet connection is found, match the local database &lt;-> remote database
# Setup
- Import test.sql in Local
- In the php.ini file, enable sqlite
- Update local database information from config.php and duplicateDB.php files
- Open chrome browser, and check that sw.js is running in dev tools-> application tab

# Add custom JS code
Run it in the load function in the index.js file.
```
window.addEventListener('load', () => {
  registerSW();
  window.addEventListener("online", handleNetworkChange);
  window.addEventListener("offline", handleNetworkChange);
});
```
